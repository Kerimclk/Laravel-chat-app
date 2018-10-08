<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Friends;

class HomeHelper{


    // home page friends list
    public static function FriendsList(){

        $my_id =Auth::user()->id;
        $users = User::where('id','!=',$my_id)->select('id')->get();
        $friendsList = [];


        foreach ($users as $item) 
        {
            $arkadasMi = Friends::where(function($hede) use ($item)
            {
                $hede->where('request_sender',$item->id)->orWhere('request_receiver',$item->id);
            })->where(function($hede) use ($my_id){
                $hede->where('request_sender',$my_id)->orWhere('request_receiver',$my_id);
            })->where('confirm',true)->first();

            if ($arkadasMi != null) 
            {
                array_push($friendsList, [$item->id]);
            }
        }

        $users = User::find($friendsList);

        return $users;
    }

}