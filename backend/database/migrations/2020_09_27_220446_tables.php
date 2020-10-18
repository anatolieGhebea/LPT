<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tables', function (Blueprint $table) { 
            $table->id();
            $table->integer('schema_id');
            $table->string('tableName')->nullable();
            $table->string('model')->nullable();
            $table->string('modelNamespace')->nullable();
            $table->longText('modelExtraContent')->nullable();
            $table->string('controller')->nullable();
            $table->string('controllerNamespace')->nullable();
            $table->string('controllerPrependMethods')->nullable();
            $table->tinyInteger('createMigration')->nullable();
            $table->tinyInteger('createModel')->nullable();
            $table->tinyInteger('createController')->nullable();
            $table->tinyInteger('addTimestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('tables');
    }
}
