<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

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
    public function index()
    {
        $following = auth()->user()->following->pluck('id');
        $messages = Message::whereIn('user_id', $following)
            ->orWhere('user_id', auth()->user()->id)
            ->latest()->get();
        return view('home', ['messages' => $messages]);
    }
}
