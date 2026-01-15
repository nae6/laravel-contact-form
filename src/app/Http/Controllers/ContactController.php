<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
// use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'content')->get();

        return view("contact.index", compact('categories'));
    }

    public function confirm(Request $request)
    {
        $contact = new Contact($request->all());

        return view('contact/confirm', compact('contact'));
    }




    public function back(Request $request)
    {
        return redirect()
            ->route('contact.index')
            ->withInput($request->all());
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        Contact::create($contact);
        return view('contact/thanks');
    }
}
