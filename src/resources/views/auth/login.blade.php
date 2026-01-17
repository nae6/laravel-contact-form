@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-right')
<a href="/register" class="header__link">register</a>
@endsection

@section('page_title', 'Login')

@section('content')
<form class="form" action="/login" method="post">
    @csrf
    <div class="form__group">
        <label class="form__group-title">
            <span>メールアドレス</span>
        </label>
        <div class="form__group-content">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        </div>
        @error('email')
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__group">
        <label class="form__group-title">
            <span>パスワード</span>
        </label>
        <div class="form__group-content">
            <input type="password" name="password" placeholder="例: coachtech1106">
        </div>
        @error('password')
        <p class="form__error">{{ $message }}</p>
        @enderror
    </div>
    <div class="form__button">
        <button class="form__button-submit form__btn-login" type="submit">ログイン</button>
    </div>
</form>
@endsection