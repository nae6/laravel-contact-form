<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // gender用settings
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_OTHER = 3;

    public static function genderLabels()
    {
        return [
            self::GENDER_MALE => '男性',
            self::GENDER_FEMALE => '女性',
            self::GENDER_OTHER => 'その他',
        ];
    }

    public function getGenderTextAttribute()
    {
        return self::genderLabels()[$this->gender] ?? '';
    }

    // search用LocalScope
    // 1. キーワード検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (empty($keyword))
            {
                return $query;
            }

        $keywordNoSpace = preg_replace('/\s+/u', '', $keyword);

        return $query->where(function ($q) use ($keyword, $keywordNoSpace)
            {
                $q  ->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keywordNoSpace}%"]);
            });
    }

    // 2. 性別検索
    public function scopeGenderSearch($query, $gender)
    {
        if (empty($gender) || $gender === 'all')
            {
                return $query;
            }

        return $query->where('gender', $gender);
    }

    // 3. カテゴリ検索
    public function scopeCategorySearch($query, $category)
    {
        if (empty($category) || $category === 'all')
            {
                return $query;
            }

        return $query->where('category_id', $category);
    }

    // 4. 日付検索
    public function scopeDateSearch($query, $date)
    {
        if (empty($date))
            {
                return $query;
            }

        return $query->whereDate('created_at', $date);
    }
}