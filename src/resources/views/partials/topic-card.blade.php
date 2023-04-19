@if($topic->active)
    <a class="w-32  flex flex-col" href="{{route('topic.get',$topic->id)}}">
        <div class="bg-cyan-600 rounded-t text-left px-2 py-1 gap-1 flex items-center">
            <span class="h-2 w-2 border-2 inline-block rounded-full"></span>
            <span class="h-2 w-2 border-2 inline-block rounded-full"></span>
            <span class="h-2 w-2 border-2 inline-block rounded-full"></span>
        </div>
        <div class="bg-white rounded-b p-2 flex-1">
            <img class="mx-auto" src="{{asset( $topic->topicLogo->path )}}" alt="Topic icon">
            <p class="w-0 min-w-full break-normal whitespace-normal my-1"> {{ $topic->title }} </p>
        </div>
    </a>
@endif
