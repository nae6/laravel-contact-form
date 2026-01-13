<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view("contact/index");
    }

    public function confirm(Request $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content', 'created_at']);
        return view('contact/confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        Contact::create($contact);
        return view('contact/thanks');
    }
}
