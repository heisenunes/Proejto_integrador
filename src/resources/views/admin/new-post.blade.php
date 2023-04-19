@extends('layouts.panel')

@section('content')
    <section class="md:py-16">
        <div id="post-content-div" class="flex gap-2 items-center">
            <h2 class="text-xl my-2 ">
                Criar Novo Artigo
            </h2>
        </div>


        <form class="flex flex-col" id="get-data-form" method="post" action="{{ route('create_post_request') }} ">
            @csrf

            <label for="topic" class="mt-4">
                <strong>Tópico</strong>
            </label>
            <select
                name="topic"
                class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                aria-label="Topic"
            >
                @foreach($topics as $topic)
                    <option value="{{$topic->id}}" class="text-gray-700">{{$topic->title}}</option>
                @endforeach
            </select>

            <label for="post-title" class="mt-4">
                <strong>Título do Artigo:</strong>
            </label>

            <input
                name="title"
                id="post-title"
                type="text"
                minlength="3"
                maxlength="255"
                class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
            >

            <label for="post-content" class="mt-4">
                <strong>Conteúdo:</strong>
            </label>
            <textarea name="content" style="min-height:600px;" id="myeditorinstance" cols="30" rows="10"></textarea>
            <input class="m-20 border-2 px-6 py-1 bg-cyan-600 text-white font-semibold text-l" type="submit"
                   value="Criar">
        </form>
        <script>
            document.querySelector('#myeditorinstance').addEventListener('change', function (event) {
                console.log(event.target.value);
            });

        </script>

    </section>
    <x-head.tinymce-config/>
@endsection
