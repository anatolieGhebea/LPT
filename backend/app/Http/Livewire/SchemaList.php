<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schema;
use App\Models\Table;
use App\Models\Field;

class SchemaList extends Component
{
    public $schemas;
    public $newSchemaTitle = '';
    public $newSchemaDescription = '';

    public function mount(){
        $this->init();
    }

    protected function init(){

        $this->schemas = Schema::query()->get();
        $this->newSchemaTitle = '';
        $this->newSchemaDescription = '';
    }

    public function addSchema(){

        $this->validate([
            'newSchemaTitle'=> 'required|string',
            'newSchemaDescription'=> 'string',
        ]);

        Schema::create([
            'title' => $this->newSchemaTitle,
            'description' => $this->newSchemaDescription,
        ]);

        $this->init();
    }

    public function editSchemaTitle($id, $title ){
        if( empty($id) || empty($title) )
            return false;

        $schema = Schema::find($id);
        if($schema){
            $schema->title = $title;
            $schema->save();
        }

        $this->init();
    }

    public function editSchemaDescription($id, $description ){
        if( empty($id) || empty($description) )
        return false;

        $schema = Schema::find($id);
        if($schema){
            $schema->description = $description;
            $schema->save();
        }

        $this->init();
    }


    public function duplicateSchema($id){
        $schema = Schema::find($id);

        if( !$schema ){
            return false;
        }

        // insert duplicate schema
        $newSchema = clone $schema;
        $newSchema->title = $schema->title . '_COPY';
        $newSchema->description = 'schema copy ';

        $newSchema = Schema::create( $newSchema->toArray() );

        // get old schema tables
        if( count($schema->tables) > 0 ){
            foreach( $schema->tables as $tb ){
                $tb->schema_id = $newSchema->id;
                $newTb = Table::create( $tb->toArray() );
                //get old fields
                if( count( $tb->fields ) > 0 ){
                    foreach(  $tb->fields as $fld ){
                        $fld->table_id = $newTb->id;
                        $newFld = Field::create( $fld->toArray() );
                    }
                }
            }
        }


        $this->init();
    }

    public function deleteSchema($id){
        Schema::find($id)->delete();
        $this->init();
    }

    public function render()
    {
        return view('livewire.schema-list');
    }
}
