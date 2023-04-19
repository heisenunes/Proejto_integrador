@extends('layouts.panel')

@section('content')
    <section class="py-4 flex flex-col gap-6">
        <form
            action="{{route('edit_topic', $topic)}}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf

            <label for="title">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ $topic->title }}"
                class="bg-gray-600 p-3 rounded-lg h-1/3 self-center border-2 w-full @error('title') border-red-500 @enderror"
            >

            <div class="flex flex-col justify-center mt-2">
                <div class="flex justify-around gap-3">
                    <div class="group">
                        <p>Icone Principal</p>

                        <div class="relative">
                            <div class="hidden absolute group-hover:block top-2 right-2 cursor-pointer" id="pencil1">
                                <span class="material-icons">
                                    edit
                                </span>
                            </div>
                            <input
                                hidden
                                type="file"
                                accept="image/*"
                                name="homepageImage"
                                id="changeHomepageImage"
                                onchange="changeImage(this.value)"
                            >
                            <img
                                src="{{asset($topic->topicLogo->path )}}"
                                alt=""
                                class="h-40 py-2 col-start-1 row-start-1 cursor-pointer"
                                id="homepageImage"
                            >
                        </div>
                    </div>

                    <div class="group">
                        <p>Icone Secundário </p>
                        <div class="relative">
                            <div class="hidden absolute group-hover:block top-2 right-2 cursor-pointer" id="pencil2">
                                <span class="material-icons">
                                    edit
                                </span>
                            </div>
                            <input type="file" accept="image/*" name="iconImage" id="changeiconImage"
                                   style="display:none"
                                   onchange="changeImage2(this.value)">
                            <img src="{{asset($topic->topicIcon->path )}}" class="h-40 py-2" style="cursor: pointer;"
                                 id="iconImage" alt="">
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-cyan-600 p-3 rounded-lg h-1/3 hover:bg-cyan-800">
                    Guardar
                </button>
            </div>
        </form>

        <div>
            <h3>Artigos</h3>
            <table class="w-full">
                <thead>
                <tr>
                    <th>Ordem</th>
                    <th class="w-full">Título do Artigo</th>
                    <th>Activo</th>
                    <th>Acções</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td class="material-icons-round">
                            <div class="grid-container">
                                {{-- BOTOES UP/DOWN--}}
                                @if ($post->order_id != 1)
                                    <form action="{{route('change_post_up', $post->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="hover:text-cyan-300">
                                            arrow_upward
                                        </button>
                                    </form>
                                @endif
                                @php
                                    $last = \App\Models\Post::where('topic_id',  $post->topic->id )->latest('order_id')->first();
                                @endphp
                                @if($last->order_id != $post->order_id)
                                    <form action="{{route('change_post_down', $post->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="hover:text-cyan-300">
                                            arrow_downward
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                        <td class="text-left"> {{ $post->title }} </td>

                        <td class="material-icons-round">
                            <form action="{{route('change_post_active', $post->id) }}" method="post">
                                @csrf
                                <button type="submit">
                                    <span class="hover:text-cyan-300">
                                        @if($post->active)
                                            check_box
                                        @else
                                            check_box_outline_blank
                                        @endif
                                    </span>
                                </button>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('post_details', $post->id) }}"
                               class="material-icons-round text-white hover:text-cyan-300">edit</a>

                            <button id="edit-btn" class="material-icons-round text-white hover:text-cyan-300"
                                    onclick="changeDeleteValue({{$post->id}})">
                                delete_forever
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h3>Questões</h3>
            <table class="w-full">
                <thead>
                <tr>
                    <th>Ordem</th>
                    <th class="w-full">Conteúdo</th>
                    <th>Activo</th>
                    <th>Acções</th>
                </tr>
                </thead>

                <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td class="material-icons-round">
                            <div class="grid-container">
                                @if ($question->order_id != 1)
                                    <form action="{{route('change_question_up', $question->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="hover:text-cyan-300">
                                            arrow_upward
                                        </button>
                                    </form>
                                @endif
                                @php
                                    $last = \App\Models\Question::where('topic_id',  $question->topic->id )->latest('order_id')->first();
                                @endphp
                                @if($last->order_id != $question->order_id)
                                    <form action="{{route('change_question_down', $question->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="hover:text-cyan-300">
                                            arrow_downward
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </td>
                        <td class="text-left"> {{ $question->content }} </td>

                        <td class="material-icons-round">
                            <form action="{{route('change_question_active', $question->id) }}" method="post">
                                @csrf
                                <button type="submit">
                                <span class="hover:text-cyan-300">
                                    @if($question->active)
                                        check_box
                                    @else
                                        check_box_outline_blank
                                    @endif
                                </span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('question_details', $question->id) }}"
                               class="material-icons-round text-white hover:text-cyan-300">edit</a>

                            <button id="edit-btn2" class="material-icons-round text-white hover:text-cyan-300"
                                    onclick="changeDeleteValue2({{$question->id}})">
                                delete_forever
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script>
        document.querySelector('#homepageImage').addEventListener('click', function () {
            document.querySelector('#changeHomepageImage').click();
        })
        document.querySelector('#pencil1').addEventListener('click', function () {
            document.querySelector('#changeHomepageImage').click();
        })

        function changeImage() {
            document.getElementById("homepageImage").src = URL.createObjectURL(document.getElementById("changeHomepageImage").files[0]);
        }
    </script>
    <script>
        document.querySelector('#iconImage').addEventListener('click', function () {
            document.querySelector('#changeiconImage').click();
        })
        document.querySelector('#pencil2').addEventListener('click', function () {
            document.querySelector('#changeiconImage').click();
        })

        function changeImage2() {
            document.getElementById("iconImage").src = URL.createObjectURL(document.getElementById("changeiconImage").files[0]);
        }
    </script>

    {{-- MENSAGENS PARA CONFIRMAR APAGAR --}}

    <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="delete-overlay">
        <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold">Apagar Artigo?</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-delete"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <form method="post"
                  action="{{ route('delete_post' ) }}">
                @csrf
                <input type="text" name="email" id="email" value="{{Auth::user()->email}}" class="hidden" readonly>
                <input type="text" name="postId" id="postId-delete" value="" class="hidden" readonly>


                <div class="mt-2 text-sm text-left">
                    <p>Apagar todos os dados do Artigo?</p>
                    <p>Por favor confirme a sua password:</p>
                </div>
                <div class="mt-3 flex justify-end space-x-3">
                    <input type="password" name="password" id="password" placeholder="Password"
                           class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
                    >
                    <button class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">Apagar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('#delete-overlay')
            const delBtn = document.querySelectorAll('#edit-btn')
            const closeBtn = document.querySelector('#close-modal-delete')

            const toggleModal = () => {
                overlay.classList.toggle('hidden')
                overlay.classList.toggle('flex')
            }

            delBtn.forEach(element => {
                element.addEventListener('click', toggleModal)
            });


            closeBtn.addEventListener('click', toggleModal)
        })

        function changeDeleteValue(id) {
            document.getElementById('postId-delete').value = id
        }
    </script>

    <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="delete-overlay2">
        <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold">Apagar Questão?</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-delete2"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <form method="post"
                  action="{{ route('delete_question' ) }}">
                @csrf
                <input type="text" name="email" id="email" value="{{Auth::user()->email}}" class="hidden" readonly>
                <input type="text" name="questionId" id="questionId-delete" value="" class="hidden" readonly>


                <div class="mt-2 text-sm text-left">
                    <p>Apagar todos os dados da Questão?</p>
                    <p>Por favor confirme a sua password:</p>
                </div>
                <div class="mt-3 flex justify-end space-x-3">
                    <input type="password" name="password" id="password" placeholder="Password"
                           class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
                    >
                    <button class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">Apagar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('#delete-overlay2')
            const delBtn = document.querySelectorAll('#edit-btn2')
            const closeBtn = document.querySelector('#close-modal-delete2')

            const toggleModal = () => {
                overlay.classList.toggle('hidden')
                overlay.classList.toggle('flex')
            }

            delBtn.forEach(element => {
                element.addEventListener('click', toggleModal)
            });


            closeBtn.addEventListener('click', toggleModal)
        })

        function changeDeleteValue2(id) {
            document.getElementById('questionId-delete').value = id
        }
    </script>
@endsection
