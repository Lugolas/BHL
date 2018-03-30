<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

use App\Avatars;

class AvatarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mail)
    {
        // $user = User::where('email','=',$mail)->first();
        // $avatars = $user->avatars();
        
        $idMail = DB::table('users')
                    ->select('id')
                    ->where('email','=',$mail)
                    ->get();
                   
        $listAvatars = DB::table('avatars')
                        ->select('mail','link')
                        ->where('users_id','=',$idMail[0]->id)
                        ->get();
       
         for ($i = 0; $i < sizeof($listAvatars); $i++) {
              $sortie[$listAvatars[$i]->mail] = $listAvatars[$i]->link;
         }
         
         return $sortie;
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddFormRequest $request)
    {
        $validator = Validator::make($request -> all(), $request->rules(), $request -> messages());
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        if($validator->passes())
        {
            $image = $request->file('image');
            $input['imagename'] = date('dnyHis').$image->getClientOriginalName();
            $destinationPath = resource_path().'/assets'.'/images/';
            $image->move($destinationPath, $input['imagename']);
            $response = new Avatars();
            $response->mail = $request->input('mail');
            $link = $input['imagename'];
            $link = 'https://bhlprojet-lbarbe.c9users.io/BHLprojet/resources/assets/images/'.$link;
            $response->link = $link;
            $response->users_id = Auth::user()->id;
            $response->save();
            return "Formulaire bien rempli !";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $mail
     * @return \Illuminate\Http\Response
     * 
     * Retourne l'image lié à l'adresse mail passée en paramètre (API)
     */
    public function show($mail)
    {
        $link = Avatars::get()->where('mail',$mail)->pluck('link')->first();
        return Image::make($link)->response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request -> all(), $request->rules(), $request -> messages());
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        if($validator->passes())
        {
            $image = $request->file('image');
            $input['imagename'] = date('dnyHis').$image->getClientOriginalName();
            $destinationPath = resource_path().'/assets'.'/images/';
            $image->move($destinationPath, $input['imagename']);
            $response = new Avatars();
            $response->mail = $request->input('mail');
            $link = $input['imagename'];
            $link = 'https://bhlprojet-lbarbe.c9users.io/BHLprojet/resources/assets/images/'.$link;
            $response->link = $link;
            $response->users_id = Auth::user()->id;
            $response->save();
            return "Formulaire bien rempli !";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mail = $request->input('mail');
        $avatar = Avatars::where('mail', '=', $mail)->get();
        $avatar->delete();
        return "Deleted";
    }
    
    public function deleteAvatar(Request $request)
    {
        $mail = $request->input('mail');
        $avatar = Avatars::where('mail', '=', $mail)->delete();
        return "Deleted";
    }
    
    public function informations()
    {
        $j=0;
        $file = fopen("https://bhlprojet-lbarbe.c9users.io/BHLprojet/public/version.txt", "r");
        while(!feof($file))
        {
            $ligne = fgets($file);
    		if(!empty($ligne))
    		{
    			$tabLigne = explode("|", $ligne);
    			$apiVersion = $tabLigne[0];
    			$sizes = $tabLigne[1];
    	    	$defaultSize = $tabLigne[2];
    			$formats = $tabLigne[3];
    		}
        }
        fclose($file);
		$arrayJson =  array('APIVersion' => $apiVersion, 'sizes' => $sizes, 'defaultSize' => $defaultSize, 'formats' => $formats);
		return json_encode($arrayJson);
    }
    
    /*protected function removeBackSlash($url)
    {
        $tabUrl = explode('\\', $url);
        $link = "";
        foreach($tabUrl as $part)
        {
            $link = $link . $part;
        }
        echo $link;
    }*/
}
