<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Schema;

class SchemaDetaile extends Component
{
    public $schema;
    // public $updateComponent;

    protected $listeners = [
        'tableComponentUpdated' => 'render'
    ];

    public function mount( $schema ){
        $this->schema = $schema;
        $this->updateComponent = false;
    }

    // public function refreshComponent(){
    //     $this->updateComponent = false;
    // }

    public function render()
    {
        return view('livewire.schema-detaile');
    }
}
