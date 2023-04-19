@extends('layouts.panel')

@section('content')
    <section class="py-4 flex flex-col gap-6">

        <form method="post" action="{{ route('set_question_topic', [$question]) }}">
            @csrf

            <label for="topic" class="mt-4">
                <strong>Tópico</strong>
            </label>

            <div class="flex gap-4">
                <select
                    name="topic"
                    class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Topic"
                >
                    @foreach($topics as $topic)
                        <option
                            value="{{$topic->id}}"
                            class="text-gray-700"
                            @if($topic->id === $question->topic->id)
                                selected
                            @endif
                        >
                            {{$topic->title}}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Guardar</button>
            </div>
        </form>

        <div>
            <label for="question-content-input" class="font-bold">Título</label>
            <div id="question-content-div" class="flex gap-2 items-center justify-between">
                <h2 class="text-l">
                    {{ $question->content }}
                </h2>
                <button class="material-icons" id="edit-question-content-btn">edit</button>
            </div>

            <form
                id="edit-question-content-form"
                method="post"
                action="{{ route('question_content', [$question]) }}"
                class="flex gap-3 flex-1 hidden"
            >
                @csrf

                <input
                    name="content"
                    id="question-content-input"
                    type="text"
                    minlength="3"
                    maxlength="255"
                    value="{{ $question->content }}"
                    class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
                >

                <button class="material-icons" type="submit">
                    done
                </button>

                <button id="form-cancel" class="material-icons" type="button">
                    close
                </button>
            </form>
        </div>

        <table class="w-full text-left">
            <thead>
            <tr>
                <th class="w-2 py-2 text-center">Ordem</th>
                <th class="py-2">Respostas possíveis</th>
                <th class="py-2 text-center">Ações</th>
            </tr>
            </thead>

            <tbody>
            @foreach($answers as $answer)
                @php
                    $correct = $question->correct_answer_id === $answer->id
                @endphp

                <tr>
                    <th class="border-solid border-t border-t-gray-400 py-2 text-center">
                        <div class="grid-container">
                            {{-- BOTOES UP/DOWN--}}
                            @if ($answer->order_id != 1)
                                <form action="{{route('change_answer_up',[$question, $answer]) }}" method="post">
                                    @csrf
                                    <div class="material-icons-round">
                                        <button type="submit" class="hover:text-black">
                                            arrow_upward
                                        </button>
                                    </div>
                                </form>
                            @endif
                            @php
                                $last = $question->answers()->latest('order_id')->first();
                            @endphp
                            @if($last->order_id != $answer->order_id)
                                <form action="{{route('change_answer_down',[$question, $answer]) }}" method="post">
                                    @csrf
                                    <div class="material-icons-round">
                                        <button type="submit" class="hover:text-black">
                                            arrow_downward
                                        </button>
                                    </div>
                                </form>
                            @endif
                            {{--$answer->order_id--}}
                        </div>
                    </th>

                    <th class="@if($correct) text-green-400 font-bold @endif border-solid border-t border-t-gray-400 py-2"
                    >
                        {{ $answer->content }}
                    </th>

                    <th class="border-solid border-t border-t-gray-400 py-2 text-center">
                        <form
                            method="post"
                            action="{{ route('question_correct', [$question, $answer]) }}"
                            class="inline-block"
                        >
                            @csrf
                            <button type="submit" class="material-icons align-bottom @if($correct) text-gray-400 @endif"
                                    title="Set as correct answer"
                                {{ $correct ? 'disabled' : '' }}
                            >
                                done
                            </button>
                        </form>

                        <form
                            method="post"
                            action="{{ route('answer', [$answer]) }}"
                            class="inline-block"
                        >
                            @csrf
                            @method('DELETE')
                            <button class="material-icons align-bottom">
                                delete
                            </button>
                        </form>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form
            method="post"
            action="{{ route('question_answer', [$question]) }}"
            class="flex flex-col gap-2"
        >
            @csrf

            <label for="new-answer-input">Nova opção de resposta</label>
            <div class="flex gap-4">
                <input
                    id="new-answer-input"
                    class="bg-transparent border border-solid border-white rounded-lg p-1 w-full focus:border-cyan-600"
                    type="text"
                    name="answer"
                >

                <button type="submit">Submeter</button>
            </div>
        </form>
    </section>
@endsection
