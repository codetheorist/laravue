<?php

namespace App\Http\Controllers\Restauranter;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use App\Facades\Restauranter;
use App\RestaurantInvite;

class RestaurantStaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the members of the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurantModel = config('restauranter.restaurant_model');
        $restaurant = $restaurantModel::findOrFail($id);

        return view('restauranter.members.list')->withRestaurant($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $team_id
     * @param int $user_id
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy($restaurant_id, $user_id)
    {
        $restaurantModel = config('restauranter.restaurant_model');
        $restaurant = $restaurantModel::findOrFail($restaurant_id);
        if (!auth()->user()->isOwnerOfRestaurant($restaurant)) {
            abort(403);
        }

        $userModel = config('restauranter.user_model');
        $user = $userModel::findOrFail($user_id);
        if ($user->getKey() === auth()->user()->getKey()) {
            abort(403);
        }

        $user->detachRestaurant($restaurant);

        return redirect(route('restaurants.index'));
    }

    /**
     * @param Request $request
     * @param int $restaurant_id
     * @return $this
     */
    public function invite(Request $request, $restaurant_id)
    {
        $restaurantModel = config('restauranter.restaurant_model');
        $restaurant = $restaurantModel::findOrFail($restaurant_id);

        if( !Restauranter::hasPendingInvite( $request->email, $restaurant) )
        {
            Restauranter::inviteToRestaurant( $request->email, $restaurant, function( $invite )
            {
                // Mail::send('restauranter.emails.invite', ['restaurant' => $invite->restaurant, 'invite' => $invite], function ($m) use ($invite) {
                //     $m->to($invite->email)->subject('Invitation to join restaurant '.$invite->restaurant->name);
                // });
                // Send email to user
            });
        } else {
            return redirect()->back()->withErrors([
                'email' => 'The email address is already invited to the restaurant.'
            ]);
        }

        return redirect(route('restaurants.members.show', $restaurant->id));
    }

    /**
     * Resend an invitation mail.
     *
     * @param $invite_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resendInvite($invite_id)
    {
        $invite = RestaurantInvite::findOrFail($invite_id);
        Mail::send('restauranter.emails.invite', ['restaurant' => $invite->restaurant, 'invite' => $invite], function ($m) use ($invite) {
            $m->to($invite->email)->subject('Invitation to join restaurant '.$invite->restaurant->name);
        });

        return redirect(route('restaurants.members.show', $invite->restaurant));
    }

}
