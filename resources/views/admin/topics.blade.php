@extends('layouts.panel')

@section('content')
    <script>
        activeSelector = document.querySelector(".sidebar a:nth-child(3)");
        activeSelector.classList.add("active");
        console.log(activeSelector)
    </script>

    <div>
        <h2 class="font-extrabold text-xl mt-16">Lista de Tópicos</h2>

        <a href="{{route('create_topic')}}">
            <button class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 my-2 rounded align-middle">
                Criar Tópico
                <span class="material-icons-round align-middle">
                    add_circle
                </span>
            </button>
        </a>
        <table class="mt-4">
            <thead>
            <tr>
                <th>Ordem</th>
                <th>Título</th>
                <th>Nr Posts</th>
                <th>Nr Questões</th>
                <th>Data Criação</th>
                <th>Ultíma Alteração</th>
                <th>Gráfico</th>
                <th>Activo</th>
                <th>Opções</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td class="material-icons-round">
                        @if ($topic->order_id != 1)
                            <form action="{{route('change_topic_up', $topic->id) }}" method="post">
                                @csrf
                                <button type="submit" class="hover:text-cyan-300">
                                    arrow_upward
                                </button>
                            </form>
                        @endif
                        @php
                            $last = \App\Models\Topic::latest('order_id')->first();
                        @endphp
                        @if($last->order_id != $topic->order_id)
                            <form action="{{route('change_topic_down', $topic->id) }}" method="post">
                                @csrf
                                <button type="submit" class="hover:text-cyan-300">
                                    arrow_downward
                                </button>
                            </form>
                        @endif
                        {{-- {{$topic->order_id}} --}}
                    </td>
                    <td class="text-left">{{$topic->title}}</td>
                    <td>{{$topic->posts->count()}}</td>
                    <td>{{$topic->questions->count()}}</td>
                    <td>{{$topic->created_at}}</td>
                    <td>{{$topic->updated_at}}</td>
                    <td>
                        <a href="{{ route('topic_graphic', $topic->id) }}" class="material-icons-round text-white hover:text-cyan-300">insights</a>
                    </td>
                    <td class="material-icons-round">
                        <form action="{{route('change_topic_active', $topic->id) }}" method="post">
                            @csrf
                            <button type="submit">
                                <span class="hover:text-cyan-300">
                                    @if($topic->active)
                                        check_box
                                    @else
                                        check_box_outline_blank
                                    @endif
                                </span>
                            </button>
                        </form>
                    </td>

                    <td>
                        <a href="{{ route('topic_details', $topic->id) }}" class="material-icons-round text-white hover:text-cyan-300">edit</a>
                    
                        <button id="edit-btn" class="material-icons-round text-white hover:text-cyan-300"
                        onclick="changeDeleteValue({{$topic->id}})">
                            delete_forever
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="delete-overlay">
        <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
            <div class="flex justify-between items-center">
                <h4 class="text-lg font-bold">Apagar Topico?</h4>
                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-delete" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <form method="post"
            action="{{ route('delete_topic') }}">
                @csrf
                <input type="text" name="email" id="email" value="{{\Auth::user()->email}}" class="hidden" readonly>
                <input type="text" name="topicId" id="topicId-delete" value="" class="hidden" readonly>
    
    
                <div class="mt-2 text-sm text-left">
                    <p>Tambem serão apagadas as questões e artigos associados</p>
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
        window.addEventListener('DOMContentLoaded', () =>{
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
    
        function changeDeleteValue(id){
            document.getElementById('topicId-delete').value = id
        }
    </script>
    
@endsection
