<form class="flex flex-col mt-10" id="get-data-form" method="post" action="{{ route('edit_content') }} ">
    @csrf
    <textarea name="mytextarea" style="min-height:600px;" id="myeditorinstance" cols="30" rows="10"></textarea>
    <input class="m-20 border-2 px-6 py-1 bg-cyan-600 text-white font-semibold text-l" type="submit" value="Testar">
</form>

<script>
    document.querySelector('#myeditorinstance').addEventListener('change', function (event) {
        console.log(event.target.value);
    });
</script>
