<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    // CSVエクスポート
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::with('category')
            ->keywordSearch($request->keyword)
            ->genderSearch($request->gender)
            ->categorySearch($request->category)
            ->dateSearch($request->created_at)
            ->latest();

        $fileName = 'contacts_'.now()->format('Ymd_His').'.csv';

        return response()->stream(function () use ($query)
        {
            $out = fopen('php://output', 'w');

            // Excel文字化け対策（UTF-8 BOM）
            fwrite($out, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($out, [
                'ID',
                'カテゴリ',
                '姓',
                '名',
                '性別',
                'メール',
                '電話',
                '住所',
                '建物',
                'お問い合わせ内容',
                '作成日',
            ]);

            // 大量件数対策
            $query->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $c) {
                    fputcsv($out, [
                        $c->id,
                        optional($c->category)->content,
                        $c->last_name,
                        $c->first_name,
                        $c->gender_text,
                        $c->email,
                        "\t".(string) $c->tel,
                        $c->address,
                        $c->building,
                        $c->detail,
                        optional($c->created_at)->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($out);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }

    // 削除する
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.index');
    }
}
