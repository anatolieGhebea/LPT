<div>
    <form wire:submit.prevent="storeData">
        <div class="form-row">
			<div class="form-group col-md-1">
                @if( $actionCreate )<label for="name">Name</label>@endif
				<input type="text" name="name" class="form-control" id="name" wire:model.lazy="name" >
            </div>
			<div class="form-group col-md-2">
				@if( $actionCreate )<label for="label">Label</label>@endif
				<input type="text" name="label" class="form-control" id="label" wire:model.lazy="label" >
            </div>

            <div class="form-group col-md-1">
                @if( $actionCreate )<label for="cmpType">cmpType</label>@endif
                <select class="form-control" id="cmpType" placeholder="Select component type" wire:model="cmpType">
                    <option value="">--Select component type--</option>
                    @foreach( $cmpTypes as $type => $tl )
                        <option value="{{ $type }}">{{ $tl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-1">
                @if( $actionCreate )<label for="dataType">dataType</label>@endif
                <select class="form-control" id="dataType" placeholder="Select data type" wire:model="dataType">
                    <option value="">--Select data type--</option>
                    @foreach( $dataTypes as $dtype => $dtl )
                        <option value="{{ $dtype }}" {{ $dtype="text"? 'selected':'' }} >{{ $dtl }}</option>
                    @endforeach
                </select>
            </div>
            
			<div class="form-group col-md-1">
				@if( $actionCreate )<label for="length">Length</label>@endif
				<input type="text" name="tableName" class="form-control" id="length" wire:model.lazy="length" value="0">
            </div>

            <div class="form-group col-md-2">
				@if( $actionCreate )<label for="description">Description</label>@endif
				<textarea rows="1" name="description" class="form-control" id="description" wire:model.lazy="description"></textarea>
            </div>
            
            <div class="form-group col-md-1 text-center">
				@if( $actionCreate )<label class="form-check-label" for="primary">Primary</label>@endif
				<input class="form-check-input form-control" type="checkbox" id="primary" wire:model.lazy="primary">
			</div>	
            <div class="form-group col-md-1 text-center">
				@if( $actionCreate )<label class="form-check-label" for="required">Required</label>@endif
				<input class="form-check-input form-control" type="checkbox" id="required" wire:model.lazy="required">
			</div>	
            <div class="form-group col-md-1 text-center">
				@if( $actionCreate )<label class="form-check-label" for="fillable">Fillable</label>@endif
				<input class="form-check-input form-control" type="checkbox" id="fillable" wire:model.lazy="fillable">
            </div>

            <div class="form-group col-md-1 text-right">
                <div>
                    <button type="submit" class="btn btn-primary {{ $actionCreate ? ' mt-4': ' mt-1'}}">
                        {{ $actionCreate ? 'Add': 'Update' }}
                    </button>
                    @isset( $field->id )
                    <button class="btn btn-outline-danger mt-1" wire:click="deleteField({{$field->id}})">
                        <i class="fa fa-trash"></i>
                    </button>
                    @endisset
                </div>
            </div>
            
		</div>
    </form>
</div>