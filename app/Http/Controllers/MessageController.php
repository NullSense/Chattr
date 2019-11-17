<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $messages = Message::where(function($query) use ($id) {
            $query->where('to', auth()->id())->where('user_id', $id)->get();
        })->orWhere(function($query) use ($id) {
            $query->where('user_id', auth()->id())->where('to', $id)->get();
        })->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = $request->user()->messages()->create([
            'user_id' => auth()->id(),
            'to' => $request->to,
            'body' => $request->body,
        ]);

        return response()->json($message);
    }
}
