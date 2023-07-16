<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //Se agregó este código
    protected $fillable = ["rol", "state"];

    public function getEmployee()//Función para recuperar a todos los empleados activos
    {
        return $this->hasMany(Employee::class, 'rol_id','id')
        ->where('state','ACTIVE');
    }
}
