<label for="answer-{{ $answer->id }}">
    {{--    dont make input display: none or visibility: hidden because that will remove the ability to use tab to focus the input--}}
    <input type="radio" id="answer-{{ $answer->id }}" name="answer" value="{{ $answer->id }}"
           class="absolute opacity-0 peer">
    <div
        class="flex border-2 border-gray-500 hover:bg-white/5
        peer-focus:bg-white/30 peer-checked:border-white peer-checked:bg-white/20 cursor-pointer
        @if(session()->get('wrongAnswer') == $answer->id) bg-red-500 @endif
        @if(Auth::user()->answeredQuestion(\App\Models\Question::where('id', $answer->question_id)->first()->id)
        && \App\Models\Question::where('id', $answer->question_id)->first()->correct_answer_id == $answer->id) bg-green-400 @endif"
    >

        @php
            $alphabet = range('A', 'Z');
            if(session()->get('wrongAnswer') == $answer->id){
                $color = "bg-red-500";
            }else if(Auth::user()->answeredQuestion(\App\Models\Question::where('id', $answer->question_id)->first()->id)
            && \App\Models\Question::where('id', $answer->question_id)->first()->correct_answer_id == $answer->id) {
                $color = "bg-green-400";
            }
            else if ($answer->order_id %4 == 0) {
                $color = "bg-green-400";
            }else if ($answer->order_id %4 == 1) {
                $color = "bg-cyan-500";
            }else if ($answer->order_id %4 == 2){
                $color = "bg-red-300";
            }else{
                $color = "bg-yellow-500";
            }

        @endphp
        <div class="p-3 {{$color}} text-black font-bold">
            {{ $alphabet[$answer->order_id-1]}}
        </div>
        <div class="p-3">
            {{ $answer->content}}
        </div>
    </div>
</label>
