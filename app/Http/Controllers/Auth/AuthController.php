<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
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
    protected $redirectTo = '/';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        if(\Auth::check())
        {
          DB::table('app_mode')->insert([
            ['user_id' => \Auth::user()->id, 'status' => 'simple_mode']
          ]);
        }

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
            'username' => 'required|max:255|unique:users,username',
            'password' => 'required|confirmed|min:6',
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
        // hash username
        $hashUsername = md5($data['username']);
        // hex hashed username
        $hexSeq = str_split(unpack('H*', $hashUsername)[1], 2);
        // get the knock sequence
        $sequence = '';
        for($j=0; $j<4; $j++)
        {
          $sequence[$j] = $hexSeq[$j]%4;
        }

        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'sequence' => serialize($sequence)
        ]);
    }
}
