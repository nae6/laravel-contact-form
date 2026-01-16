@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="{{ route('confirm') }}" method="post" novalidate>
        @csrf
        <div class="form__row">
            <div class="form__title">
                <label class="form__label">
                    お名前 <span class="form__required">※</span>
                </label>
            </div>
            <div class="form__content">
                <div class="form__input-name">
                    <input type="text" name="last_name" id="last_name" placeholder="例: 山田" value="{{ old('last_name') }}" required>
                    <input type="text" name="first_name" id="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}" required>
                </div>
                <div class="form__error">
                    @error('last_name')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__error">
                    @error('first_name')
                    <p>{{ $message }}</p>
                    @enderror
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
                        <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }} checked required>
                        男性
                    </label>
                    <label class="form__radio">
                        <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                        女性
                    </label>
                    <label class="form__radio">
                        <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>
                        その他
                    </label>
                </div>
                <div class="form__error">
                    @error('gender')
                    <p>{{ $message }}</p>
                    @enderror
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
                    <input type="email" name="email" id="email" placeholder="例: test@example.com" value="{{ old('email') }}" required>
                </div>
                <div class="form__error">
                    @error('email')
                    <p>{{ $message }}</p>
                    @enderror
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
                        <input name="tel1" type="text" autocomplete="tel-national" maxlength="5" value="{{ old('tel1') }}" placeholder="080" required>
                        <span>-</span>
                        <input name="tel2" type="text" maxlength="5" value="{{ old('tel2') }}"  placeholder="1234" required>
                        <span>-</span>
                        <input name="tel3" type="text" maxlength="5" value="{{ old('tel3') }}"  placeholder="5678" required>
                    </div>
                    <div class="form__error">
                        @if ($errors->has('tel1'))
                        <p>{{ $errors->first('tel1') }}</p>
                        @elseif ($errors->has('tel2'))
                        <p>{{ $errors->first('tel2') }}</p>
                        @elseif ($errors->has('tel3'))
                        <p>{{ $errors->first('tel3') }}</p>
                        @endif
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
                    <input type="text" name="address" id="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" required>
                </div>
                <div class="form__error">
                    @error('address')
                    <p>{{ $message }}</p>
                    @enderror
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
                    <select name="category_id" class="form__select" required>
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                            選択してください
                        </option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    <p>{{ $message }}</p>
                    @enderror
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
                    <textarea name="detail" id="message" placeholder="お問合せ内容をご記載ください" required>{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__btn">
            <button class="form__btn-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection