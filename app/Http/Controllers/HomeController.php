<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
        return view('welcome');
    }
    
    public function formEmail($email=null)
    {
        if($email == null || $email == "")
            return view('addFormEmail');
        else
            return view('modifyFormEmail', ['email' => $email]);
    }
    public function deleteForm()
    {
        return view('deleteFormEmail');
    }
}
