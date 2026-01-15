@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="{{ route('confirm') }}" method="post">
        @csrf
        <div class="form__row">
            <div class="form__title">
                <label class="form__label">
                    お名前 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input-name">
                    <input type="text" name="last-name" id="last_name" required placeholder="例: 山田" value="{{ old('last-name') }}">
                    <input type="text" name="first-name" id="first_name" required placeholder="例: 太郎" value="{{ old('first-name') }}">
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="gender">
                    性別 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input-radio">
                    <label class="form__radio">
                        <input type="radio" name="gender" value="male" required>
                        <span>男性</span>
                    </label>
                    <label class="form__radio">
                        <input type="radio" name="gender" value="female">
                        <span>女性</span>
                    </label>
                    <label class="form__radio">
                        <input type="radio" name="gender" value="other">
                        <span>その他</span>
                    </label>
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="email">
                    メールアドレス <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input">
                    <input type="email" name="email" id="email" required placeholder="例: test@example.com" value="{{ old('email') }}">
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__row">
                <div class="form__title">
                    <legend class="form__label">
                        電話番号 <span class="form__required">※</span>
                    </legend>
                </div>
                <div class="form__content">
                    <div class="form__input-tel">
                        <input name="tel1" type="text" inputmode="numeric" autocomplete="tel-national" maxlength="4" value="{{ old('tel1') }}" required placeholder="080">
                        <span>-</span>
                        <input name="tel2" type="text" inputmode="numeric" maxlength="4" value="{{ old('tel2') }}" placeholder="1234">
                        <span>-</span>
                        <input name="tel3" type="text" inputmode="numeric" maxlength="4" value="{{ old('tel3') }}" placeholder="5678">
                    </div>
                    <div class="form__error">
                        エラー
                    </div>
                </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="address">
                    住所 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input">
                    <input type="text" name="address" id="address" required placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="building">
                    建物
                </label>
            </div>
            <div class="form__content">
                <div class="form__input">
                    <input type="text" name="building" id="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="category">
                    お問い合わせの種類 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input">
                    <select name="category" class="form__select">
                        <option value="" selected disabled>選択してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__row">
            <div class="form__title">
                <label class="form__label" for="message">
                    お問い合わせ内容 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input">
                    <textarea name="message" id="message" placeholder="お問合せ内容をご記載ください">
                        {{ old('message') }}
                    </textarea>
                </div>
                <div class="form__error">
                    エラー
                </div>
            </div>
        </div>
        <div class="form__btn">
            <button class="form__btn-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection