<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEI | 404</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body class="bg-cyan-700 flex flex-col h-screen justify-center text-white text-center">
<div class="flex flex-col gap-2 mx-auto p-6 m-4 border-2 rounded-lg bg-cyan-800">
    <h1 class="text-4xl mb-4">DEI</h1>
    <h2 class="font-bold text-6xl">404</h2>
    <p class="text-2xl">Página não encontrada</p>
    <img src="{{asset('img/quiz/dei_quiz_icones-39.png')}}" alt="Luís" class="h-64 mx-auto">
    <a href="/" class="text-xl bg-cyan-900 rounded-full border border-white/90 p-1 hover:bg-white/30  focus:bg-white/30">Voltar à página inicial</a>
</div>
</body>
</html>
