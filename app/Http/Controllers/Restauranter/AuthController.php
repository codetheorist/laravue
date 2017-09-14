<?php

namespace App\Http\Controllers\Restauranter;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Facades\Restauranter;
use App\RestaurantInvite;

class AuthController extends Controller
{

    /**
     * Accept the given invite
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptInvite($token)
    {
        $invite = Restauranter::getInviteFromAcceptToken($token);
        if (!$invite) {
            abort(404);
        }

        if (auth()->check()) {
            Restauranter::acceptInvite($invite);
            return redirect()->route('restaurants.index');
        } else {
            session(['invite_token' => $token]);
            return redirect()->to('login');
        }
    }

}
