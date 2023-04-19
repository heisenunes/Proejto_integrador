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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DEI | Registar</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<style>
    .alert {
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
    <div class="alert text-center">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        {{-- @if( session('status') == 'verification-link-sent')
            Email foi reenviado!

        @endif --}}
        {{Session::get('status')}}
    </div>
@endif
<div class="flex flex-col lg:min-h-screen items-center justify-center">
    <a href="/" class="text-6xl text-white font-bold my-4">
        <img src="/img/temp.png" alt="home" class="max-h-32 md:max-h-52">
    </a>


    <div class="flex flex-col bg-white p-4 sm:p-8 rounded-xl w-11/12 max-w-2xl min-w-fit mb-8">
        <div class= "flex row justify-center">
            <img src="/img/email_verification_icon.png" alt="email_verification_icon" width="200" height="200">
        </div>
        <h2 class="text-3xl font-bold text-center">Email de verificação enviado!</h2>
        <div class="mt-4 text-center">
            <p class="text-l mb-2">Enviamos um e-mail para </p>
            <p class="text-l font-bold">{{ $email }}</p>
            <p class="text-l mt-2">Verifique o seu e-mail endereço e ative a sua conta. </p>
            <p class="text-l mt-2">O link no e-mail expirará nas próximas 24 horas.</p>

            {{-- <p class="text-l">Por favor, verifique a sua caixa de entrada</p>
            <p class="text-l">para validar o registo da conta. </p> --}}
        </div>

        <p class="mt-10 text-center mb-2">Clique no botão abaixo se não recebeu o e-mail.</p>
        <form action="{{ route('verification.send') }}" method="post" class="flex row justify-center">
            @csrf
            <input type="text" name="email" id="email" placeholder="email" value="{{ $email }}"
            hidden
            >
            <button type="submit" class="bg-cyan-300 p-3 rounded-lg w-2/5 mt-4 hover:bg-cyan-500 transition ease-in-out">
                Reenviar
            </button>
        </form>
        {{-- <a href="{{ route('verification.send') }}" class="underline text-center">Clique aqui para reenviar</a> --}}
    </div>
</div>
</body>
</html>
