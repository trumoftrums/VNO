<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function login()
    {
        if(Request::has('username')){
            $rules = array(
                'username'    => 'required',
                'password' => 'required|alphaNum|min:6'
            );
//            $data = Form::input('password', 'name', 'value');
//            var_dump($data);exit();
            $uri = Request::path();

            $validator = Validator::make(Input::all(), $rules);

            if ($validator->fails()) {
                return Redirect::to($uri)
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
            } else {

                // create our user data for the authentication
                $userdata = array(
                    'username'     => Input::get('username'),
                    'password'  => md5(Input::get('password')),
                    'status' =>'Actived'
                );


                if (Auth::attempt($userdata)) {

                    echo 'SUCCESS!';

                } else {
                    return Redirect::to($uri);

                }

            }
        }
        return view('Admin\Dashboard.login');
    }
}
