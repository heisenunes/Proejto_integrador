<?php

namespace App\Http\Controllers;

use App\Models\AnsweredQuestions;
use App\Models\FinishedAllTopics;
use App\Models\FinishedTopic;
use App\Models\Question;
use App\Models\Topic;
use App\Models\QuestionDuration;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class AnsweredQuestionController extends Controller
{
    public function submit(Request $request, Question $question): RedirectResponse
    {
        if (Auth::user()->answeredQuestion($question)) {
            return back();
        }


        if (intval($request->input('answer')) !== $question->correct_answer_id) {
            Question::where('id', $question->id)->increment('incorrect_answers');
            return redirect()->back()->with('wrongAnswer', $request->input('answer'));
        }

        Question::where('id', $question->id)->increment('correct_answers');

        $answered_question = AnsweredQuestions::create([
            'user_id' => Auth::user()->id,
            'question_id' => $question->id,
        ]);

        $answered_question->save();

        $answeredQuestions = AnsweredQuestions::where('user_id', Auth::user()->id)
            ->whereIn('question_id', Question::where('topic_id', $question->topic->id)->where('active', true)->select('id'));

        //TODO: fix this answered_questions
        if ($answeredQuestions->count() === $question->topic->nrActiveQuestions()) {
            FinishedTopic::create([
                'user_id' => Auth::user()->id,
                'topic_id' => $question->topic->id,
            ]);

        }

        $finishedAllTopics = FinishedAllTopics::firstWhere('user_id', Auth::user()->id);

        if ($finishedAllTopics == null) {
            $finishedTopicsCount = FinishedTopic::where('user_id', Auth::user()->id)->distinct()->get('topic_id')->count();

            $activeTopics = Topic::where('active', true)->get();

            $counter = 0;
            foreach ($activeTopics as $topic) {
                if ($topic->questions()->count() > 0) {
                    $counter++;
                }
            }

            if ($counter == $finishedTopicsCount) {
                FinishedAllTopics::create([
                    'user_id' => Auth::user()->id,
                ]);
            }
        }

        $question_duration = QuestionDuration::where(['user_id' => Auth::user()->id, 'question_id' => $question->id])->first();
        $question_duration->duration = time() - $question_duration->first_request_time;
        $question_duration->save();

        //otherwise TOPIC is not FINISHED yet
        //return redirect()->route('quiz', $question->topic->id);
        return redirect()->back()->with('rightAnswer', $request->input('answer'));
    }
}
