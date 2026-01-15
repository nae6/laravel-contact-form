@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-right')
<a href="/register" class="header__link">register</a>
@endsection

@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>Login</h2>
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span>メールアドレス</span>
            </div>
            <div class="form__group-content">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span>パスワード</span>
            </div>
            <div class="form__group-content">
                <input type="password" name="password" placeholder="例: coachtech1106">
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection