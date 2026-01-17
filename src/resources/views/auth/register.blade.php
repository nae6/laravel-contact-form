@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-right')
<a href="{{ route('login') }}" class="header__link">login</a>
@endsection

@section('page_title', 'Register')

@section('content')
<form class="form" action="/register" method="post" novalidate>
    @csrf
    <div class="form__group">
        <label class="form__group-title">お名前</label>
        <div class="form__group-content">
            <input class="" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
        </div>
        @error('name')
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__group-title">メールアドレス</label>
        <div class="form__group-content">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </div>
            @error('email')
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__group-title">パスワード</label>
        <div class="form__group-content">
            <input type="password" name="password" placeholder="例: coachtech1106">
        </div>
        @error('password')
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__button">
        <button class="form__button-submit" type="submit">登録</button>
    </div>
</form>
@endsection