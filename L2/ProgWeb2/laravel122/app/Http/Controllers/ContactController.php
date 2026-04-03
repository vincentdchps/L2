<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function show()
    {
        // Seul un 'user' classique peut voir le formulaire
        if (auth()->user()->role !== 'user') {
            abort(403, 'Accès réservé aux utilisateurs standards.');
        }
        return view('contact-form'); // La vue du formulaire
    }

   public function submit(Request $request)
{
    if (auth()->user()->role !== 'user') {
        abort(403);
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // 1. On fabrique le tableau $contact exact que le Mailable attend
    $contact = [
        'name' => auth()->user()->firstname . ' ' . auth()->user()->name,
        'title' => $validated['title'],
        'content' => $validated['message'],
    ];

    $suUsers = User::where('role', 'su')->get();

    // 2. On passe le tableau unique dans le constructeur
    foreach ($suUsers as $su) {
        Mail::to($su->email)->send(new ContactMessage($contact));
    }

    return redirect()->back()->with('success', 'Votre message a bien été envoyé aux administrateurs.');
}
}

