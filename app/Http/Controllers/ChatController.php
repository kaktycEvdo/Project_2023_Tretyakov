<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('chat', ['messages' => Message::where('author', '=', Auth::user()->email),
        'dialogues' => User::where('email', '=', Message::all('recipient')->where('author', '=', Auth::user()->email)),
        'user' => Auth::user()->email]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Message::create([
            'text' => $request->text,
            'author'=> Auth::user()->email,
            'recipient' => $request->recipient,
        ]);
        return 200;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $message::update([
            'text' => $request->text,
            'author'=> Auth::user()->email,
            'recipient' => $request->recipient,
        ]);
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        Message::destroy($message);
        return 200;
    }
}
