<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Table;
use App\Models\Field;

use Illuminate\Support\Facades\Session;

class SchemaTable extends Component
{
    public $table;

    protected $listeners = [
        'fieldComponentUpdated' => 'render'
    ];
    

    public function mount( $table ){
        $this->table = $table;
    }

    /**
	 * 
	 */
	public function deleteTable($id){
		$table = Table::find($id);
		if( !$table ){
			$this->mFlash('Invalid table id', 'alert-danger');
			return;
		}
		
        $deleteFields = Field::query()->where('table_id', '=', $table->id)->delete();
        
		if($deleteFields === null){
			$this->mFlash('Error while deleting the table', 'alert-danger');
			return;
		} 

		$table->delete();
        $this->emit('tableComponentUpdated');
        $this->mFlash('Table deleted', 'alert-success');
		return;
	}


    public function render()
    {
        return view('livewire.schema-table');
    }

    public function mFlash( $msg, $type ="alert-info" ){
        Session::flash('message', $msg);
        Session::flash('message-type', $type);
        
    }
}
