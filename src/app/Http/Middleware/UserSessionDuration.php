<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserSessionDuration as UserSessionDurationModel;
use Illuminate\Support\Facades\Auth;

class UserSessionDuration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Check if the user is logged in
        if (!Auth::check()) {
            return $next($request);
        }


        if (UserSessionDurationModel::where('session_id', $request->session()->getId())->exists()) {
            // User session exists in database
            $userSessionDuration = UserSessionDurationModel::where('session_id', $request->session()->getId())->first();
            $userSessionDuration->session_duration = time() - $userSessionDuration->first_request_time;
            $userSessionDuration->last_request_time = time();
            $userSessionDuration->save();
        } else {
            // User session does not exist
            $userSessionDuration = UserSessionDurationModel::create([
                'session_id' => $request->session()->getId(),
                'user_id' => Auth::user()->id,
                'first_request_time' => time(),
                'last_request_time' => time(),
            ]);
    
            $userSessionDuration->save();
        }
        
        return $next($request);
    }
}
