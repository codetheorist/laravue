<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exceptions\UserNotInRestaurantException;
use App\Restaurant;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request)
    {

        if ($request->input('name')) {
            $name = $request->input('name');
            $response = DB::table('restaurants')
            ->where('name', 'LIKE', '%' . $request->input('name') . '%')
            ->paginate(20);
            // [];

            // $users += User::where('')->paginate(20);
        } else {
            $response = Restaurant::paginate(20);
        }

        return $response;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restauranter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurantModel = config('restauranter.restaurant_model');

        $restaurant = $restaurantModel::create([
            'name' => $request->name,
            'owner_id' => $request->user()->getKey()
        ]);
        $request->user()->attachRestaurant($restaurant);

        return redirect(route('restaurants.index'));
    }

    /**
     * Switch to the given restaurant.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchRestaurant($id)
    {
        $restaurantModel = config('restauranter.restaurant_model');
        $restaurant = $restaurantModel::findOrFail($id);
        try {
            auth()->user()->switchRestaurant($restaurant);
        } catch ( UserNotInRestaurantException $e ) {
            abort(403);
        }

        return redirect(route('restaurants.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurantModel = config('restauranter.restaurant_model');
        $restaurant = $restaurantModel::findOrFail($id);

        if (!auth()->user()->isOwnerOfRestaurant($restaurant)) {
            abort(403);
        }

        return view('restauranter.edit')->withRestaurant($restaurant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurantModel = config('restauranter.restaurant_model');

        $restaurant = $restaurantModel::findOrFail($id);
        $restaurant->name = $request->name;
        $restaurant->save();

        return redirect(route('restaurants.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurantModel = config('restauranter.restaurant_model');

        $restaurant = $restaurantModel::findOrFail($id);
        if (!auth()->user()->isOwnerOfRestaurant($restaurant)) {
            abort(403);
        }

        $restaurant->delete();

        $userModel = config('restauranter.user_model');
        $userModel::where('current_restaurant_id', $id)
                    ->update(['current_restaurant_id' => null]);

        return redirect(route('restaurants.index'));
    }

}
