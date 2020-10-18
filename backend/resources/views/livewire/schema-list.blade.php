<div class="container">
    <h1 class="mt-4">Init new schema</h1>
    <div class="form mb-4 ">
        <form wire:submit.prevent="addSchema">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="newSchemaTitle" wire:model.lazy="newSchemaTitle">
                    @error('newSchemaTitle')
                        {{ $message }}
                    @enderror
                </div>
                <div class="col-md-7">
                    <textarea name="newSchemaDescription" class="form-control" wire:model.lazy="newSchemaDescription" cols="30" rows="1"></textarea>
                </div>
                <div class="col-md-2 text-right">
                    <button type="submit" class="btn btn-primary"> Save </button>
                </div>
            </div>
        </form>
    </div>
    
    <h2 class="mt-2">Schemas</h2>
    <table class="table"> 
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Tables</th>
                <th>Updated</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($schemas) > 0)
                @foreach( $schemas as $schema )
                    <tr>
                        <td >
                            <div class="d-flex justify-content-between pr-4">
                                {{ $schema->title }}
                                <span
                                    class="action-btn"
                                    onclick="editSchemaTitlePrompt('{{ $schema->title }}') || event.stopImmediatePropagation()" 
                                    wire:click="editSchemaTitle({{ $schema->id }}, newValue )">
                                    <i class="fas fa-pen"></i>
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between pr-4">
                                {{ $schema->description }} 
                                <span 
                                    class="action-btn"
                                    onclick="editSchemaDescriptionPrompt('{{ $schema->description }}') || event.stopImmediatePropagation()" 
                                    wire:click="editSchemaDescription({{ $schema->id }}, newValue )">
                                    <i class="fas fa-pen"></i>
                                </span>
                            </div>
                        </td>
                        <td class="text-right ">{{ count( $schema->tables ) }} </td>
                        <td>{{ $schema->getUpdatedAt() }} </td>
                        <td>{{ $schema->getCreatedAt() }} </td>
                        <td class="text-right">
                            <div class="btn-group btn-action" role="group" aria-label="Basic example">
                                <a href="{{ route('schema.edit', [ 'schema' => $schema->id ]) }}" class="btn btn-sm btn-primary btn-md rounded-0 ml-1" title="{{ __('Visualizza/Modifica Dettaglio') }}"> <i class="fas fa-edit"></i></a>
                                <button 
                                    class="btn btn-sm btn-info btn-md rounded-0 ml-1 text-white" 
                                    wire:click="duplicateSchema({{ $schema->id }})"
                                    title="{{ __('Duplica schema') }}">
                                    <i class="fas fa-copy"></i>
                                </button>
                                <button 
                                    class="btn btn-sm btn-danger btn-md rounded-0 ml-1" 
                                    onclick="confirm('Are you sure you want to delete this schema?') || event.stopImmediatePropagation()" 
                                    wire:click="deleteSchema({{ $schema->id }})"
                                    title="{{ __('Elimina schema') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else 
                <tr>
                    <td colspan="100%" class="text-center"> No schema defined </td>
                </tr>
            @endif
        </tbody>    
    </table>

    <div class="pt-2 text-center">
        <p>
            this lines are added to check that the branch separation and and common parts updates work correctly.
        </p>
        <p>
            test for multiple commits....
        </p>
    </div>

    <div>
        A test to check if the automatic script is working for the auto merge and push to remote.
    </div>

    <script>
        let newValue = null;

        function editSchemaTitlePrompt( title ){
            newValue = null;
            var pv = prompt('Edit title', title);

            if( pv === null || pv === '' )
                return false;

            newValue = pv;
            return true;
        }

        function editSchemaDescriptionPrompt( description ){
            newValue = null;
            var pv = prompt('Edit description', description);

            if( pv === null || pv === '' )
                return false;

            newValue = pv;
            return true;
        }

    </script>
    <style>
        .action-btn {
            opacity: 0;
        }
        td:hover .action-btn {
            opacity: 1;
            cursor: pointer;
        }
    </style>
</div>
