@extends('layouts.panel')

@section('content')
    <section class="md:py-16">
        <div id="question-content-div" class="flex gap-2 items-center">
            <h2 class="text-xl my-2 ">
                Criar Nova Questão
            </h2>
        </div>

        <form
            id="create-question"
            method="post"
            action="{{ route('create_question_request')}}"
            class="flex flex-col gap-4 my-2"
        >
            @csrf

            <div>
                <label for="topic">
                    Registar questão neste tópico:
                </label>
                <select name="topic"
                        class="w-full px-3 py-1.5 text-gray-700 border border-solid border-gray-300 rounded"
                        aria-label="Default select example">
                    {{-- <option selected>Selecionar Tópico</option> --}}
                    @foreach($topics as $topic)
                        <option
                            value="{{$topic->id}}"
                            class="text-gray-700"
                        >
                            {{$topic->title}}
                        </option>
                    @endforeach

                </select>
            </div>

            <div>
                <label for="question-content">
                    Título:
                </label>
                <input
                    name="content"
                    id="question-content"
                    type="text"
                    minlength="3"
                    maxlength="255"
                    value="{{-- $question->content --}}"
                    class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
                >
            </div>


            <table class="w-full text-left">
                <thead>
                <tr>
                    <th class="py-2">Respostas Possíveis</th>
                    <th class="w-1/12">Resposta Correta</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <th class="border-solid border-t border-t-gray-400 py-2 text-center ">

                        <input type="text" name="answer1" id="answer1" placeholder="Resposta" value=""
                               class="bg-white text-black p-3 rounded-lg w-full border-2 "
                        >

                    </th>
                    <td class="border-solid border-t border-t-gray-400 py-2 text-center ">
                        <input type="radio" name="correct" value="answer1"/>
                    </td>
                </tr>
                <tr>
                    <th class="border-solid border-t border-t-gray-400 py-2 text-center ">

                        <input type="text" name="answer2" id="answer2" placeholder="Resposta" value=""
                               class="bg-white text-black p-3 rounded-lg w-full border-2 "
                        >

                    </th>
                    <td class="border-solid border-t border-t-gray-400 py-2 text-center ">
                        <input type="radio" name="correct" value="answer2"/>
                    </td>
                </tr>
                <tr>
                    <th class="border-solid border-t border-t-gray-400 py-2 text-center ">

                        <input type="text" name="answer3" id="answer3" placeholder="Resposta" value=""
                               class="bg-white text-black p-3 rounded-lg w-full border-2 "
                        >

                    </th>
                    <td class="border-solid border-t border-t-gray-400 py-2 text-center ">
                        <input type="radio" name="correct" value="answer3" checked/>

                    </td>
                </tr>

                </tbody>
            </table>


            <button type="submit" class="bg-cyan-600 p-3 rounded-lg w-full hover:bg-cyan-800">
                Criar Questão
            </button>
        </form>
    </section>
@endsection
