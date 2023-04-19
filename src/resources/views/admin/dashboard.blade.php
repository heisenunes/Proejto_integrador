@extends('layouts.panel')

@section('content')
<script>
    activeSelector = document.querySelector(".sidebar a:first-child");
    activeSelector.classList.add("active");
    console.log(activeSelector)
</script>
<div class="table-list">
    <h2 class="font-extrabold text-xl mt-16">Lista de Tópicos</h2>
    <table class="mt-4">
        <thead>
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Nr Posts</th>
                <th>Nr Questões</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($topics as $topic)
                <tr>
                    <td>{{$topic->title}}</td>
                    <td>@if($topic->active) Activo @else Inactivo @endif</td>
                    <td>{{$topic->posts->count()}}</td>
                    <td>{{$topic->questions->count()}}</td>
                    <td><a href="{{route('topic_details', ['topic' => $topic->id])}}" class ="hover:text-cyan-400">Detalhes</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="table-list">
    <h2 class="font-extrabold text-xl mt-8">Utilizadores que terminaram todos os Tópicos</h2>
    @if($users->count() > 0)
        <table class="mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Recebeu Recompensa?</th>
                </tr>
            </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="material-icons-round">
                                <form action="{{route('reward_user', $user) }}" method="post">
                                    @csrf
                                    <button type="submit" class=>
                                        <span class = "hover:text-cyan-300">
                                            @if($user->rewarded == false)
                                                check_box_outline_blank
                                            @else
                                                check_box
                                            @endif
                                        </span>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        {{-- @dd($user->rewarded) --}}
                    @endforeach
                </tbody>
            </table>
    @else
        <p>Ainda nenhum Utilizador terminou todos os Tópicos :(</p>
    @endif
</div>

@endsection