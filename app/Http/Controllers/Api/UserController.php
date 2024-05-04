<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }


    public function destroy(string $id)
    {
        //
    }
    public function authUser(UserLoginRequest $request)
    {
        $validateUser = $request->validated();
        $user = User::where('email',$validateUser['email'])->first();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'user not exits',
            ],401);
        }

         if(!Hash::check($validateUser['password'],$user->password)){
             return response()->json([
                 'status'=>false,
                 'message'=>'password are incorrect',
             ],401);
         }

         $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token' => $token],200) ;
    }

    public function createUser(UserRegistrationRequest $request)
    {

        $validateUser = $request->validated();

        $validateUser['password'] = bcrypt($validateUser['password']);
        $user =  User::create($validateUser);
        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token],200);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(null,Response::HTTP_NO_CONTENT);
        //$request->user()->currentAccessToken()->delete();
    }
}
