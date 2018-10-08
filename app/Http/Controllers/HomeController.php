<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Friends;
use App\User;
Use App\Helpers\HomeHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = HomeHelper::FriendsList();
        $receiver = $users[0]->id;
        if(!isset($receiver)){
            return redirect('friends');
        }

        return view('home',compact('users','receiver'));
    }

    public function profilDuzenle()
    {
        $user_data = User::find(Auth::user()->id);

        return view('profilDuzenle',compact('user_data'));
    }

    public function profilDuzenlePost(Request $request){

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect('profil-duzenle');
    }   

}
