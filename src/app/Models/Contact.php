<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;

    const GENDER_MALE   = 1;
    const GENDER_FEMALE = 2;
    const GENDER_OTHER  = 3;

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

    public function fullName()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function fullTell()
    {
        return $this->tel1.$this->tel2.$this->tel3;
    }

    // アクセサ
    public function getFullNameAttribute(): string
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function getFullTellAttribute(): string
    {
        return $this->tel1.$this->tel2.$this->tel3;
    }

}
