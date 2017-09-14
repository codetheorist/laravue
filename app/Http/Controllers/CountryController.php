<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        $countries = Country::all();


        return $countries;
    }

}
