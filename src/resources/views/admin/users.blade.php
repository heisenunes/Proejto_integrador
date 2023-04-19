@extends('layouts.panel')

@section('content')
    <script>
        activeSelector = document.querySelector(".sidebar a:nth-child(2)");
        activeSelector.classList.add("active");
        // console.log(activeSelector)
    </script>
    <div class="table-list">
        <h2 class="font-extrabold text-xl mt-16">Lista de Utilizadores</h2>
        <table class="mt-4">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Perguntas Respondidas</th>
                <th>Tópicos Terminados</th>
                <th>Opções</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->getAnsweredQuestions($user)}}</td>
                    <td>{{$user->finishedTopics()->count()}}</td>
                    <td>
                        <div class="material-icons-round">

                            @if($user->id != Auth::user()->id)
                                <button id="edit-btn" onclick="changeFormValue({{$user->id}}, {{$user->isAdmin()}} )"
                                        class="hover:text-cyan-300">
                                    @if($user->isAdmin())
                                        remove_moderator
                                    @else
                                        health_and_safety
                                    @endif
                                </button>

                                <button id="delete-btn" onclick="changeDeleteValue({{$user->id}})"
                                        class="hover:text-cyan-300">
                                    delete_forever
                                </button>
                            @endif

                        </div>

                    </td>
                </tr>
            @endforeach

            <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="overlay">
                <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-bold">Alterar Previlégios do Utilizador?</h4>
                        <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <form method="post" action="{{ route('change_user_privilege')}}">
                        @csrf

                        <input hidden type="text" name="email" id="email-privilege" value="{{Auth::user()->email}}" readonly>
                        <input hidden type="text" name="userId" id="userId" value="" readonly>

                        <div class="mt-2 text-sm text-left">
                            <p id="toggleWords">Promover/Demover este utilizador a/de ADMIN?</p>
                            <p>Por favor confirme a sua password:</p>
                        </div>
                        <div class="mt-3 flex justify-end space-x-3">
                            <input
                                type="password"
                                name="password"
                                id="password-privilege"
                                placeholder="Password"
                                class="w-full bg-transparent border-2 border-gray-300 border-solid rounded-lg focus:border-cyan-600"
                            >
                            <button class="px-3 py-1 bg-red-800 text-gray-200 hover:bg-red-600 rounded">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="delete-overlay">
                <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-bold">Apagar Utilizador?</h4>
                        <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-delete"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <form method="post" action="{{ route('delete_user') }}">
                        @csrf

                        <input hidden type="text" name="email" id="email" value="{{\Auth::user()->email}}" readonly>
                        <input hidden type="text" name="userId" id="userId-delete" value="" readonly>


                        <div class="mt-2 text-sm text-left">
                            <p>Apagar todos os dados do utilizador?</p>
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

        </table>
    </div>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('#overlay')
            const delBtn = document.querySelectorAll('#edit-btn')
            const closeBtn = document.querySelector('#close-modal')

            const toggleModal = () => {
                overlay.classList.toggle('hidden')
                overlay.classList.toggle('flex')
            }

            delBtn.forEach(element => {
                element.addEventListener('click', toggleModal)
            });


            closeBtn.addEventListener('click', toggleModal)
        })

        function changeFormValue(id, isAdmin) {
            document.getElementById('userId').value = id

            if (isAdmin) {
                document.getElementById('toggleWords').innerHTML = "Remover este utilizador de ADMIN?"
            } else {
                document.getElementById('toggleWords').innerHTML = "Promover este utilizador para ADMIN?"
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.querySelector('#delete-overlay')
            const delBtn = document.querySelectorAll('#delete-btn')
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
            document.getElementById('userId-delete').value = id
        }
    </script>

@endsection
