<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('fields', function (Blueprint $table) { 
            $table->id();
            $table->integer('table_id');
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('cmpType')->nullable();
            $table->string('dataType')->nullable();
            $table->string('length')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('primary')->nullable();
            $table->tinyInteger('required')->nullable();
            $table->tinyInteger('fillable')->nullable();
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
        Schema::dropIfExists('fields');
    }
}
