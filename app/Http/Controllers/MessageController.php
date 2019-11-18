<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    /**
     * MessageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets all messages matching the selected user $id and authenticated user.
     * Meaning all received and sent messages between the authenticated user and
     * user $id get retrieved.
     *
     * @param $id selected contact user id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $messages = Message::where(function($query) use ($id) {
            // Authenticated user received messages from user $id
            $query->where('to', auth()->id())->where('user_id', $id)->get();
        })->orWhere(function($query) use ($id) {
            // Authenticated user sent messages to user $id
            $query->where('user_id', auth()->id())->where('to', $id)->get();
        })->get();

        return response()->json($messages);
    }

    /**
     * Send message to user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
