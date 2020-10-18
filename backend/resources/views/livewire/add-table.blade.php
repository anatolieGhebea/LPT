<?php  $css = $viewDirection == 'vertical' ? 'col-12':'col-md-4';  ?>
<?php  $css2 = $viewDirection == 'vertical' ? 'col-12 ':'col-md-2 text-center';  ?>
<?php  $css3 = $viewDirection == 'vertical' ? 'width:5rem;right:0;top:-1rem ':'';  ?>
<div>
	<!-- this component allows adding new table to the selected schema -->
	<form wire:submit.prevent="storeData">
		<div class="form-row">
			<div class="form-group {{ $css }}">
				<label for="tableName">Table name</label>
				<input type="text" name="tableName" class="form-control" id="tableName" wire:model.lazy="tableName">
			</div>

			<div class="form-group {{ $css2 }} ">
				<label class="form-check-label" for="createMigration">Create Migration</label>
				<input class="form-check-input form-control" style="{{ $css3 }}" type="checkbox" id="createMigration" wire:model.lazy="createMigration">
			</div>

			<div class="form-group {{ $css2 }} ">
				<label class="form-check-label" for="createModel">Create Model </label>
				<input class="form-check-input form-control " style="{{ $css3 }}" type="checkbox" id="createModel" wire:model.lazy="createModel">
			</div>

			<div class="form-group {{ $css2 }} ">
				<label class="form-check-label" for="createController">Create Controller</label>
				<input class="form-check-input form-control " style="{{ $css3 }}" type="checkbox" id="createController" wire:model.lazy="createController">
			</div>

			<div class="form-group {{ $css2 }} ">
				<label class="form-check-label" for="addTimestamp">Add Timestamp</label>
				<input class="form-check-input form-control " style="{{ $css3 }}" type="checkbox" id="addTimestamp" wire:model.lazy="addTimestamp">
			</div>	
		<!-- </div>
	

		<div class="form-row">
			 -->
			<div class="form-group {{ $css }}">
				<label for="modelName">Model Name</label>
				<input type="text" name="modelName" class="form-control" id="modelName" wire:model.lazy="modelName">
			</div>
			<div class="form-group {{ $css }}">
				<label for="modelNameSpace">Model Namespace</label>
				<input type="text" name="modelNameSpace" class="form-control" id="modelNameSpace" wire:model.lazy="modelNameSpace">
			</div>
			<div class="form-group {{ $css }}">
				<label for="modelExtraContent">Model ExtraContent</label>
				<textarea cols="30" rows="1" name="modelExtraContent" class="form-control" id="modelExtraContent" wire:model.lazy="modelExtraContent"></textarea>
			</div>
		<!-- </div>

		<div class="form-row"> -->
			<div class="form-group {{ $css }}">
				<label for="controllerName">Controller Name</label>
				<input type="text" name="controllerName" class="form-control" id="controllerName" wire:model.lazy="controllerName">
			</div>
			<div class="form-group {{ $css }}">
				<label for="controllerNamespace">Controller Namespace</label>
				<input type="text" name="controllerNamespace" class="form-control" id="controllerNamespace" wire:model.lazy="controllerNamespace">
			</div>
			<div class="form-group {{ $css }}">
				<label for="controllerPrependMethods">Controller PrependMethods</label>
				<textarea cols="30" rows="1" type="text" name="controllerPrependMethods" class="form-control" id="controllerPrependMethods" wire:model.lazy="controllerPrependMethods"></textarea>
			</div>
		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-primary">
				{{ $actionCreate ? 'Create table': 'Update table' }}
			</button>
		</div>
	</form>	
</div>