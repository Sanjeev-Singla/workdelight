<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $validator = validator($request->all(), AdminRequest::login());
            if ($validator->fails()) {
                return \Redirect::back()->withErrors($validator)->withInput();
            }
            if (\Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
                return  \Redirect::route('home');
            }
            return \Redirect::to("/admin")->withSuccess('Opps! Invalid Credentials');
        }
        return \Redirect::to("/admin");
    }

    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/admin');
    }
}
