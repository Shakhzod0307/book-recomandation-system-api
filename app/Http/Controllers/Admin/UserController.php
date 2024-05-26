<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->validated()){
            $data = $request->validated();
            $user = new User();
            $user->name = $data['name'];
            $user->role_id = $request['role'];
            $user->profession = $data['profession'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['email']);
            $user->bio = $data['bio'];
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('users','public');
                $user->photo = $path;
            }
            $user->save();
            return back()->with('success', 'New User addedd successfully!');
        }
        return back()->with('error', 'Oops, Something went wrong!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return back()->with('success','User removed successfully!');
    }
}
