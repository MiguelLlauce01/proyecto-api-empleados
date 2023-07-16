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
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();//id autoincrementable 
            $table->string('name');//nombre del empleado
            $table->string('apellido_paterno');//apellido paterno del empleado
            $table->string('apellido_materno');//apellido materno del empleado
            $table->integer('edad');//Edad del empleado
            $table->string('celular');//Celular del empleado
            $table->enum('state',['ACTIVE', 'DELETE'])->default('ACTIVE');//Estado del registro: Activo o eliminado; por defecto se registra como activo

            //Crear clave foranea y relación entre las tablas rol y empleado
            $table->integer('rol_id')->unsigned();//Campo para registrar el ID del rol que tiene el empleado
            $table->foreign('rol_id')->references('id')->on('roles');//Establecer clave foranea: Esto sirve para crear la relación uu xd.
            //En la linea anterior, se indica el nombre del "id" de la tabla con la cual se va hacer la relación,
            // así mismo también se indica el nombre de la table('roles').
            
            
            $table->timestamps();////Crea dos columnas: Fecha de registro y Fecha de actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
