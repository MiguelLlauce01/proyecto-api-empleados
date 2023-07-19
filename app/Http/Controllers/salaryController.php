<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalarySaveRequest;
use App\Http\Requests\SalaryUpdateRequest;
use App\Http\Resources\salaryResource;
use App\Models\Salary;
use Illuminate\Http\Request;

class salaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA LISTAR todos los registros con cierta condición
    public function index()
    {
        //Listar los salarios que se encuentren "ACTIVOS" del modelo "Salary"
        $result = Salary::where('state', 'ACTIVE')->get();/*"state" es el nombre de la columna 
                                                            y "ACTIVE" es el estado de la columna state que debe de cumplirse*/
        //Retornar el resultado: 
        return salaryResource::collection($result);//"salaryResource" hace que el formato JSON sea más facil de consumir
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA CREAR un nuevo salario
    public function store(SalarySaveRequest $request)
    {
        //Registrar un nuevo salario
        $salary = Salary::create($request->all());
        //Retornar el salario creado:
        return new salaryResource($salary);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA extraer información de un salario por ID
    public function show(Salary $salary)
    {
        return new salaryResource($salary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ACTUALIZAR el registro del salario por ID
    public function update(SalaryUpdateRequest $request, Salary $salary)
    {
        //
        $salary-> update($request->all());
        //Retornamos el nuevo salario actualizado
        return new salaryResource($salary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ELIMINAR el registro de un salario(actualizar el estado de "ACTIVO" a "INACTIVO")
    public function destroy(Salary $salary)
    {
        //Lo recomendable es cambiar el estado del registro
        if ($salary) $salary->update(['state'=>'DELETE']);
        //Dar respuesta cuando se a eliminado el registro correctamente.
        return response()->noContent();
    }
}