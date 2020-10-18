<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Table;
use App\Models\Field;

use Illuminate\Support\Facades\Session;

class TableField extends Component
{
    public $field;
    public $tableId;

    // db fields
    public $name;
    public $label;
    public $cmpType;
    public $dataType;
    public $length;
    public $description;
    public $primary;
    public $required;
    public $fillable;

    public $actionCreate = true;

    public $cmpTypes = [
        'text' => 'CMP_TEXT',
        'textarea' => 'CMP_TEXT_AREA',
        'number' => 'CMP_NUMBER',
        'select' => 'CMP_SELECT',
        'checkbox' => 'CMP_CHECKBOX',
        'hidden' => 'CMP_HIDDEN',
        'password' => 'CMP_PASSWORD',
        'email' => 'CMP_EMAIL',
    ];

    public $dataTypes = [
        'int' => 'DT_INT',
        'float' => 'DT_FLOAT',
        'boolean' => 'DT_BOOLEAN',
        'date' => 'DT_DATE',
        'datetime' => 'DT_DATE_TIME',
        'text' => 'DT_TEXT',
        'textarea' => 'DT_TEXT_AREA',
    ];


    public function mount( $field = null, $tableId = null  ){
        if( $field != null ){
            $this->actionCreate = false;
            $this->field = $field;
            $this->initValues($field);
        } else {
            $this->cmpType = 'text';
            $this->dataType = 'text';
        }

        if( $tableId != null )
            $this->tableId = $tableId;
    }

    /**
     * Persist data to database
     */
    public function storeData(){
        $data = $this->encapsulateDataInArray();

        $type = 'alert-success';
		$msg = 'The field has been created';
        
		$ok = false;
		if( $this->actionCreate ){
            $table = Table::find($this->tableId);
            if($table){
                $data['table_id'] = $this->tableId;
                $ok = Field::create($data);
            } 
            if($ok){
                $this->resetFields();
            }
		} else {
			$ok = $this->field->update($data);
            $msg = 'The field has been updated';
		}
		
		if(!$ok){
			$type = 'alert-danger';
			$msg = 'Something went wrong';
		} else {
			// notify parent component
			$this->emit('fieldComponentUpdated');
		}

		$this->mFlash($msg, $type);
		
		return;
    }
    public function deleteField($id){
        $field = Field::find($id);
        if( !$field ){
            $this->mFlash('Error while deleting the field');
            return;
        }
        $field->delete();
        $this->emit('fieldComponentUpdated');
    }

    protected function initValues($field){
        $this->name = $field->name;
        $this->label = $field->label;
        $this->cmpType = $field->cmpType;
        $this->dataType = $field->dataType;
        $this->length = $field->length;
        $this->description = $field->description;
        $this->primary = $field->primary;
        $this->required = $field->required;
        $this->fillable = $field->fillable;
    }

    protected function encapsulateDataInArray(){
        $data = [];
        $data['name'] = $this->name;
        $data['label'] = $this->label;
        $data['cmpType'] = $this->cmpType;
        $data['dataType'] = $this->dataType;
        $data['length'] = $this->length;
        $data['description'] = $this->description;
        $data['primary'] = $this->primary;
        $data['required'] = $this->required;
        $data['fillable'] = $this->fillable;
        return $data;
    }
    
    public function resetFields(){
        $this->name
        = $this->label
        = $this->cmpType
        = $this->dataType
        = $this->length
        = $this->description
        = $this->primary
        = $this->required
        = $this->fillable
        = null;

        if($this->actionCreate){
            $this->cmpType = $this->dataType = 'text';
        }
    }

    public function render()
    {
        return view('livewire.table-field');
    }

    public function mFlash( $msg, $type ="alert-info" ){
        Session::flash('message', $msg);
        Session::flash('message-type', $type);
        
    }
}
