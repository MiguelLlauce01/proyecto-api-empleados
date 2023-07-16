<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    //Se agregó este código
    protected $fillable = ["id", "name", "apellido_paterno", "apellido_materno", "edad", "celular", "state", "rol_id"];

    public function getSalary()//Función para recuperar a todos los salarios de los empleados activos
    {
        return $this->hasMany(Salary::class, 'employee_id','id')
        ->where('state','ACTIVE');
    }

}
