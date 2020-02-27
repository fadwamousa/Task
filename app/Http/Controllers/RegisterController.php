<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Device;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MyNotify;
class RegisterController extends Controller
{
    
    public $phone;
    public function register(Request $request){

        //validate 
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email||unique:users',
            'phone'        => 'required|numeric|min:11',
            'password'     => 'required|confirmed'
        ]);

        if($validator->fails()){
             return response()->json(['msg' => 'error' , 'data' => $validator->errors()]);
        }



        //create
        $user =  User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'phone'      => $request->phone

        ]);


        if($user){

            $user->api_token = Str::random(60);
            $device = Device::create([

                'device_id' => rand(),
                'user_id'   => $user->id

            ]);

            $user->save();

           //new MyNotify($user);

        }

        //response
       return response()->json([ 'msg'=>'Success' ,
                'data' => [
                'api_token'      => $user->api_token,
                'id'             => $user->id,
                'name'           => $user->name,
                'phone'          => $user->phone,
                'devices'=> Device::where('user_id',$user->id)->get()
                        ]]);//get all devices that belongs to this user


    }




    public function login(Request $request){

        //validator
        $validator = Validator::make($request->all(),
                        [
                            'phone'    => 'required',
                            'password' => 'required'
                    ]);

        if($validator->fails()){
            return response()->json(['msg' => 'error' , 'data' => $validator->errors()]);
        }

        //Get phone number and check if it is correct or Non-Correct
        $user = User::where('phone',$request->phone)->first();

        if($user->phone != $request->phone){
            return response()->json(['msg' => 'Error in validation','data'=>'Your mobile number not match in our system']);
        }

        //Get password and check if it is correct or Non

        if($user){
            if(Hash::check($request->password , $user->password)){
                Auth::login($user);

                //Redirect
               return response()->json([ 'msg'=>'Success' ,
                'data' => [
                'api_token'      => $user->api_token,
                'id'             => $user->id,
                'name'           => $user->name,
                'phone'          => $user->phone,
                'devices'=> Device::where('user_id',$user->id)->get()
                        ]]);//get all devices that belongs to this user
    }
        }
        }

       
        // Redirect 

        

    
   
}
