<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Device;
use App\Notifications\MyNotify;
use App\Notifications\oneDevice;
use Illuminate\Support\Facades\Notification;
class NotifyController extends Controller
{
    //

    public function NotifyUsers(){

    	$users = User::all();
    	return view('notify',compact('users'));
    	

    }

    public function sendNotify(Request $request){

        //for all users in system

           $users = User::all();

           Notification::send($users, new MyNotify());

    }

    public function sendDeviceNotify(Request $request){


        // $users = $request->input('users');

        $users = User::with('devices')->get();

        $devices = Device::where('user_id',$request->users)->get();
        //dd($devices);
        Notification::send($devices, new oneDevice());
         

        //$devices = Device::where('user_id',$request->users)->get();
        /*$array   = array();
            $devices = Device::where('user_id',$request->users)->get();
            foreach ($devices as $device) {
               $arrayAll = array_push($array, ['id' => $device->id]);
               dd($arrayAll);
            }*/


               /*$arr = array();
               foreach ($users as $user){
                dd($user->devices);
                    foreach ($user->devices as $device) {

                        $a = array_push($arr,['id' => $device->id]);
                        dd($a);
                      
                    }*/


               // $user->notify(new oneDevice($request->toArray()));
              //  Notification::send($arr, new oneDevice());
                
               
               // $user->notify(new oneDevice());
//        }

       

    }
}
