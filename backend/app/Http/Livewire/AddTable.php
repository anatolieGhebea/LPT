<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Table;
use Illuminate\Support\Facades\Session;

class AddTable extends Component
{
	public $schemaId = null;
	public $table = null;
	public $viewDirection = 'horizontal';
	// fileds for new table
	public $tableName;
	public $modelName;
	public $modelNameSpace;
	public $modelExtraContent;
	public $controllerName;
	public $controllerNamespace;
	public $controllerPrependMethods;
	public $createMigration;
	public $createModel;
	public $createController;
	public $addTimestamp;

	public $actionCreate = true;
	// protected $listeners = [
    //     'newTableAdded' => '$refresh',
	// ];

	public function mount($schemaId = null, $table = null, $viewDirection = null){
		$this->schemaId = $schemaId;
		if( $table != null ){
			$this->actionCreate = false;
			$this->initValues($table);
			$this->table = $table;
		}
		if( $viewDirection != null ){
			$this->viewDirection = $viewDirection;
		}
	}

	/**
	 * Store the new table in the DataBase
	 */
	public function storeData(){
		$data = $this->encapsulateDataInArray();
		
		$ok = false;
		if( $this->actionCreate ){
			$ok = Table::create($data);
		} else {
			$ok = $this->table->update($data);

		}
		
		$type = 'alert-success';
		$msg = 'The table has been created';
		if(!$ok){
			$type = 'alert-danger';
			$msg = 'Something went wrong';
		} else {
			$this->resetFields();
			// notify parent component
			$this->emit('tableComponentUpdated');
		}

		$this->mFlash($msg, $type);
		
		return;
	}

	/**
	 * 
	 */
	protected function encapsulateDataInArray(){

		$data = [];
		$data['schema_id'] = $this->schemaId;
		$data['tableName'] = $this->tableName;
		$data['model'] = $this->modelName;
		$data['modelNamespace'] = $this->modelNameSpace;
		$data['modelExtraContent'] = $this->modelExtraContent;
		$data['controller'] = $this->controllerName;
		$data['controllerNamespace'] = $this->controllerNamespace;
		$data['controllerPrependMethods'] = $this->controllerPrependMethods;
		$data['createMigration'] = $this->createMigration;
		$data['createModel'] = $this->createModel;
		$data['createController'] = $this->createController;
		$data['addTimestamp'] = $this->addTimestamp;
		return $data;
	}

	/**
	 * 
	 */
	protected function initValues($table){
		$this->schemaId = $table->schema_id;
		$this->tableName = $table->tableName;
		$this->modelName = $table->model;
		$this->modelNameSpace = $table->modelNamespace;
		$this->modelExtraContent = $table->modelExtraContent;
		$this->controllerName = $table->controller;
		$this->controllerNamespace = $table->controllerNamespace;
		$this->controllerPrependMethods = $table->controllerPrependMethods;
		$this->createMigration = $table->createMigration;
		$this->createModel = $table->createModel;
		$this->createController = $table->createController;
		$this->addTimestamp = $table->addTimestamp;
		return;
	}

	/**
	 * reset all the input fields
	 */
	private function resetFields(){
		$this->tableName 
		= $this->modelName 
		= $this->modelNameSpace 
		= $this->modelExtraContent 
		= $this->controllerName 
		= $this->controllerNamespace 
		= $this->controllerPrependMethods 
		= $this->createMigration 
		= $this->createModel 
		= $this->createController 
		= $this->addTimestamp 
		= null;
	}

	/**
	 * 
	 */
	public function render()
	{
		return view('livewire.add-table');
	}

	public function mFlash( $msg, $type ="alert-info" ){
        Session::flash('message', $msg);
		Session::flash('message-type', $type);
    }
}
