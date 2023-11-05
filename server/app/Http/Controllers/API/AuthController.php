<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends BaseController
{
    public function register(RegisterRequest $request) {
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
        } catch (\Throwable $th) {
            return $this->sendError(500, 'Register user failed.');
        }

        try {
            $token =  $user->createToken('MyApp')->accessToken;
            $success = [
                'token' => $token,
                'name' => $user->name,
            ];
    
            return $this->sendResponse(200, 'User register successfully.', $success);
        } catch (\Throwable $th) {
            return $this->sendError(401, 'Register user success but login failed.', $th->getMessage() );
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
     public function login(LoginRequest $request)
     {
        try{
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $token =  $user->createToken('MyApp')->accessToken; 
                $success = [
                    'token' => $token,
                    'name' => $user->name,
                ];

                return $this->sendResponse(200, 'User login successfully.', $success);
            } 
            else{ 
                return $this->sendError(401, 'Unauthorised.', ['error'=>'Unauthorised']);
            } 
        } catch (\Throwable $th) {
            return $this->sendError(500, 'Register user failed.', $th->getMessage() );
        }
     }
}
