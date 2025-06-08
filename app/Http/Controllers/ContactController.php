<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'messages' => 'required|string|max:255',
        ]);

        Contact::create([
            'user_id' => Auth::id(), // null jika guest
            'messages' => $request->messages,
        ]);

        return back()->with('success', 'Your message has been sent!');
    }
}
