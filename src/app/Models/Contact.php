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

}
