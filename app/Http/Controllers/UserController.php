<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {

        if ($request->input('name')) {
            $name = $request->input('name');
            $response = DB::table('users')
            ->where('username', 'LIKE', '%' . $request->input('name') . '%')
            ->orWhere(function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->input('name') . '%');
            })
            ->paginate(20);
            // [];

            // $users += User::where('')->paginate(20);
        } else {
            $response = User::paginate(20);
        }

        return $response;
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
        $response['roles'] = [];
        $response['permissions'] = [];

        // $count = 0;
        // foreach($request->user()->roles()->get() as $index => $role) {
        //     $response['roles'][] = $role->name;
        // }

        foreach($request->user()->roles()->get() as $index => $role) {
            $response['roles'][] = $role->name;
            foreach($role->perms()->get() as $i => $perm) {
                $response['permissions'][] = $perm['name'];
            }
        }
        $response['addresses'] = $request->user()->addresses()->get();
        return $response;
    }

    public function update(Request $request)
    {
        $rules = [
            'username'  =>  'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>  'required|email|',
            'occupation' => ''
        ];

        $this->validate($request, $rules);

        $user = $request->user();
        $user->username = $request->input('username');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->occupation = $request->input('occupation');
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
