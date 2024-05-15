<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreUserInterestRequest;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return response()->json([
            'token'=>$user->createToken($user->name)->plainTextToken
        ]);    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'=> $request->name,
            'profession'=>$request->profession,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $user->roles()->attach($request->role);
        UserInterest::create([
            'user_id'=>$user->id,
            'book_name'=>$request->book_name,
            'book_page'=>$request->book_page,
            'book_genre'=>$request->book_genre,
            'book_status'=>$request->book_status,
            'book_rating'=>$request->book_rating,
            'comment'=>$request->comment
        ]);
        return response()->json([
            'token'=>$user->createToken($user->name)->plainTextToken
        ]);
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
