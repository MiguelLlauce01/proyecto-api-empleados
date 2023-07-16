<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeSaveRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\employeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA LISTAR todos los registros con cierta condición
    public function index()
    {        
        //Listar los Empleados que se encuentren "ACTIVOS" del modelo "Employee"
        $result = Employee::where('state', 'ACTIVE')->get();/*"state" es el nombre de la columna 
                                                            y "ACTIVE" es el estado de la columna state que debe de cumplirse*/
        //Retornar el resultado: 
        return employeeResource::collection($result);//"employeResource" hace que el formato JSON sea más facil de consumir
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA CREAR un nuevo Empleado
    public function store(EmployeeSaveRequest $request)
    {
        //Registrar un nuevo Empleado
        $employee = Employee::create($request->all());
        //Retornar el empleado creado:
        return new employeeResource($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA extraer información de un empleado por ID
    public function show(Employee $employee)
    {
        return new employeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ACTUALIZAR el registro del empleado
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        //
        $employee-> update($request->all());
        //Retornamos el nuevo empleado actualizado
        return new employeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ELIMINAR el registro del empleado(actualizar el estado de "ACTIVO" a "INACTIVO")
     public function destroy(Employee $employee)
    {
        //Lo recomendable es cambiar el estado del registro
        if ($employee) $employee->update(['state'=>'DELETE']);
        //Dar respuesta cuando se a eliminado el registro correctamente.
        return response()->noContent();
    }
}
