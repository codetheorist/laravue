@extends('layouts.app')

@section('content')
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="/" class="logo" style="line-height: 52px; height: 52px;" exact>
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TT</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Takeaway</b>Town</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" style="line-height: 22px;" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="/images/default.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                @if(Auth::user())
                  <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                @endif
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  <main style="height: calc(100vh - 52px); display: table; width: 100%;">
    <div id="warning" style="display: table-cell; vertical-align: middle; text-align: center; width: 100%;"><h1>You've got Javascript turned off<br><small>Why not turn it on and find out what you're missing.</small></h1><p>You won't be able to access any admin features of the site without Javascript turned on.</p></div>
  </main>
  </div>
@endsection
