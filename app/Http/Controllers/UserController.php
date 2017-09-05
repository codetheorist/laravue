<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $response = User::paginate(20)->all();

        return response($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::user()->id) {
            return response('You can\'t delete yourself.', 403);
        }

        if ($user->id != Auth::user()->id) {
            $user->delete();
        }

        return response($user);
    }

    public function show(Request $request)
    {
        $response = [];
        $response['user'] = $request->user();

        return $response;
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'username'  =>  'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|',
        ];

        $this->validate($request, $rules);

        $user = $request->user();
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->save();

        return response()->json(compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'new_password'          =>  'required',
            'confirm_new_password'  =>  'required|same:new_password'
        ];

        $this->validate($request, $rules);

        $user = $request->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->saveOrFail();

        return response()->json(compact('user'));
    }
}
