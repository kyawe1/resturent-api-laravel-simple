<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Login()
    {
        $validated_data = request()->validate([
            'email' => 'string|email|required',
            'password' => 'string|required'
        ]);

        if (Auth::attempt($validated_data, false)) {

            $token = request()->user()->createToken(request()->user()->name);

            return response()->json([
                'token' => $token->plainTextToken
            ]);
        }
        return response()->json([
            "message" => "error"
        ]);
    }
    public function register()
    {
        try {
            $validated_data = request()->validate([
                'email' => 'string|email|required',
                'password' => 'string|required',
                'name' => 'string|required'
            ]);
            $validated_data["password"] = Hash::make($validated_data["password"]);

            $user = User::create($validated_data);

            $user->save();
            return response()->json([
                "message" => "Your user is created"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "BadRequest"
            ]);
        }
    }
    public function check_authenticated()
    {
        try{
            $bool=Auth::check();
            return response()->json([
                "data"=>true
            ]);
        }catch (\Exception $e){
            return response()->json([
                "data"=>true
            ]);
        }
        
    }
    public function signout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "message"=>"token is not usable"
        ]);
    }
}
