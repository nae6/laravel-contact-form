<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')
            ->latest()
            ->paginate(7);

        $categories = Category::select('id', 'content')->get();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::select('id', 'content')->get();

        $contacts = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category)
            ->dateSearch($request->created_at)
            ->latest()
            ->paginate(7)
            ->appends($request->query());

        return view('admin.index', compact('contacts', 'categories'));
    }

    // 削除する
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.index');
    }
}
