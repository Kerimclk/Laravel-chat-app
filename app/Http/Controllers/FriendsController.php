<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Friends;
use App\Helpers;

class FriendsController extends Controller
{
    public function index()
    {  
    	$login_user_id = Auth::user()->id;
        
        $users_list = User::where('id','!=',$login_user_id)->select('id')->get();


        $arkadas_eklene_bilecekler_listesi = [];

        foreach ($users_list as $item) 
        {
            //select count(id) as 'count' from friends where request_sender = 2 or request_receiver = 2;

            $arkadasOlarakEklenebilirMi = Friends::where(function($hede) use ($item)
            {
                $hede->where('request_sender', $item->id)
                ->orWhere('request_receiver', $item->id);
            })->where('confirm', true)->first();

            
            
            if($arkadasOlarakEklenebilirMi == null)
            {
                array_push($arkadas_eklene_bilecekler_listesi, [$item->id]);
            }
        }

        $users = User::find($arkadas_eklene_bilecekler_listesi);

    	return view('friends',compact('users'));
    }

    public function Add($id)
    {

    	$item = new Friends();
    	$item->request_sender = Auth::user()->id;
    	$item->request_receiver = $id;
    	$item->confirm = false;
    	$item->save();

    	return redirect('home');
    }

    public function notification()
    {
    	$request_list = Friends::where('request_sender', '!=', Auth::user()->id)
        ->where('request_receiver',Auth::user()->id)
        ->where('confirm',false)
        ->select('id','request_sender')
        ->get();

        $request_senders = [];

        foreach ($request_list as $item) 
        {
            $user = User::where('isActive',true)->find($item->request_sender);

            array_push($request_senders, ['friend_id'=>$item->id, 'name' => $user->name]);
        }

    	return view('notification',compact('request_senders'));
    }

    public function confirm($id)
    {
    	$item = Friends::find($id);
    	$item->confirm = true;
    	$item->save();

    	return redirect('friends/notification');
    }
}
