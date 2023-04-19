@extends('layouts.app')

@section('content')
    <section class="text-center text-white px-6 py-6">
        <div class="">
            <img class="mx-auto h-24 md:h-32" src="{{ asset('img/temp.png') }}" alt="person">
        </div>

        <div>
            <h1 class="text-3xl font-bold my-2">Guia de Acolhimento DEI</h1>

            <p>Tudo o que precisas de saber sobre o Departamento de Engenharia Informática</p>
            <p>Aqui, começa o teu futuro!</p>
        </div>

        <div class="flex flex-wrap items-stretch items-start gap-8 justify-center mx-2 my-8 text-black font-medium">

            @foreach ($topics as $topic)
                @if($topic->active)
                    <a class="w-32 flex flex-col" href="{{route('topic.get',$topic->id)}}">
                        @if( Auth::user())
                        <div class=" @if($topic->isFinishedbyUser()) bg-yellow-500 @else bg-cyan-600 @endif min-h-[1em] relative rounded-t text-left px-2 py-1 gap-1 flex items-center">
                            {{-- <span>{{$topic->nrQuestionsAnsweredByUser()}}</span> --}}
                            @php
                                $nrCorrect = $topic->nrQuestionsAnsweredByUser();
                                $nrIncorrect = $topic->nrActiveQuestions() - $nrCorrect;
                            @endphp

                            @for($i =0; $i< $nrCorrect ; $i++)
                                <span class="h-2 w-2 border-4 outline outline-1 border-orange-500 outline-white inline-block rounded-full"></span>
                            @endfor
                            @for($j =0; $j< $nrIncorrect; $j++)
                                <span class="h-2 w-2 border-2 inline-block rounded-full"></span>
                            @endfor
                            @if( $topic->isFinishedbyUser())
                                <img class="h-12 absolute right-0" src="{{asset("img/other_icons/dei_quiz_icones-43.png")}}" alt="medal" style="margin-left: 6.5%">
                            @endif
                        </div>
                        @else
                        <div class="bg-cyan-600 rounded-t text-left px-2 py-1 gap-1 flex items-center">
                            @for ($i = 0; $i< $topic->questions->count(); $i++)
                                <span class="h-2 w-2 border-2 inline-block rounded-full"></span>
                            @endfor
                        </div>
                        @endif
                    <div class="bg-white rounded-b p-2 flex-1">
                        <img class="mx-auto" src="{{asset( $topic->topicLogo->path )}}" alt="Topic icon">
                        <p class="w-0 min-w-full break-normal whitespace-normal my-1"> {{ $topic->title }} </p>
                    </div>
                </a>
                @endif
            @endforeach


        </div>

        @if(Auth::user() && Auth::user()->finishedAllTopics->count() > 0)
            <button
                onclick="alert('Dirige-te á secretaria para mais informações!')"
                class="bg-gray-500 mt-4 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Receber Recompensa
            </button>
        @endif

    </section>
@endsection
