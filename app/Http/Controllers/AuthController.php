<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller{

    public function login(Request $request){
        return view('auth/login');
    }

    public function do_login(Request $res){
        $rules = array(
            'email'            => 'required',
            'password'         => 'required'
        );

        $validator = Validator::make($res->all(), $rules);

        if ($validator->fails()) {
            $responseArr    = [
                'status'     => false,
                'error'      => $validator->errors()->toArray(),
                'message'    => 'Please fill all the details',
            ];

            $redirect = 'login';
        }else{
            if(\Auth::attempt($res->only('email','password'))){
                $responseArr = [
                    'status'  => true,
                    'message' => 'You are successfully logged in',
                ];

                $redirect = 'home';
            }else{
                $responseArr = [
                    'status'  => false,
                    'message' => 'Login details are not valid',
                ];

                $redirect = 'login';
            }
        }

        return redirect($redirect)->with(['responseData' => $responseArr]);
    }

    public function register(){
        return view('auth/register');
    }

    public function registerSave(Request $res){
        $rules = array(
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'phone_number'     => 'required|string|max:10',
            'password'         => 'required|string|min:8',
            're_password'      => 'required|min:8|same:password',
            'address'          => 'required',
        );

        $validator = Validator::make($res->all(), $rules);

        if ($validator->fails()) {
            $responseArr    = [
                'status'     => false,
                'error'      => $validator->errors()->toArray(),
                'message'    => 'Please fill all the details correctly',
            ];

            $redirect = 'register';
        }else{      
                  
            $user = User::create([
                'name'     => $res->name,
                'email'    => $res->email,
                'mobile'   => $res->phone_number,
                'address'  => $res->address,
                'password' => Hash::make($res->password),
            ]);

            $responseArr = [
                'status'  => true,
                'message' => 'You are successfully registered',
            ];

            $redirect = 'login';
        }

        return redirect($redirect)->with(['responseData' => $responseArr]);
    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('login');
    }
}
