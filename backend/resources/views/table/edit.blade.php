@extends('layouts.app')

@section('content')

<div class="p-4">
    <div class="mt-2">
        <a href="{{ route('schema.edit', [ 'schema' => $table->schema_id ] ) }}"> <<< back </a>
    </div>

    <div class="mt-2">
        <div class="d-flex justify-content-between align-items-end">
            <h2>Edit Table</h2>
            <div class="mb-2">Schema:
                <a href="{{ route('schema.edit', [ 'schema' => $table->schema_id ] ) }}" class="text-info">
                 {{ $table->schema->title }}
                </a> 
            </div>
        </div>
        <div class="p-3 border rounded bg-white">
            <livewire:add-table :table="$table"/>
        </div>
    </div>

    <div class="mt-4">
        <h4>Table fields</h4>
        <div class="pt-1 px-2">
            <livewire:table-field :tableId="$table->id"/>
        </div>
        <livewire:table-field-list :table="$table" />        
    </div>
</div>
@endsection