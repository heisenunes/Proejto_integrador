<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;


class RecoverAccountController extends Controller
{
    public function index() {
        return view('auth.recover');
    }

    public function sendRecoverEmail(Request $request){
        $this->validate($request, [
            'email' => ['required', 'email', 'max:320'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->back()->withErrors(['Email invalido, este email não foi registado!']);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Foi enviado email de recuperação, verifique a sua caixa de entrada!')
            : back()->withErrors(['Ocorreu um erro, tente mais tarde']);

    }

    public function showPasswordResetPage(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:5'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'A sua password foi alterada com successo!')
            : back()->withInput($request->only('email'))
                ->withErrors(['Ocorreu um erro, tente mais tarde']);
    }

}
