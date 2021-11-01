<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordShipped;
use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role != 'admin'){
            return response([]);
        }
        if($request->for == 'project'){
            $items = User::where('role', 'client')->pluck('id','name');
        }else{
            $items = User::all();
        }


        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role != 'admin'){
            return response([]);
        }
        $dataArr = [
            'name'         => $request->name,
            'email'        => $request->email,
            'role'         => $request->role,
            'is_verified'  => 0,
            'password'     => Hash::make("пароль"),
        ];
        $item = new User($dataArr);
        $item->save();
        Mail::send(new ResetPasswordShipped($item->id));
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = User::find($id);
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\User  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role != 'admin' && $id != Auth::id()){
            return response([]);
        }
        $data = $request->all();
        if($request->password) {
        	if($id == Auth::id()){
		        $data['password'] = Hash::make($data['password']);
				$data['is_verified'] = 1;
	        } else {
        		abort(402,'Пароль возможно поменять только у себя');
	        }
        }
        if($request->photo)
        {
            $data['img_url'] = self::savePhoto($request->file('photo'), $id);
            unset($data['photo']);
        }
        return response()->json(User::find($id)->update($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
    public static function savePhoto($photo, $id = null)
    {
        if($id)
        {
            $user = User::find($id);
        }
        $file = $photo;
        $path = public_path('avatars');

        if(!is_dir($path)) {
            mkdir($path);
        }

        $img = \Image::make($file);
        $img->resize(2560, 2560, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $name =  md5(microtime()). '.jpg';
        if($id && $user->img_url)
        {
            unlink($path .'/'. $user->img_url);
        }
        $img->save($path .'/'. $name, 80, 'jpg');

        return $name;
    }
}
