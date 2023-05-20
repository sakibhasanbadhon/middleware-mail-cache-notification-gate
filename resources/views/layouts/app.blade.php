<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

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


                            {{-- Notification system --}}

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <button style="outline: none;border:none; background:none">
                                        <i class="fas fa-bell">
                                            <span class="badge bg-danger"> {{ Auth::user()->unreadNotifications->count() }}</span>
                                        </i>
                                    </button>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end mr-5" aria-labelledby="navbarDropdown">

                                    @forelse (Auth::user()->unreadNotifications as $item)
                                        <a href="{{ route('up',$item->id) }}" class="dropdown-item {{ $item->read_at !=null ? 'bg-primary' : '' }}"> {{ $item->data['invoice_no'] }} - {{ $item->data['amount'] }}
                                           <br> <small> {{ $item->data['product'] }} </small>
                                        </a>

                                    @empty
                                        Nothing any Notification
                                    @endforelse


                                    @if (Auth::user()->unreadNotifications->count() > 0)
                                        <a href="{{ url('mark-read') }}">Mark as Read</a>
                                    @endif

                                </div>
                            </li>

                            {{-- end Notification system --}}



                            <li class="nav-item dropdown">
                                <li class="mt-4 mr-5"> {{ Auth::user()->name }} </li>

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    <button style="outline: none;border:none; background:none">
                                        <img class="rounded-circle position-relative" style="width: 50px;height:50px;" src="{{ Auth::user()->avatar != null ? asset('storage/images/'.auth()->user()->avatar)  : 'https://via.placeholder.com/80' }}" alt="">
                                        <span style="margin-top: 42px;" class="position-absolute top-90 start-75 translate-middle p-1 bg-success rounded-circle">
                                    </button>

                                </a>

                                <div class="dropdown-menu dropdown-menu-end mr-5" aria-labelledby="navbarDropdown">
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
</body>
</html>
