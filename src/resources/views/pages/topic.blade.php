@extends('layouts.app')

@section('content')

    <div class="divide-y text-white bg-neutral-700 flex-grow">
        <div class="text-center flex justify-between items-center m-4 md:mx-16 lg:mx-48">
            <img class="h-20" src="{{asset( $topic->topicIcon->path )}}" alt="Icone Secundário">

            <div class="flex justify-end flex-wrap gap-2">
                @if(!Auth::check() || Auth::user()->getFirstUnansweredQuestion($topic))
                <a
                    href="{{route('quiz', $topic->id)}}"
                    class="border-2 px-6 py-1 bg-cyan-600 text-white font-semibold text-l hover:bg-cyan-600/80  focus:bg-cyan-700"
                >
                    VALIDAR CONHECIMENTOS
                </a>
                @endif

                <a
                    href="{{route('home')}}"
                    class="border-2 px-6 py-1 bg-white text-black font-semibold text-l hover:bg-white/80  focus:bg-white/90"
                >
                    VOLTAR
                </a>
            </div>
        </div>

        <div>
            <div class="flex flex-col mx-4 md:mx-16 lg:mx-48" style="line-height: 3em">
                <p class="text-xl font-bold mt-5">
                    {{$topic->title}}
                </p>
                @if($topic->brief != "")
                    <p class="text-l font-semibold mt-1">
                        {{$topic->brief}}
                    </p>
                @endif

                @each('partials.post', $topic->posts()->orderBy('order_id')->get(), 'post')
            </div>
        </div>
    </div>
@endsection
