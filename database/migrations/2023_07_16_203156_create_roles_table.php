<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('roles', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();//id autoincrementable 
            $table->string('rol');//nombre del rol
            $table->enum('state',['ACTIVE', 'DELETE'])->default('ACTIVE');//Estado del registro: Activo o eliminado; por defecto se registra como activo
            $table->timestamps();//Crea dos columnas: Fecha de registro y Fecha de actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
