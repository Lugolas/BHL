<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AvatarsController;
use App\Avatars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function openProfile()
    {
        $user = Auth::user()->id;
        if(is_null($user)) return redirect('/login');
        $emails = Avatars::select('link','mail','mail_aff')->where('users_id',$user)->get();
        return view('userprofile',['emails' => $emails]);
    }
    
}
