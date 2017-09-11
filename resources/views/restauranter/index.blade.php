@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Restaurants
                        <a class="pull-right btn btn-default btn-sm" href="{{route('restaurants.create')}}">
                            <i class="fa fa-plus"></i> Create Restaurant
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurants as $restaurant)
                                    <tr>
                                        <td>{{$restaurant->name}}</td>
                                        <td>
                                            @if(auth()->user()->isOwnerOfRestaurant($restaurant))
                                                <span class="label label-success">Owner</span>
                                            @else
                                                <span class="label label-primary">Member</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(is_null(auth()->user()->currentRestaurant) || auth()->user()->currentRestaurant->getKey() !== $restaurant->getKey())
                                                <a href="{{route('restaurants.switch', $restaurant)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-sign-in"></i> Switch
                                                </a>
                                            @else
                                                <span class="label label-default">Current Restaurant</span>
                                            @endif

                                            <a href="{{route('restaurants.members.show', $restaurant)}}" class="btn btn-sm btn-default">
                                                <i class="fa fa-users"></i> Members
                                            </a>

                                            @if(auth()->user()->isOwnerOfRestaurant($restaurant))

                                                <a href="{{route('restaurants.edit', $restaurant)}}" class="btn btn-sm btn-default">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>

                                                <form style="display: inline-block;" action="{{route('restaurants.destroy', $restaurant)}}" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
