<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OPPO') }}</title>
    <meta name="theme-color" content="#6777ef"/>
<link rel="apple-touch-icon" href="{{ asset('oppo.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp|Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"  rel="stylesheet">

  <!-- Styles -->
 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/spin.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

 
</head>
<body>
    @include('sweetalert::alert')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="bootstrap" viewBox="0 0 118 94">
    <title>Bootstrap</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
  </symbol>
</svg>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a  class="navbar-brand" href="{{ url('/') }}" >
                    {{ config('app.name', 'OPPO') }}
                </a>
                <!-- <a id="sidebarToggle" class="navbar-brand"> 
                    <button> sidebarButton </button>
                </a> -->
                <!-- for sidebar  -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ url('draw/index')}}" class="nav-link active">
                                Draw
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Setup
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('setup/distributor')}}">Distributor</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/store')}}">Store</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/product')}}">Products</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/import')}}">Import</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/present')}}">Present</a></li>                                
                                <li><a class="dropdown-item" href="{{ url('setup/event-setting')}}">Event Setting</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/department/list')}}">Department List</a></li>
                                <li><a class="dropdown-item" href="{{ url('setup/kpi-setting/list')}}">KPI Setting List</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownReportMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Report
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownReportMenuLink">
                                <li><a class="dropdown-item" href="{{ url('report/lucky-draw-result')}}">List of Lucky Draw Result</a></li>

                            </ul>
                        </li>
                    </ul>
                   

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->avatar)
                                    <img src = "{{ Auth::user()->avatar }}" alt="profile" class="img-fluid rounded-circle profile mx-1" style="width:35px;">
                                    @else
                                    <img src="{{asset('/user_profile/oppo.jpg')}}" alt="profile" class="img-fluid rounded-circle profile mx-1" style="width:35px;" />
                                    @endif
                                    <!-- {{ Auth::user()->name }} -->
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ url('/js/jquery3.5.1.js') }}" rel="javascript" type="text/javascript"></script> 
      <script src="{{ url('/js/bootstrap.min.js') }}"></script>
<!-- 
    <script src="{{ asset('js/sidebarloader.js') }}" rel="javascript" type="text/javascript"></script>
    <script src="{{ asset('js/sidebars.js') }}" rel="javascript" type="text/javascript"></script> -->
    <!-- <sript type="text/javascript">

        $(document).ready(function(){
            const sidebarToggle = document.querySelector("sidebarToggle");
            if(sidebarToggle){
                alert("exist");
            } else {
                alert("not exist");
            }
        });
    </script> -->
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ('serviceWorker' in navigator) {
  if (!navigator.serviceWorker.controller) {
    navigator.serviceWorker.register("/sw.js").then(function (reg) {
      console.log("Service worker has been registered for scope: " + reg.scope);
    });
  }
}

</script>

    
</body>
</html>
