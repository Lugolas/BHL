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
        $emails = Avatars::get()->pluck('link','mail')->toArray();
        return view('userprofile',['emails' => $emails]);
    }
    
    public function getAvatar(){
        
    }
}
