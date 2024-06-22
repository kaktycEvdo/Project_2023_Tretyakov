<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Message;
use App\Models\PersonalData;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $messages = Message::all()->where('author', Auth::user()->id);
        $messages2 = Message::all()->where('recepient', Auth::user()->id);
        $dialogues = [];

        foreach ($messages as $message) {
            if (User::where('id', $message->recepient)){
                $recepient = User::where('id', $message->recepient)->first('email')->email;
                $pdata = PersonalData::where('email', $recepient)->first(['name', 'surname', 'patronymic']);
                
                $dialogues[$message->recepient] = [
                    'id' => $message->recepient,
                    'data' => $pdata
                ];
            }
        }
        foreach ($messages2 as $message) {
            if (User::where('id', $message->author)){
                $author = User::where('id', $message->author)->first('email')->email;
                $pdata = PersonalData::where('email', $author)->first(['name', 'surname', 'patronymic']);
                
                $dialogues[$message->author] = [
                    'id' => $message->author,
                    'data' => $pdata
                ];
            }
        }

        $recepient = null;
        if($request->id){
            $recepient = ["id" => $request->id, "user" => PersonalData::where('email', User::where("id", $request->id)->first()->email)->first(['name', 'surname', 'patronymic'])];
            $messages1 = Message::all()->where('author', $request->id);
            $messages2 = Message::all()->where('recepient', $request->id);
            $messagesFull = array_merge($messages1->all(), $messages2->all());
            return view('chat', ['messages' => $messagesFull,
            'dialogues' => $dialogues,
            'user' => Auth::user()->id,
            'recepient' => $recepient]);
        }
        
        return view('chat', ['messages' => null,
            'dialogues' => $dialogues,
            'user' => Auth::user()->id,
            'recepient' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = Message::create([
            'text' => $request->text,
            'author'=> $request->author,
            'recepient' => $request->recepient,
        ]);
        SendMessage::dispatch($message);

        return response()->json([
            'success' => true,
            'message' => "Message created and job dispatched.",
        ]);
    }

    public function messages(): JsonResponse{
        // возможно надо будет редачить это
        $messages = Message::with('user')->get()->append('time');

        return response()->json($messages);
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
