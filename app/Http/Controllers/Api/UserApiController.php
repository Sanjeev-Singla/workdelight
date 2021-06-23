<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiBaseController;

class UserApiController extends ApiBaseController
{    
    /**
     * signupManually
     * 
     * params (email,password,name), request method: POST
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request){
        $validator = validator($request->all(), [
            'name'     => 'required|alpha|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return $this->sendSingleFieldError($validator->errors()->first(),201,201);
        }

        $inputs = $request->all();
        # Hashing password
        $inputs['password'] = \Hash::make($inputs['password']);

        $user = \App\Models\User::create($inputs);
        $user = \App\Models\User::find($user->id);
        $user['accessToken'] = $user->createToken('worksdelight')->accessToken;
        
        return $this->sendResponse($user,'Registeration Successful',200,200);
    }
    
    /**
     * login
     * 
     * params (email,password), request method: POST
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $user = \App\Models\User::where('email',$request->email)->first();
        $validator = validator($request->all(), [
            'email'         => 'required|email|exists:users,email',
            'password'      => 'required'
        ]);
        if($validator->fails()){
            return $this->sendSingleFieldError($validator->errors()->first(),201,201);
        }

        $inputs = $request->all();

        if(\Hash::check($inputs['password'],$user->password)){
            $user['accessToken'] = $user->createToken('worksdelight')->accessToken;
        }else{
            return $this->sendSingleFieldError('Invalid email or password',201,201);
        }

        return $this->sendResponse($user,'Login Successful',200,200);
    }
    
    /**
     * uploadFile
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'mimes:pdf',
        ]);
        
        
        if ($request->hasFile('file')) {
            $imagePath = $request->file('file');
            $imageName = $imagePath->getClientOriginalName();

            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
        }

       
        return response()->json('Image uploaded successfully');

    }

}
