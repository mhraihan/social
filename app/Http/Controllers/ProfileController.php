<?php

namespace App\Http\Controllers;

use App\Notifications\NewFollower;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        // $messages = $user->messages;
        return view('profile', ['user' => $user]);
    }

    public function follow(Request $request)
    {
        // dd($request->all());
        // dd($request->query('user'));

        if ($request->follow) {
            auth()->user()->following()->attach($request->user);
            User::findOrFail($request->user)->notify(new NewFollower(auth()->user()));
        } else {
            auth()->user()->following()->detach($request->user);
        }

        return redirect(route('profile', $request->user));
    }
}
