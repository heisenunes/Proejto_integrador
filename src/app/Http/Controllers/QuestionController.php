<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    public function show(Question $question)
    {
        if(QuestionDuration::where(['user_id' => Auth::id(), 'question_id' => $question->id])->exists()) {
            return view('partials.question', ['question' => $question]);
        }
        QuestionDuration::create([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
            'first_request_time' => time(),
        ]);

        return view('partials.question', ['question' => $question]);
    }

    public function createQuestion(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'content' => 'required|string|min:3|max:255',
            'topic' => 'required',
            'answer1' => 'required|string|max:200',
            'answer2' => 'required|string|max:200',
            'answer3' => 'required|string|max:200',
            'correct' => 'required'
        ]);
        $topicId = $request->input('topic');

        $last = Question::where('topic_id', $topicId)->latest('order_id')->first();
        if ($last === null) {
            // dd("tou aqui");

            $orderId = 1;
        } else {
            //dd($last->order_id);
            $orderId = $last->order_id + 1;
        }


        $createdQuestion = Question::create([
            'topic_id' => $request->input('topic'),
            'content' => $request->input('content'),
            'order_id' => $orderId,
        ]);

        $answer1 = Answer::create([
            'question_id' => $createdQuestion->id,
            'content' => $request->input('answer1'),
            'order_id' => 1,
        ]);
        $answer2 = Answer::create([
            'question_id' => $createdQuestion->id,
            'content' => $request->input('answer2'),
            'order_id' => 2,
        ]);
        $answer3 = Answer::create([
            'question_id' => $createdQuestion->id,
            'content' => $request->input('answer3'),
            'order_id' => 3,
        ]);

        switch ($request->input('correct')) {
            case "answer1":
                $createdQuestion->setAttribute('correct_answer_id', $answer1->id);
                break;
            case "answer2":
                $createdQuestion->setAttribute('correct_answer_id', $answer2->id);
                break;
            case "answer3":
                $createdQuestion->setAttribute('correct_answer_id', $answer3->id);
                break;
        }

        $createdQuestion->save();

        return redirect()->route('show_question', $createdQuestion);
        //return view('partials.question',['question'=>$createdQuestion]);
    }

    function changeQuestionUp(Question $question)
    {
        $temp = $question->order_id;
        if ($temp != 1) {
            $otherQuestion = Question::where('topic_id', $question->topic->id)->where('order_id', '<', $question->order_id)
                ->orderBy('order_id', 'desc')->first();

            $question->order_id = $otherQuestion->order_id;
            $question->save();
            $otherQuestion->order_id = $temp;
            $otherQuestion->save();

            return back();
        }
        return back();

    }

    function changeQuestionDown(Question $question)
    {
        $temp = $question->order_id;
        $last = Question::where('topic_id', $question->topic->id)->latest('order_id')->first();

        if ($temp != $last->order_id) {
            $otherQuestion = Question::where('topic_id', $question->topic->id)->where('order_id', '>', $question->order_id)
                ->orderBy('order_id', 'asc')->first();

            $question->order_id = $otherQuestion->order_id;
            $question->save();
            $otherQuestion->order_id = $temp;
            $otherQuestion->save();

            return back();
        }
        return back();
    }

    function changeQuestionActive(Question $question)
    {
        $question->active = !$question->active;
        $question->save();

        return back();
    }


    function changeAnswerUp(Question $question, Answer $answer)
    {
        $temp = $answer->order_id;
        if ($temp != 1) {
            $otherAnswer = $question->answers()->where('order_id', '<', $answer->order_id)
                ->orderBy('order_id', 'desc')->first();

            $answer->order_id = $otherAnswer->order_id;
            $answer->save();
            $otherAnswer->order_id = $temp;
            $otherAnswer->save();

            return back();
        }
        return back();

    }

    function changeAnswerDown(Question $question, Answer $answer)
    {
        $temp = $answer->order_id;
        $last = $question->answers()->latest('order_id')->first();

        if ($temp != $last->order_id) {
            $otherAnswer = $question->answers()->where('order_id', '>', $answer->order_id)
                ->orderBy('order_id', 'asc')->first();

            $answer->order_id = $otherAnswer->order_id;
            $answer->save();
            $otherAnswer->order_id = $temp;
            $otherAnswer->save();

            return back();
        }
        return back();
    }

    function deleteQuestion(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Credenciais Incorrectas');
        }

        $question = Question::firstWhere('id', $request->questionId);

        $otherQuestions = Question::where('topic_id', $question->topic_id)->where('order_id', '>', $question->order_id)->get();

        foreach ($otherQuestions as $popQuestion) {
            $popQuestion->order_id--;
            $popQuestion->save();
        }

        $question->answers()->delete();
        $question->delete();
        return back();
    }

}
