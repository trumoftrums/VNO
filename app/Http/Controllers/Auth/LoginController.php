<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
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
    protected $redirectTo = '/admin/dashboard';

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
            //echo 'cai meo';exit();
            $rules = array(
                'username'    => 'required',
                'password' => 'required|alphaNum|min:1'
            );
            $uri = Request::path();
            $this->redirectTo =$uri;
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to($uri)
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
            }else{
                $userdata = array(
                    'username'     => Input::get('username'),
                    'password'  => Input::get('password'),
                    'status' =>'Actived'
                );
                if (Auth::attempt($userdata)) {
                    return Redirect::to("admin/dashboard");

                }
                else {
                    return Redirect::to($uri);

                }
            }
        }
        return view('Admin\Dashboard.login');
    }

    public function logout()
    {
        //Auth::logout();
        Session::flush();
        return Redirect::to('/');

    }

    public function loginFrontend()
    {
        if(Request::has('phone')){
            $rules = array(
                'phone'    => 'required',
                'password' => 'required|alphaNum|min:1'
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => true,
                    'message' => 'success'
                ]);
            }else{
                $userdata = array(
                    'phone'     => Input::get('phone'),
                    'password'  => Input::get('password'),
                    'status' =>'Actived'
                );
                if (Auth::attempt($userdata)) {
                    $id = Auth::id();
                    return response()->json([
                        'status' => true,
                        'message' => 'success',
                        'id' => $id
                    ]);
                }
                else {
                    return response()->json([
                        'status' => false,
                        'message' => 'wrong password or username'
                    ]);
                }
            }
        }
    }
}
