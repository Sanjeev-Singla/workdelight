<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * changePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function changePassword(Request $request){
        if ($request->isMethod('post')) {
			$validator = validator($request->all(),\App\Http\Requests\Admin\AdminRequest::change_password());
		    if($validator->fails()){
                return back()->withErrors($validator);
            }

            $user = \App\Models\User::where('id', \Auth::user()->id)->first();
            if (!\Hash::check($request->current_password, $user->password)) {
                return redirect()->route("admin-change-password")->with('error','Invalid Current Password!');
            }

            $user->password = \Hash::make($request->new_password);
            $user->save();

            return redirect()->route("admin-change-password")->with('status','Password Changed Successfully!');
		}
		return view('admin.changePassword');
    }
}
