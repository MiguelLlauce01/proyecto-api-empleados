<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleSaveRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Resources\roleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA LISTAR todos los registros de la tabla con cierta condicion
    public function index()
    {
        //Listar los roles que se encuentren "ACTIVOS" del modelo "Role"
        $result = Role::where('state', 'ACTIVE')->get();/*"state" es el nombre de la columna 
                                                            y "ACTIVE" es el estado de la columna state que debe de cumplirse*/
        //Retornar el resultado: 
        return roleResource::collection($result);//"roleResource" hace que el formato JSON sea más facil de consumir
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA CREAR un nuevo ROL
    public function store(RoleSaveRequest $request)
    {
        //Registrar un nuevo rol
        $role = Role::create($request->all());
        //Retornar el rol creado:
        return new roleResource($role);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA extraer información de un rol por ID
    public function show(Role $role)
    {
        return new roleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ACTUALIZAR el registro del rol
     public function update(RoleUpdateRequest $request, Role $role)
    {
        //
        $role-> update($request->all());

        //$role->update($request->validated());
      //  return response()->json("Rol actualizado", 200);
        //Retornamos el nuevo rol actualizado
        return new roleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    //MÉTODO PARA ELIMINAR el registro del rol(actualizar el estado de "ACTIVO" a "INACTIVO")
    public function destroy(Role $role)
    {
        //$role->delete($role);//Elimina el registro, pero no es recomendable
        //Lo recomendable es cambiar el estado del registro
        if ($role) $role->update(['state'=>'DELETE']);
        //Dar respuesta cuando se a eliminado el registro correctamente.
        return response()->noContent();
    }
    
}