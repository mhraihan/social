<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $following = auth()->user()->following->pluck('id');
        $messages = Message::whereIn('user_id', $following)
            ->orWhere('user_id', auth()->user()->id)
            ->latest()->get();

        Mail::to(auth()->user())->queue(new UserRegistered);
        return view('home', ['messages' => $messages]);
    }
}
