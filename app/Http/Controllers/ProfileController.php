<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AvatarsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function openProfile()
    {
       
        
        $emails = "https://bhlprojet-lbarbe.c9users.io/BHLprojet/public/listAvatars/".Auth::user()->email;
        return view('userprofile',['emails' => $emails]);
    }
    
    public function getAvatar(){
        
    }
}
