<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{

    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->all());
        return response()->json(['message'=>'Role created successfully!']);
    }

    public function show(string $id)
    {
        return new RoleResource(Role::find($id));
    }

    public function update(UpdateRoleRequest $request,string $id)
    {
        $role = Role::find($id);
        $role->update($request->all());
        return response()->json(['message'=>'Role updated successfully!']);
    }

    public function destroy(string $id)
    {
        Role::destroy($id);
        return response()->json(['message'=>'Role deleted successfully!']);
    }
}
