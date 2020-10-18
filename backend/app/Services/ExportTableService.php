<?php 

namespace App\Services;

use App\Services\MigrationEncodeService;
use App\Services\ModelEncodeService;

use Illuminate\Support\Facades\Storage;

class ExportTableService {
    public $test =[ 
        'tableName',
        'model',
        'modelNamespace',
        'createModel',
    ];

    /**
     * 
     */
    public function exportTables( $schema  ){
        $ok = true;
        $errors = [];
        
        $ok = $ok && $this->createFolderStructure( $schema );
        if( count( $schema->tables ) < 1 ){
            return false;
        }
        
        foreach( $schema->tables as $tb ){
            // export migrations
            if( $tb->createMigration ){
                if( empty( $tb->tableName ) ){
                    $ok = false;
                    $errors[] = 'Requested migration for table [ id:'.$tb->id.'] but tableName is empty';
                } else if( count( $tb->fields ) < 1 ) {
                    // $ok = false;
                    // $errors[] = 'No fields defined for table [ '.$tb->tableName.']';
                    continue;
                } else {
                    $ok = $ok && $this->generateMigration($tb);
                }
            }

            // create models
            if( $tb->createModel){
                if( !empty( $tb->model ) ){
                    $this->generateModel($tb);
                } else {
                    $ok = false;
                    $errors[] = 'Requested model for table [ id:'.$tb->id.'] but model is empty';
                }
            }

        }

        return $ok;


    }

    /**
     * 
     */
    protected function generateMigration( $tb ){

        $migrationClass = MigrationEncodeService::magrationContent( $tb->tableName, $tb->fields, $tb->addTimestamp );

        if( !empty( $migrationClass ) ){
            $date = \Carbon\Carbon::now();
            $fileName = $date->format('Y_m_d_His').'_create_'.$tb->tableName.'_table.php';

            Storage::disk('public')->put('schemas/'.$tb->schema->title.'/migrations/'.$fileName, $migrationClass);
            return true;
        } 

        return false;
    }

    /**
     * 
     */
    protected function generateModel( $tb ){
        
        $modelClass = ModelEncodeService::modelContent( $tb->model, $tb->modelNamespace, $tb->tableName, $tb->fields );
        if( !empty( $modelClass ) ){
            $fileName = ucfirst($tb->model).'.php';

            $path = 'schemas/'.$tb->schema->title.'/Models';
            if( !empty( $tb->modelNamespace ) ){
                // create namespace folders
                $ns = $tb->modelNamespace;
                $folders = explode("\\", $ns);
                $subPath = '';
                $startAdding = false;
                foreach( $folders as $subf ){
                    if($startAdding ){
                        $subPath .='/'.$subf;
                    }

                    // add only subfolder after \Models
                    // App\Models -> non changes to original path
                    // App\Models\Extra\
                    if( $subf == 'Models' ){
                        $startAdding = true;
                    }
                }
                $path .= $subPath;
            }

            $path .= '/'.$fileName;

            Storage::disk('public')->put($path, $modelClass);
            return true;
        } 

        return false;
    }

    /**
     * 
     */
    protected function createFolderStructure( $schema ){

        $name = $schema->title;

        // re-create
        Storage::disk('public')->deleteDirectory('schemas/'.$name);

        // create schema folder
        Storage::disk('public')->makeDirectory('schemas/'.$name);

        // create migrations folder
        Storage::disk('public')->makeDirectory('schemas/'.$name.'/migrations');

        // create default models folder
        Storage::disk('public')->makeDirectory('schemas/'.$name.'/Models');

        return true;
    }

}