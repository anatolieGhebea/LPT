<div>
	<div class="card mb-4">
		<div class="card-header">
			<div class="d-flex justify-content-between align-items-center">
				<h4>
					Table:<b> {{ $table->tableName }} </b>
				</h4>
				<div class="d-flex">
					<a href="{{ route('table.edit', ['table'=> $table->id ]) }}" class="btn btn-primary mr-1">Edit table</a>
					<button class="btn btn-outline-danger " wire:click="deleteTable({{ $table->id }})">
						<i class="fa fa-trash"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div>
				<span class="mr-2">Model: <b> {{ $table->model }} </b></span>
				<span class="mr-2">Controller: <b> {{ $table->controller }} </b></span>
				<span class="mr-2">C-Migration: {!! $table->createMigration ? '<span class="text-success">Yes</span>':'<span class="text-danger"> No</span>' !!}  </span>
				<span class="mr-2">C-Model: {!! $table->createModel ? '<span class="text-success">Yes</span>':'<span class="text-danger"> No</span>' !!}  </span>
				<span class="mr-2">C-Controller: {!! $table->createController ? '<span class="text-success">Yes</span>':'<span class="text-danger"> No</span>' !!}  </span>
				<span class="mr-2">Timestamp: {!! $table->addTimestamp ? '<span class="text-success">Yes</span>':'<span class="text-danger"> No</span>' !!}  </span>
			</div>

			<div class="mt-3" >
				@if( count($table->fields) > 0 )
					<table class="table">
						<thead>
							<tr class="bg-light">
								<td>Name</td>
								<td>Label</td>
								<td>cmpType</td>
								<td>dataType</td>
								<td>Length</td>
								<td>Description</td>
								<td>Primary</td>
								<td>Required</td>
								<td>Fillable</td>
							</tr>
						</thead>
						<tbody>
							@foreach( $table->fields as $field )
								<tr>
									<td>{{ $field->name }}</td>
									<td>{{ $field->label }}</td>
									<td>{{ $field->cmpType }}</td>
									<td>{{ $field->dataType }}</td>
									<td>{{ $field->length }}</td>
									<td>{{ $field->description }}</td>
									<td>{{ $field->primary }}</td>
									<td>{{ $field->required }}</td>
									<td>{{ $field->fillable }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>

				@endif
			</div>

			<div class="text-right text-info">
				last_update: {{ $table->updated_at->format('d/m/Y H:i') }}
			</div>
		</div>
	</div>
</div>