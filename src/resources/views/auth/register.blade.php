@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-right')
<a href="{{ route('login') }}" class="header__link">login</a>
@endsection

@section('content')
<div class="form__content">
    <div class="form__heading">
        <h2>Register</h2>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span>お名前</span>
            </div>
            <div class="form__group-content">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            </div>
        </div>
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
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection