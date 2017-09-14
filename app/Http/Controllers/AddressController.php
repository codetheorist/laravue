<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    //Validating title and body field
        $this->validate($request, [
            'street'=>'required|max:100',
            'town'=>'required|max:100',
            'city'=>'required|max:100',
            'country'=>'',
            'postcode' =>'required|max:9',
            ]);

        $street = $request['street'];
        $town = $request['town'];
        $city = $request['city'];
        $country = $request['country'];
        $postcode = $request['postcode'];

        $address = $request->user()->addresses()->create(
            $request->only(
                'street',
                'town',
                'city',
                'country',
                'postcode'
            )
        );

    //Display a successful message upon save
        return response($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $me = Auth::user();

        if( $me->hasRole('Admin') ) {
            $address = Address::findOrFail($id);
        } else {
            $address = $me->addresses()->findOrFail($id);
        }

        $address->delete();

        return response('Done', 200);
    }
}
