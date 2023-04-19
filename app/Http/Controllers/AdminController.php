<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FinishedAllTopics;
use App\Models\Post;
use App\Models\Question;
use App\Models\QuestionDuration;
use App\Models\Topic;
use App\Models\TopicVisits;
use App\Models\User;
use App\Models\UserSessionDuration;
use App\Models\UserLoginCount;
use App\Models\AverageSessionDuration;
use Auth;
use App\Http\Resources\LoginCountResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function show($category): View|Factory|RedirectResponse|Application
    {
        $topics = Topic::orderBy('order_id')->paginate(pageName: 'topics');
        switch ($category) {
            case 'topics':
                return view('admin.topics', ['topics' => $topics]);

            case 'questions':
                $questions = Question::orderBy('id')->paginate();
                return view('admin.questions', ['questions' => $questions, 'topics' => $topics, 'selectedTopic' => null]);

            case 'users':
                $users = User::orderBy('id')->paginate();
                return view('admin.users', ['users' => $users]);

            case 'posts':
                $posts = Post::orderBy('topic_id')->paginate();
                return view('admin.posts', ['posts' => $posts, 'topics' => $topics, 'selectedTopic' => null]);

            case 'graphs':
                $login_count = LoginCountResource::collection(UserLoginCount::orderBy('day')->get());
                $years = [];
                foreach ($login_count as $login) {
                    if (!in_array(substr($login->day, 0, 4), $years)) {
                        array_push($years, substr($login->day, 0, 4));
                    }
                }
                return view('admin.graphs', ['login_counts' => $login_count, 'years' => $years]);

            default:
                return redirect()->route('dashboard', 'topics');
        }
    }

    public function showGraphs($category): View|Factory|RedirectResponse|Application
    {
        $topics = Topic::orderBy('order_id')->paginate(pageName: 'topics');
        switch ($category) {
            case 'topics':
                $topics = Topic::orderBy('order_id')->get();
                $finished_topics = [];
                foreach ($topics as $topic) {
                    $finished_topics[$topic->title] = $topic->finishedTopics->count();
                }

                $topic_visits = TopicVisits::orderBy('topic_id')->get();
                $topic_visits_coords = [];
                foreach ($topics as $topic) {
                    if (!isset($topic_visits_coords[$topic->title])) {
                        $topic_visits_coords[$topic->title] = 0;
                    }
                }
                foreach ($topic_visits as $topic) {
                    $topic_visits_coords[$topic->topic->title] += $topic->count;
                }

                return view('admin.graphs.topics', ['finished_topics' => $finished_topics, 'topic_visits_coords' => $topic_visits_coords]);

            case 'questions':
                $questions = Question::orderBy('topic_id')->orderBy('order_id')->get();
                $finishedQuestions = [];
                foreach ($questions as $question) {
                    $finishedQuestions[$question->id] = [
                        $question->correct_answers,
                        -$question->incorrect_answers
                    ];
                }

                $question_durations = QuestionDuration::orderBy('question_id')->get();
                $question_durations_coords = [];
                $average_duration = [];
                foreach ($questions as $question) {
                    $temp = [];
                    foreach ($question_durations as $duration) {
                        if ($duration->question_id == $question->id) {
                            array_push($temp, $duration->duration);
                        }
                    }
                    if (count($temp) == 0) {
                        $question_durations_coords[$question->id] = 0;
                    }
                    else {
                        $question_durations_coords[$question->id] = array_sum($temp)/count($temp);
                        $average_duration[$question->id] = array_sum($temp)/count($temp);
                    }
                }

                return view('admin.graphs.questions', ['finishedQuestions' => $finishedQuestions, 'question_durations_coords' => $question_durations_coords, 'average_duration' => $average_duration]);

            case 'users':
                $average_duration = AverageSessionDuration::orderBy('day')->get();
                $graph_coords = [];
                foreach ($average_duration as $duration) {
                    $graph_coords[$duration->day] = $duration->average_duration;
                }
                $years = [];
                foreach ($average_duration as $duration) {
                    if (!in_array(substr($duration->day, 0, 4), $years)) {
                        array_push($years, substr($duration->day, 0, 4));
                    }
                }

                return view('admin.graphs.users', ['graph_coords' => $graph_coords, 'years' => $years]);

            default:
                return redirect()->route('dashboard', 'graphs');
        }
    }

    public function showMainPanel(): Factory|View|Application
    {
        $topics = Topic::orderBy('order_id')->paginate(20);
        $finishedAllTopics = FinishedAllTopics::select('user_id')->get();
        $users = User::whereIn('id', $finishedAllTopics)->orderBy('id')->paginate(20);

        return view('admin.dashboard', ['topics' => $topics, 'users' => $users]);
    }

    function showQuestions(Topic $topic): Factory|View|Application
    {
        $questions = Question::where('topic_id', $topic->id)->orderBy('order_id')->paginate(15);
        $topics = Topic::orderBy('order_id')->paginate();

        return view('admin.questions', ['questions' => $questions, 'topics' => $topics, 'selectedTopic' => $topic]);
    }

    function showPosts(Topic $topic): Factory|View|Application
    {
        $posts = Post::where('topic_id', $topic->id)->orderBy('order_id')->paginate(15);
        $topics = Topic::orderBy('order_id')->paginate();

        return view('admin.posts', ['posts' => $posts, 'topics' => $topics, 'selectedTopic' => $topic]);
    }

    public function show_create_question(): Factory|View|Application
    {
        $topics = Topic::orderBy('order_id')->get();
        return view('admin.new-question', ['topics' => $topics]);
    }

    public function show_create_post(): Factory|View|Application
    {
        $topics = Topic::orderBy('order_id')->get();
        return view('admin.new-post', ['topics' => $topics]);
    }

    public function show_create_topic(): Factory|View|Application
    {
        return view('admin.new-topic');
    }

    public function topicDetailsPage(Topic $topic): Factory|View|Application
    {
        $posts = Post::where('topic_id', $topic->id)->orderBy('order_id')->paginate(15);
        $questions = Question::where('topic_id', $topic->id)->orderBy('order_id')->paginate(15);
        return view('admin.topic-details', ['topic' => $topic, 'posts' => $posts, 'questions' => $questions]);
    }

    public function topicGraphicDetails(Topic $topic): Factory|View|Application
    {
        $topic_visits = $topic->visits()->orderBy('day')->get();
        $visits = [];
        foreach ($topic_visits as $visit) {
            $visits[$visit->day] = $visit->count;
        }

        $questions = $topic->questions()->orderBy('order_id')->get();
        $finishedQuestions = [];
        foreach ($questions as $question) {
            $finishedQuestions[$question->id] = [
                $question->correct_answers,
                -$question->incorrect_answers
            ];
        }

        return view('admin.topic-graphic', ['topic' => $topic, 'visits' => $visits, 'finishedQuestions' => $finishedQuestions]);
    }

    public function questionDetailsPage(Question $question): Factory|View|Application
    {
        $answers = $question->answers()->orderBy('order_id')->get();
        $topics = Topic::orderBy('order_id')->get();
        return view('admin.question-details', ['question' => $question, 'answers' => $answers, 'topics' => $topics]);
    }

    public function postDetailsPage(Post $post): Factory|View|Application
    {
        $topics = Topic::orderBy('order_id')->get();
        return view('admin.post-details', ['post' => $post, 'topics' => $topics]);
    }

    public function setQuestionTopic(Question $question, Request $request): RedirectResponse
    {
        $topic = Topic::find($request->input('topic'));
        if (!$topic || $topic->id === $question->topic->id)
            return back();

        $question->topic()->associate($topic)->save();
        return back();
    }

    public function setCorrectAnswer(Question $question, Answer $answer): RedirectResponse
    {
        if ($answer->question->id !== $question->id) {
            return back()->withErrors(['invalid-data' => 'Answer ' . $answer->id . '  doesn\'t belong to Question ' . $question->id]);
        }
        $question->setAttribute('correct_answer_id', $answer->id);
        $question->save();

        return back();
    }

    public function addAnswer(Request $request, Question $question): RedirectResponse
    {
        $trimmed = trim($request->input('answer'));
        if (!$trimmed) {
            return back()->withErrors(['invalid-data' => 'answer: No content']);
        }

        $lastId = $question->answers()->latest('order_id')->first()?->order_id ?? 0;
        $question->answers()->create(['content' => $trimmed, 'order_id' => $lastId + 1]);

        return back();
    }

    public function deleteAnswer(Answer $answer): RedirectResponse
    {
        $answer->delete();

        return back();
    }

    public function editQuestionContent(Request $request, Question $question): RedirectResponse
    {
        $trimmed = trim($request->input('content'));
        if (!$trimmed || strlen($trimmed) < 3 || strlen($trimmed) > 255) {
            return back()->withErrors(['invalid-data' => 'content: Invalid string']);
        }

        $question->setAttribute('content', $trimmed);
        $question->save();

        return back();
    }

    public function promoteUser(Request $request): RedirectResponse
    {
        if ($request->input('userId') === Auth::user()->id) {
            return back()->with('status', 'Não é possivel remover os própios previlégios');
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid credentials');
            //TODO: redirect is bugging, maybe because of route?
        }

        $user = User::firstWhere('id', $request->input('userId'));
        if (!$user)
            return back();

        $user->setAttribute('role', $user->isAdmin() ? 'User' : 'Admin');
        $user->save();
        return back();
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        if ($request->input('userId') == Auth::user()->id) {
            return back()->with('status', 'Não é possivel apagar a propria conta');
        }

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Credenciais Incorrectas');
        }

        $user = User::firstWhere('id', $request->input('userId'));
        if (!$user)
            return back();

        $user->answeredQuestions()->delete();
        $user->FinishedTopics()->delete();
        $user->FinishedAllTopics()->delete();
        $user->delete();
        return back();
    }

    public function rewardUser(User $user): RedirectResponse
    {
        $user->rewarded = !$user->rewarded;
        $user->save();

        return back();
    }
}
