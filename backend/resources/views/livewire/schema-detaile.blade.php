<div class="container-fluid">
	<div class="row">
		<div class="col-md-2" style="background-color: #fff;">
			<div class="pl-1 mb-2">
				<h1 class="mt-4 mb-0 mx-0"><b>{{ $schema->title }}</b></h1>
				<h6 class="mb-4 mt-1">
					<span class="">last_update: <b>{{ $schema->updated_at->format('d/m/Y H:i') }}  </b></span><br>
					<span class="">created: <b>{{ $schema->created_at->format('d/m/Y') }} </b></span>
				</h6>
				<p>
					{{ $schema->description }}
				</p>
			</div>
			
			<div class="bg-light m-1 p-1 rounded">
				<h5 class="text-info">create new table</h5>
				<livewire:add-table :schemaId="$schema->id" viewDirection="vertical" />
			</div>
		</div>

		<div class="col-md-10">
			
			<div class="d-flex align-items-top pt-3 ">
				
				<div class="m-0">
					<a href="{{ route('schemas.index') }}" class="btn btn-outline-primary"> < </a>
				</div>
				<div class="m-0 px-2">
					
				</div>
				<div class="ml-auto mr-3">
					<a href="{{ route('schema.export', ['schema' => $schema->id ] ) }}" class="btn btn-success"> Export </a>
				</div>
			

				
			</div>
			

			<div class="mt-4 p-4" style="max-height: calc( 100vh - 5.5rem ); overflow-y:scroll;">
				@if( count( $schema->tables ) > 0 )
					@foreach( $schema->tables as $tb )
						<livewire:schema-table :table="$tb" :key="'schma-table-'.$schema->id .'-'. $tb->id" />
					@endforeach
				@else
					<div class="text-center">
						No tables for this schema
					</div>
				@endif
			</div>
		</div>

	</div>

</div>
