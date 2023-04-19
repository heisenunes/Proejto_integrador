@extends('layouts.panel')

@section('content')
<script>
    activeSelector = document.querySelector(".sidebar a:nth-child(5)");
    activeSelector.classList.add("active");
    console.log(activeSelector)

    window.addEventListener('DOMContentLoaded', ()=> {
            const menuBtn = document.querySelector('#menu-btn')
            const dropdown = document.querySelector('#dropdown')
            
            menuBtn.addEventListener('click', () => {
                dropdown.classList.toggle('hidden')
                dropdown.classList.toggle('flex')
            })

        })
</script>

<h2 class="font-extrabold text-xl mt-16">
    Artigos
</h2>

<div class="columns-4">
        <a href="{{route('create_post')}}">
            <button class="bg-cyan-500 hover:bg-cyan-600 text-white py-2 px-4 my-2 rounded align-middle">
                Criar Artigo
                <span class="material-icons-round align-middle">
                    add_circle
                </span>
            </button>
        </a>


        <button class="bg-cyan-500 px-4 py-2 my-2 align-middle rounded hover:bg-cyan-600" id="menu-btn">
            @if ($selectedTopic)
                {{$selectedTopic->title}}
            @else
            Selecionar Tópico
            @endif

            <span class="material-icons-round my-auto">
                keyboard_arrow_down
            </span>
        </button>
            <div class="bg-cyan-600 hidden flex-col rounded mt-1 p-2 text-sm w-32" id="dropdown" style="position: absolute">
                @foreach($topics as $topic)
                    <a href="{{route('show_posts',[$topic] ) }}" class="px-2 py-1 hover:bg-cyan-800 rounded">{{$topic->title}}</a>
                @endforeach
            </div>

</div>



<div class="table-list">
    
    @if($posts->count())
        <table class="mt-4">
            <thead>
                <tr>
                    <th>
                    @if ($selectedTopic)
                        Ordem
                    @else
                        Tópico
                    @endif
                    </th>
                    <th>Conteúdo</th>
                    <th>Data Criação</th>
                    <th>Última Alteração</th>
                    <th>Activo</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                        <tr>
                                @if ($selectedTopic)
                                    <td class = "material-icons-round">
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
                                    @else
                                    <td>
                                        {{$post->topic->title}}

                                    </td>
                                    @endif
                            <td class="text-left">{{$post->title}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->updated_at}}</td>
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
                                <a href="{{route('post_details', $post->id) }}" class="material-icons-round text-white hover:text-cyan-300">edit</a>
                            
                                <button id="edit-btn" class="material-icons-round text-white hover:text-cyan-300"
                                onclick="changeDeleteValue({{$post->id}})">
                                    delete_forever
                                </button>
                            </td>
                        </tr>
                @endforeach

            </tbody>
        </table>
        <div class="row">
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        </div>

    @else
        <p>Ainda não existem artigos neste Tópico</p>
    @endif
</div>

<div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="delete-overlay">
    <div class="bg-gray-400 max-w-m py-2 px-3 rounded shadow-xl text-gray-800">
        <div class="flex justify-between items-center">
            <h4 class="text-lg font-bold">Apagar Artigo?</h4>
            <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-delete" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <form method="post"
        action="{{ route('delete_post' ) }}">
            @csrf
            <input type="text" name="email" id="email" value="{{\Auth::user()->email}}" class="hidden" readonly>
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
        document.getElementById('postId-delete').value = id
    }
</script>

@endsection