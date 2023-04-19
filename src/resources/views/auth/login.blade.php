    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/temp.png') }}">

    <title>DEI | Entrar</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<style>
    .alert {
        padding: 20px;
        background-color: #aa0404;
        /* Red */
        color: white;
        margin-bottom: 15px;
    }
    .success {
        padding: 20px;
        background-color: #04AA6D;
        /* Red */
        color: white;
        margin-bottom: 15px;
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
</style>
<body class="antialiased bg-cyan-700">
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
<div class="flex flex-col lg:min-h-screen items-center justify-center">
    <a href="/" class="text-6xl text-white font-bold my-4">
        <img src="/img/temp.png" alt="home" class="max-h-32 md:max-h-52">
    </a>

    <div class="flex flex-col bg-white p-4 sm:p-8 rounded-xl w-11/12 max-w-2xl min-w-fit mb-8">
        <h2 class="text-3xl font-bold text-center">Login</h2>
        <form action="{{ route('login') }}" method="post" class="my-4">
            @csrf

            <div class="my-4">
                <label for="email" class="sr-only">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Email UP"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2"
                >
            </div>

            <div class="my-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Password"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2"
                >
            </div>
            <div class="flex flex-row justify-center">
                <button type="submit" class="bg-cyan-300 p-3 rounded-lg w-2/5 mt-4 hover:bg-cyan-500 transition ease-in-out">
                    Entrar
                </button>
            </div>

        </form>

        <a href="{{ route('register') }}" class="underline text-center hover:text-cyan-500 trasition ease-in-out">Ainda não tens conta? Cria aqui</a>
        <a href="{{ route('recover') }}" class="underline text-center hover:text-cyan-500 transition ease-in-out">Esqueceu-se da senha? </a>

    </div>
</div>
</body>
</html>
