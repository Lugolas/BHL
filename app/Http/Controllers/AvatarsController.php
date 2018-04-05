<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddFormRequest;
use App\Http\Requests\ModifyFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

use App\User;
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
        $sortie = NULL;
        $user = User::where('email',$mail)->first();
        if (is_null($user)){
            return $sortie;
        }
        $listAvatars = $user->avatars;
        
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
            $response->mail = str_replace('/', '', hash('sha256',$request->input('mail')));
            $response->mail_aff = $request->input('mail');
            $link = 'https://bhlprojet-lbarbe.c9users.io/BHLprojet/resources/assets/images/'.$input['imagename'];
            $response->link = $link;
            $response->users_id = Auth::user()->id;
            if(!$response->save()){
                return redirect('/profile');
            }else{
                return redirect()->back();
            }
            
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
        if(is_null($link)) $link = 'https://bhlprojet-lbarbe.c9users.io/BHLprojet/resources/assets/images/noAvatar.png';
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
     * @return \Illuminate\Http\Response
     */
    public function update(ModifyFormRequest $request)
    {
        $validator = Validator::make($request -> all(), $request->rules(), $request -> messages());
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors());
        }
        if($validator->passes())
        {
            $avatar = Avatars::where('mail', $request->input('mail'));
            $image = $request->file('image');
            $input['imagename'] = date('dnyHis').$image->getClientOriginalName();
            $destinationPath = resource_path().'/assets'.'/images/';
            $image->move($destinationPath, $input['imagename']);
            $link = $input['imagename'];
            $link = 'https://bhlprojet-lbarbe.c9users.io/BHLprojet/resources/assets/images/'.$link;
            $avatar->update(['link' => $link]);
            return redirect('/profile');
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
        $data = Input::get('ch');
        if(!is_null($data)){
            foreach($data as $id)
            {
                $avatar = Avatars::where('mail', '=', $id)->delete();
            }
        }
        return redirect('/profile');
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
}
