@extends('layouts.app')

@section('content')
    <div class="divide-y text-white flex-grow bg-neutral-700">
        <div class="flex flex-row justify-between items-center m-4 md:mx-16 lg:mx-48">
            <img class="h-20" src="{{asset( $question->topic->topicIcon->path )}}" alt="Icone Secundário">
            <a class="border-2 px-6 py-1 bg-white text-black font-semibold text-l hover:bg-white/80  focus:bg-white/90"
               href="{{route('topic.get',$question->topic_id)}}">VOLTAR</a>
        </div>

        <div>
            <div class="flex flex-col gap-6 m-4 md:mx-16 lg:mx-48">
                <p class="text-xl font-bold">
                    Validar Conhecimentos: {{$question->topic->title}}
                </p>

                <div class="border-2 p-2 py-8 text-center question-label">
                    <p>{{$question->content}} </p>
                </div>

                <div class="flex flex-col gap-6 mx-2 md:mx-8 lg:mx-16">
                    @if(!Auth::user()->answeredQuestion($question->id))
                        <form
                            method="post"
                            action="{{ route('submit_question', [$question]) }}"
                            class="flex flex-col gap-4"
                        >
                            @csrf

                            @each('partials.answer',$question->answers()->get(), 'answer')

                            <button class="border-2 px-8 py-2 mx-auto hover:bg-white/30  focus:bg-white/30"
                                    type="submit">
                                SEGUINTE
                            </button>
                        </form>
                    @else
                        @each('partials.answer',$question->answers()->orderBy('order_id')->get(), 'answer')

                        <a
                            href="{{route('quiz', $question->topic->id)}}"
                            class="border-2 px-8 py-2 mx-auto bg-neutral-800/80"
                        >
                            SEGUINTE
                        </a>
                    @endif

                    <div>
                        <img
                            class="h-32 mx-auto"
                            src="
                            @if(Auth::user()->answeredQuestion($question->id) )
                                {{asset('img/quiz/dei_quiz_icones-37.png')}}
                            @elseif(session()->has('wrongAnswer'))
                                {{asset('img/quiz/dei_quiz_icones-38.png')}}
                            @else
                                {{asset('img/quiz/dei_quiz_icones-39.png')}}
                            @endif
                            "
                            alt="Luís"
                        >
                    </div>
                </div>
                {{-- @dd(Auth::user()->answeredQuestion( Auth::user() ,$question->id)) --}}
            </div>
        </div>
    </div>

@endsection
