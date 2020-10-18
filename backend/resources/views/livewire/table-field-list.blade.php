<div>
    @if( count($table->fields) > 0 )
        <div class="mt-2 pt-3 px-2 bg-white border rounded">
            @foreach( $table->fields as $field )
                <livewire:table-field :field="$field" :key="'table-field-'.$field->id"/>
            @endforeach
        </div>
    @endif
</div>
