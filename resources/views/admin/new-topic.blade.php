@extends('layouts.panel')

@section('content')
    <h2 class="font-extrabold text-xl mt-8">Criar Tópico</h2>
    <form action="{{ route('create_topic_request') }}"
          method="post"
          enctype="multipart/form-data"
          class="my-4 flex flex-col gap-4"
    >
        @csrf
        <div>
            <label for="title" class="">Título</label>
            <input
                type="text"
                name="title"
                id="title"
                placeholder="O Meu Departamento"
                value="{{ old('title') }}"
                required
                minlength="2"
                class="placeholder-gray-300 bg-cyan-800 rounded-lg w-full border-solid border-2 hover:border-gray-400 focus:border-white @error('title') border-red-500 @enderror"
            >
            @error('title')
            <p class="text-red-400 ml-3"> {{ $message }} </p>
            @enderror
        </div>

        <div>
            <label for="brief" class="">Descrição</label>
            <input
                type="text"
                name="brief"
                id="brief"
                placeholder="Pequena descrição do Tópico"
                value="{{ old('brief') }}"
                required
                minlength="2"
                class="placeholder-gray-300 bg-cyan-800 rounded-lg w-full border-solid border-2 hover:border-gray-400 focus:border-white @error('title') border-red-500 @enderror"
            >

            @error('brief')
            <p class="text-red-400 ml-3"> {{ $message }} </p>
            @enderror
        </div>

        <div class="flex flex-wrap gap-4 justify-around text-center">
            <label class="flex flex-col gap-2 cursor-pointer">
                <span>Logótipo - HomePage</span>
                <img src="{{asset('/img/upload-pictures-icon.png')}}"
                     class="h-28 mx-auto my-2"
                     id="homepage-img"
                     alt="Homepage Icon"
                >
                <input
                    type="file"
                    accept="image/*"
                    name="homepageImage"
                    id="homepage-img-input"
                    required
                    class="file:px-4 file:py-2 file:rounded-full file:border-gray-500 file:border-solid hover:file:border-gray-400 file:bg-cyan-800 file:text-gray-300 file:cursor-pointer"
                >
            </label>
            <label class="flex flex-col gap-2 cursor-pointer">
                <span>Icone</span>
                <img src="{{asset('/img/upload-pictures-icon.png')}}"
                     class="h-28 mx-auto my-2"
                     id="icon-img"
                     alt="Alt Icon"
                >
                <input
                    type="file"
                    accept="image/*"
                    name="iconImage"
                    id="icon-img-input"
                    required
                    class="file:px-4 file:py-2 file:rounded-full file:border-gray-500 file:border-solid hover:file:border-gray-400 file:bg-cyan-800 file:text-gray-300 file:cursor-pointer"
                >
            </label>
        </div>

        <button type="submit" class="bg-cyan-600 p-3 rounded-lg w-full hover:bg-cyan-800">
            Criar Tópico
        </button>
    </form>

    <script defer>
        const setupImgInput = (inputSel, imgSel) => {
            const input = document.querySelector(inputSel)
            const img = document.querySelector(imgSel)
            if (!input || !img)
                return

            input.addEventListener('change', e => img.src = URL.createObjectURL(e.target.files[0]))
        }

        setupImgInput('#homepage-img-input', '#homepage-img')
        setupImgInput('#icon-img-input', '#icon-img')
    </script>
@endsection
