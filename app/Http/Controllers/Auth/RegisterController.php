<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\UpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:320',
            'gender' => ['required', 'in:male,female,other'],
            'email' => ['required', 'email', 'max:320', new UpEmail],
            'password' => 'required|min:8|max:320|confirmed'
        ]);

        if (User::where('email', $request->email)->first() != null) {

            return back()->with('status', 'Esta conta já foi registada!');
        }

        User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'gender' => $request->input('gender'),
        ]);

        auth()->attempt($request->only('email', 'password'));

        event(new Registered(Auth::user()));

        // return view('auth.verify-email', ['email' => $request->email]);
        return redirect()->route('verification.notice', ['email' => $request->email]);
        // return $this->showEmailVerificationPage($request->email);
    }

    public function showEmailVerificationPage(Request $request)
    {
        return view('auth.verify-email', ['email' => $request->email]);
    }
}
