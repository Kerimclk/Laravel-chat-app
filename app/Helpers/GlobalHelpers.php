<?php 

namespace App\Helpers;

use App\Friends;
use Illuminate\Support\Facades\Auth;

class GlobalHelpers
{
	public static function GetNotificationCount()
	{
		return Friends::where('request_receiver', Auth::user()->id)
		        ->where('confirm',false)
		        ->count();
	}
}