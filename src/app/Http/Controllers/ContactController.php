<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'content')->get();

        return view("contacts.index", compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated();

        $contact['gender_label'] = Contact::genderLabels()[(int)$contact['gender']] ?? '';
        $contact['tel'] = $contact['tel1'].$contact['tel2'].$contact['tel3'];

        $category = Category::find($contact['category_id']);
        $contact['category_name'] = $category ? $category->content : '';

        session(['contact' => $contact]);

        return view('contacts.confirm', compact('contact'));
    }

    public function store()
    {
        $contact = session('contact');
        abort_unless($contact, 419);

        $data = [
            'last_name' => $contact['last_name'],
            'first_name' => $contact['first_name'],
            'gender' => (int)$contact['gender'],
            'email' => $contact['email'],
            'tel' => $contact['tel'],
            'address' => $contact['address'],
            'building' => $contact['building'] ?? null,
            'category_id' => (int)$contact['category_id'],
            'detail' => $contact['detail'],
        ];

        Contact::create($data);
        session()->forget('contact');

        return view('contacts.thanks');
    }

    public function back()
    {
        $contact = session('contact');
        abort_unless($contact, 419);

        $input = $contact;
        unset($input['tel'], $input['gender_label'], $input['category_name']);

        return redirect()->route('index')->withInput($input);
    }
}
