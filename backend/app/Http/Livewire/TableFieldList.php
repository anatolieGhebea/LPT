<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableFieldList extends Component
{
    public $table;

    protected $listeners = [
        'fieldComponentUpdated' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.table-field-list');
    }
}
