<?php

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())->latest()->get();
        return view('client.messages.index', compact('messages'));
    }

    public function create()
    {
        return view('client.messages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => 1, 
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('client.messages.index')->with('success', 'Message envoyé.');
    }

    public function adminMessages()
    {
        $messages = Message::with('sender')->latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function replyForm($receiver_id)
    {
        return view('admin.messages.reply', compact('receiver_id'));
    }

    public function sendReply(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'contenu' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'contenu' => $request->contenu,
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Réponse envoyée.');
    }
}
