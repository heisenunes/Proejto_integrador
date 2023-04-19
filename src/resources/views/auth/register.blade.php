<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/temp.png') }}">

    <title>DEI | Registar</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<style>
    .alert {
        padding: 20px;
        background-color: #aa0404;
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
        {{ session('status') }}
    </div>
@endif
<div class="flex flex-col items-center justify-center">

    <a href="/" class="text-6xl text-white font-bold my-4">
        <img src="/img/temp.png" alt="home" class="max-h-32 md:max-h-52">
    </a>

    <div class="flex flex-col bg-white p-4 sm:p-8 rounded-xl w-11/12 max-w-2xl sm:mb-8">
        <h2 class="text-3xl font-bold text-center">Registar</h2>
        <form action="{{ route('registerAccount') }}" method="post" class="my-4">
            @csrf
            <div class="my-4">
                <label for="name" class="sr-only">Nome</label>
                <input type="text" name="name" id="name" placeholder="Nome" value="{{ old('name') }}"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2 @error('name') border-red-500 @enderror">

                @error('name')
                <p class="text-red-400 ml-3"> {{ $message }} </p>
                @enderror
            </div>

            <div class="my-4">
                <label for="gender" class="sr-only">Género</label>
                <select name="gender" id="gender"
                        class="bg-gray-100 p-3 rounded-lg w-full border-2 @error('email') border-red-500 @enderror"
                >
                    <option value="" @if (!old('gender')) selected @endif>Género</option>
                    <option value="female" @if (old('gender') === 'female') selected @endif>Feminino</option>
                    <option value="male" @if (old('gender') === 'male') selected @endif >Masculino</option>
                    <option value="other" @if (old('gender') === 'other') selected @endif >Outro</option>
                </select>

                @error('gender')
                <p class="text-red-400 ml-3"> {{ $message }} </p>
                @enderror
            </div>

            <div class="my-4">
                <label for="email" class="sr-only">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Email UP" value="{{ old('email') }}"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2 @error('email') border-red-500 @enderror">

                @error('email')
                <p class="text-red-400 ml-3"> {{ $message }} </p>
                @enderror
            </div>

            <div class="my-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Password"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2 @error('password') border-red-500 @enderror">
                @error('password')
                <p class="text-red-400 ml-3"> {{ $message }} </p>
                @enderror
            </div>

            <div class="my-4">
                <label for="password_confirmation" class="sr-only">Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       placeholder="Confirmar Password"
                       class="bg-gray-100 p-3 rounded-lg w-full border-2 @error('password_confirmation') border-red-500 @enderror">

                @error('password_confirmation')
                <p class="text-red-400 ml-3"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="bg-cyan-300 p-3 rounded-lg w-full">
                Registar
            </button>
        </form>

        <a href="{{ route('login') }}" class="underline text-center">Já tens conta? Entra aqui</a>
    </div>
</div>
</body>

</html>
