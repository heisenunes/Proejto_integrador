<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\UserLoginCount as UserLoginCountModel;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid credentials');
        }

        if (UserLoginCountModel::where('day', date("Y-m-d"))->exists()) {
            // If entry for today exists, increment count
            $userLoginCount = UserLoginCountModel::where('day', date("Y-m-d"))->first();
            $userLoginCount->increment('count');
            $userLoginCount->save();
        } else {
            // User session does not exist
            $userLoginCount = UserLoginCountModel::create([
                'day' => date("Y-m-d"),
                'count' => 1,
            ]);
            $userLoginCount->save();
        }

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
