<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function index(){
         $user = User::get();
         return send_success('success', $user);
    }
    
     public function login(Request $request){

            $cadential = $request->only('email','password');
            $validator = Validator::make($cadential,[
                'email'=>'required',
                'password' => 'required'
            ]);

              
           if($validator->fails()){
               return send_error('validation error',$validator->errors(), 422);
           }
           


           if(Auth::attempt($cadential)){
                $user = Auth::user();
                $data['name'] = $user->name;
                $data['access_token'] = $user->createToken('accessToken')->accessToken;

                return send_success('You are login successfully!', $data );
           }else{
               return send_error('Unauthorized','', 401);
           }
     }

     public function register(Request $request){
            
           $validator = Validator::make($request->all(),[
                 'name'=>'required',
                 'email'=>'required|email|unique:users',
                 'password' => 'required'
           ]);

           if($validator->fails()){
                return send_error('validation error',$validator->errors(), 422);
           }


           try {
                $users = new User();
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = Hash::make($request->password);
                $users->save();

                $data = [
                   'name' => $users->name,
                   'email' => $users->email,
                ];
                return send_success('User Resgister Success', $data );

           } catch (\Throwable $th) {
               return send_error($th->getMessage(), $th->getCode());
           }   
     }



     public function logout(Request $request){
          auth()->user()->token()->revoke();
          return send_success('successfully logout!', '');
     }


     public function show($id){
          $user = User::find($id);
          if($user){
            return send_success('Success', $user );
          }else{
              return send_error('user not found');
          }
         
     }
}
