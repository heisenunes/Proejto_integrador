@if($post->active)
    <article class="leading-relaxed group @can('update', $post) hover:bg-white/20 @endcan rounded-xl px-4 py-1">
        <div class="flex justify-between items-center py-2">
            <span class="text-cyan-600 font-semibold text-xl ">{{$post->title}}</span>
            {{-- @if(Auth::user()->isAdmin()) --}}
                @can('update', $post)
                <div class="group-hover:block hidden leading-4">
                    <button class="material-icons"><a href="{{route('post_details', $post)}}">edit</a></button>
                </div>
                @endcan
            {{-- @endif --}}
        </div>

        @if(isset($post->content))
                
            {!! $post->content !!}
            {{-- {{$post->content }} --}}

        @endif

        <hr class="mt-4 pb-2">
    </article>
@endif
