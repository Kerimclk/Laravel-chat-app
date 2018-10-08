<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\HomeHelper;
use App\Messages;

class MessageController extends Controller
{
    public function index($user_id){
        
        $users = HomeHelper::FriendsList();
        $from = Auth::user()->id;
        $receiver = $user_id;

        return view("home",compact('users','receiver'));
    }

    public function AjaxMessageSend(Request $request)
    {
        $message = new Messages();
        $message->from = $request->from;
        $message->receiver = $request->receiver;
        $message->text = $request->text;

        if(!$message->save()){
            return response()->json(['message'=>'fail']);
        }

        return response()->json(['message'=>'ok']);
    }

    public function getMessage(Request $request)
    {
        $from = $request->from;
        $receiver = $request->receiver;

        $messages = Messages::where(function($hede) use($from,$receiver){

            $hede->where('from',$from)->where('receiver',$receiver);

        })->orWhere(function($hede) use($from,$receiver){

            $hede->where('from',$receiver)->where('receiver',$from);

        })->get();

        return response()->json(['data'=>$messages],200);
        
    }
}
