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
        Schema::create('salaries', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();//id autoincrementable 
            //$table->timestamps();//La fecha de registro del salario se crea por defaul en la últimacolumna
            $table->float('monto');//Monto del salario que le corresponde al empleado
            $table->enum('state',['ACTIVE', 'DELETE'])->default('ACTIVE');//Estado del registro: Activo o eliminado; por defecto se registra como activo

            //Crear clave foranea y relación entre las tablas empleado y salario
            $table->integer('employee_id')->unsigned();//Campo para registrar el ID del empleado al que pertenece el salario
            $table->foreign('employee_id')->references('id')->on('employees');//Establecer clave foranea: Esto sirve para crear la relación uu xd.
            //En la linea anterior, se indica el nombre del "id" de la tabla con la cual se va hacer la relación,
            // así mismo también se indica el nombre de la table('employees').
            
            
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
        Schema::dropIfExists('salaries');
    }
};
