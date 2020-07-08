<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .profilePicture {
            width: 50px;
            height: 50px;
            border-radius: 85px;
            margin-right:5px;
        }
        .space_up{
            padding-top: 3%;
        }
        .dropCustom{
            width:300px;
            height:250px;
        }
        .profileSpace{
            width: 100%;
            height:80%;
            color:#efef;
        }
        .buttonFlex{
            padding-top:2%;
        }
        .goToProfile{
            margin-left:5%;
            width:40%;
        }
        .goToLogout{
            margin-right:5%; 
            width:40%;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('buku.index') }}">
                    {{ config('app.perpus', 'PerpusDigi') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="profilePicture" src="{{ Storage::url('img/user/'.auth()->user()->img) }}" alt="{{ auth()->user()->img }}">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu user-header text-center dropCustom" aria-labelledby="navbarDropdown">
                                    <div class="bg-secondary profileSpace">

                                        <div class="space_up"></div>
                                        
                                        <img class="mx-auto d-block rounded-circle" src="{{ Storage::url('img/user/'.auth()->user()->img) }}" alt="{{ Auth::user()->name }}" width="100px" height="100px">

                                        <div class="space_up"></div>
                                        
                                        <h5>
                                            {{ Auth::user()->name }}
                                        </h5>
                                        <p>
                                            Email : {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                    <div class="d-flex buttonFlex">
                                        <a href="{{ url('profil') }}" class="btn btn-outline-success p-2 goToProfile">👥 Profile</a>
                                        <div></div>
                                        <button class="btn btn-outline-danger ml-auto p-2 goToLogout" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            ❌ {{ __('Logout') }}
                                        </button>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>    
                    @endauth
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
