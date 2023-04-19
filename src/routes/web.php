<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnsweredQuestionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RecoverAccountController as AuthRecoverAccountController;
use App\Http\Controllers\RecoverAccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/email/verify', [RegisterController::class, 'showEmailVerificationPage'])->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/')->with('status', 'O seu registo foi validado! Bem vindo!');
    })->middleware(['auth', 'signed'])->name('verification.verify');


    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(['email' => $request->email])->with('status', 'Email foi reenviado!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


    Route::get('/', [HomeController::class, 'show'])->name('home');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('registerAccount');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login2');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/recoverAccount', [AuthRecoverAccountController::class, 'index'])->name('recover');
    Route::post('/recoverAccount/sendEmail', [AuthRecoverAccountController::class, 'sendRecoverEmail'])->name('recover.send');

    Route::get('/reset-password/{token}', [AuthRecoverAccountController::class, 'showPasswordResetPage'])->name('password.reset');
    Route::post('/reset-password', [AuthRecoverAccountController::class, 'changePassword'])->name('password.confirmReset');



    Route::get('/topic', function () {
        return view('pages.topic');
    })->name('topic');
    Route::get('/topic/{id}', [TopicController::class, 'show'])->name('topic.get');


    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('show_question');
        Route::post('/questions/{question}', [AnsweredQuestionController::class, 'submit'])->name('submit_question');
        Route::get('/quiz/{topic}', [TopicController::class, 'quiz'])->name('quiz');
    });


    Route::group(['middleware' => ['admin', 'verified']], function () {

        Route::get('/admin', [AdminController::class, 'showMainPanel'])->name('dashboard_main');
        Route::get('/admin/{category}', [AdminController::class, 'show'])->name('dashboard');
        Route::get('/admin/graphs/{category}', [AdminController::class, 'showGraphs'])->name('dashboard_graphs');
        Route::post('/admin/topics/{topic}', [TopicController::class, 'changeTopicActive'])->name('change_topic_active');
        Route::post('/admin/topics/{topic}/up', [TopicController::class, 'changeTopicUp'])->name('change_topic_up');
        Route::post('/admin/topics/{topic}/down', [TopicController::class, 'changeTopicDown'])->name('change_topic_down');
        Route::post('/admin/topics/{topic}/edit', [TopicController::class, 'editTopic'])->name('edit_topic');
        Route::post('/admin/topic/delete', [TopicController::class, 'deleteTopic'])->name('delete_topic');

        Route::get('/admin/topics/create', [AdminController::class, 'show_create_topic'])->name('create_topic');
        Route::post('/admin/topics/', [TopicController::class, 'createTopic'])->name('create_topic_request');
        Route::get('/admin/{topic}/questions', [AdminController::class, 'showQuestions'])->name('show_questions');
        Route::get('/admin/topic/{topic}', [AdminController::class, 'topicDetailsPage'])->name('topic_details');
        Route::get('/admin/graphs/topic/{topic}', [AdminController::class, 'topicGraphicDetails'])->name('topic_graphic');
        Route::get('/admin/question/{question}', [AdminController::class, 'questionDetailsPage'])->name('question_details');
        Route::get('/admin/questions/create', [AdminController::class, 'show_create_question'])->name('create_question');
        Route::post('/admin/questions/create', [QuestionController::class, 'createQuestion'])->name('create_question_request');
        Route::post('/admin/questions/{question}/up', [QuestionController::class, 'changeQuestionUp'])->name('change_question_up');
        Route::post('/admin/questions/{question}/down', [QuestionController::class, 'changeQuestionDown'])->name('change_question_down');
        Route::post('/admin/questions/{question}/active', [QuestionController::class, 'changeQuestionActive'])->name('change_question_active');
        Route::post('/admin/questions/delete', [QuestionController::class, 'deleteQuestion'])->name('delete_question');

        Route::post('/admin/users/promote', [AdminController::class, 'promoteUser'])->name('change_user_privilege');
        Route::post('/admin/users/delete', [AdminController::class, 'deleteUser'])->name('delete_user');
        Route::post('/admin/users/reward/{user}', [AdminController::class, 'rewardUser'])->name('reward_user');

        Route::post('/admin/posts/{post}/up', [PostController::class, 'changePostUp'])->name('change_post_up');
        Route::post('/admin/posts/{post}/down', [PostController::class, 'changePostDown'])->name('change_post_down');
        Route::post('/admin/posts/{post}/active', [PostController::class, 'changePostActive'])->name('change_post_active');
        Route::post('/admin/posts/delete', [PostController::class, 'deletePost'])->name('delete_post');

        Route::get('/admin/{topic}/posts', [AdminController::class, 'showPosts'])->name('show_posts');
        Route::get('/admin/post/{post}', [AdminController::class, 'postDetailsPage'])->name('post_details');
        Route::post('/admin/posts/create', [PostController::class, 'createPost'])->name('create_post_request');
        Route::get('/admin/posts/create', [AdminController::class, 'show_create_post'])->name('create_post');

        Route::post('/admin/question/{question}/{answer}/up', [QuestionController::class, 'changeAnswerUp'])->name('change_answer_up');
        Route::post('/admin/question/{question}/{answer}/down', [QuestionController::class, 'changeAnswerDown'])->name('change_answer_down');

        // TODO these should probably be API
        Route::post('/admin/question/{question}/topic', [AdminController::class, 'setQuestionTopic'])->name('set_question_topic');
        Route::post('/admin/question/{question}/correct/{answer}', [AdminController::class, 'setCorrectAnswer'])->name('question_correct');
        Route::post('/admin/question/{question}/answer', [AdminController::class, 'addAnswer'])->name('question_answer');

        Route::delete('admin/answer/{answer}', [AdminController::class, 'deleteAnswer'])->name('answer');

        Route::post('/admin/question/{question}/content', [AdminController::class, 'editQuestionContent'])->name('question_content');
        Route::post('/post/{post}',  [PostController::class, 'updatePost'])->name('update_post');

        // API
    });

    //Static Pages
    Route::get('/ajuda', function () {
        return view('pages.ajuda');
    })->name('ajuda');
    Route::get('/contactos', function () {
        return view('pages.contactos');
    })->name('contactos');
});