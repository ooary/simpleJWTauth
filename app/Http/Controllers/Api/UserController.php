<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //retrive User profile from db 

    public function profile(Request $request){
    	return $request->user();
    }
}
