<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    //

    public function signUp(Request $request){

    	/**
    	 *
    	 * VALIDASI USER
    	 *
    	 */
    	$this->validate($request,['username'=>'required',
    							  'email'=>'required|email',
    							  'password'=>'required']);
    	// dd($request->all());
    	/**
    	 *
    	 * CREATE USER
    	 *
    	 */
    	
    	User::create(['username'=>$request->get('username'),
    				  'email'=>$request->get('email'),
    				  'password'=>bcrypt($request->get('password'))]);


    	return Response()->json(['statusCode'=>'200']);    	
    }

    public function signIn(Request $request){
    	/**
    	 *
    	 * VALIDATE CREDENTIAL
    	 *
    	 */
    	$this->validate($request,['username'=>'required',
    							  'password'=>'required']);
    	 // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            /**
             *
             * KALO BERHASIL BAKAL KE SIMPEN KE VARIABEL $TOKEN
             *
             */
            
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        // RETURN DATA
        return response()->json(['token'=>$token,
        						  'userData'=>$request->user()]);
    }
}
