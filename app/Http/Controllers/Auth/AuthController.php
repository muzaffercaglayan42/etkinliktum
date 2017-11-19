<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/userekle';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'adsoyad' => 'required|max:255',
            'kartno' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'tip' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'adsoyad' => $data['adsoyad'],
            'kartno' => $data['kartno'],
            'email' => $data['email'],
            'tip' => $data['tip'],
            'password' => bcrypt($data['password']),
        ]);
    }
    function UserList(Request $request) 
    {   if ($request->search!='') {
        $etkinlik= Etkinlikler::whereRaw("ad ILIKE '%".$request->search."%' or yer ILIKE '%".$request->search."%'")->orderBy('created_at', 'asc')->paginate(5);
//echo "<pre>"; print_r($etkinlik); exit();
//whereRaw("ilisik_kesme.sicil_ogr_no ILIKE '%".$request->string."%' or ilisik_kesme.tc ILIKE '%".$request->string."%'".$filter1.$filter);


       return view('etkinlikislem',compact("etkinlik"));
    }else return view('etkinlikislem', [
            'etkinlik' => Etkinlikler::orderBy('created_at', 'asc')->paginate(5)
        ]);
        

        
    }
}
