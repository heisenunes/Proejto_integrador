<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DEI | Guia de Acolhimento</title>

    <link rel="icon" href="{{ asset('img/temp.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

</head>
<style>
    /* The alert message box */
    .alert {
        padding: 20px;
        background-color: #aa0404;
        /* Red */
        color: white;
    }
    .success {
        padding: 20px;
        background-color: #04AA6D;
        /* Red */
        color: white;
    }

    /* The close button */
    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* When moving the mouse over the close button */
    .closebtn:hover {
        color: black;
    }

    .alert {
        opacity: 1;
        transition: opacity 0.6s;
        /* 600ms to fade out */
    }
    li:hover{
        color: cyan;
    }

</style>

<body class="antialiased bg-cyan-700 flex flex-col h-screen">
    <header>
        @if (session('status'))
            <div class="success text-center" role="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert text-center" role="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{ $errors->first() }}
            </div>
        @endif

        <nav class="p-4 flex justify-around text-white bg-cyan-600 items-center">
            <ul class="text-2xl">
                <li><a href='{{ route('home') }}'>DEI</a></li>
            </ul>

            <ul class="flex items-center gap-6">
                @if(Auth::user() && Auth::user()->isAdmin())
                    <li><a href="{{route('dashboard_main', 'default')}}">Painel de Admin</a></li>
                @endif
                    <li><a href='{{ route('contactos') }}'>Contactos</a></li>

                @auth
                    <li>
                        <img id="profile-picture" class="rounded-full h-10 ml-4"
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile Picture">

                    </li>
                    {{-- <li> --}}
                    {{-- <a href="{{ route('home') }}" class="font-semibold">{{ auth()->user()->name }}</a> --}}
                    {{-- </li> --}}
                    <li>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Sair</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Entrar</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    @yield('content')

</body>

</html>
