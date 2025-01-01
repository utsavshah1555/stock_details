<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return redirect()->route('stocks-list');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $userData = [
                'email' => $input['email'],
                'password' => $input['password'],
            ];

            if (Auth::attempt($userData) == false) {
                return redirect()->route('stocks-list')->with('Error', 'Unautorized');
            }

            return redirect()->route('stocks-list')->with('success', 'User Logged In');
        } catch (\Exception $e) {
            Log::error("Error ", $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login-page');
    }

    public function logout_api()
    {
        // dd(Auth::guard('auth:api'));
        Auth::user()->token()->revoke();
        return $this->sendSuccess([], 'User Logout Successfully');
    }


    public function login_api(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()  // Return the validation errors
            ], 422); // HTTP status code for Unprocessable Entity
        }

        try {
            $userData = [
                'email' => $input['email'],
                'password' => $input['password'],
            ];

            if (Auth::attempt($userData) == false) {
                return $this->sendError('Invalid Credentials');
            }

            $user = Auth::user();
            $user['token'] = $user->createToken('LaravelApp')->accessToken;


            return $this->sendSuccess($user, 'Login Successfully');
        } catch (\Exception $e) {
            Log::error("Error ", $e->getMessage());
        }
    }
}
