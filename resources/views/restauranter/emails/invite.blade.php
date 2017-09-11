You have been invited to join team {{$restaurant->name}}.<br>
Click here to join: <a href="{{route('restaurants.accept_invite', $invite->accept_token)}}">{{route('restaurants.accept_invite', $invite->accept_token)}}</a>
