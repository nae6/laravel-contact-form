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

    // 検索
    public function search(Request $request)
    {
        $this->authorize('viewAny', Todo::class);

        $todos = Todo::with('category:id, name')
            ->forUser(Auth::id())
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword)
            ->Incomplete()
            ->latest()
            ->get();

        $categories = Category::select('id', 'name')->get();

        return view('index', compact('todos', 'categories'));
    }

    // 削除する
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()->route('todos.completed')->with('success', 'Todoを削除しました');
    }
}
