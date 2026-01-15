@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="form__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="post">
        @csrf
        <table class="confirm-table">
            <tr class="table__row">
                <th class="table__header">お名前</th>
                <td class="table__text">
                    <input type="text" name="name" value="{{ $contact->full_name }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">性別</th>
                <td class="table__text">
                    <input type="text" name="name" value="{{ $contact->gender }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">メールアドレス</th>
                <td class="table__text">
                    <input type="text" name="email" value="{{ $contact->email }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">電話番号</th>
                <td class="table__text">
                    <input type="text" name="tel" value="{{ $contact->full_tell }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">住所</th>
                <td class="table__text">
                    <input type="text" name="name" value="{{ $contact->address }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">建物名</th>
                <td class="table__text">
                    <input type="text" name="name" value="{{ $contact->building }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">お問い合わせの種類</th>
                <td class="table__text">
                    <input type="text" name="name" value="{{ $contact['category'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">お問い合わせ内容</th>
                <td class="table__text">
                    <input type="text" name="content" value="{{ $contact->detail }}" readonly>
                </td>
            </tr>
        </table>
        <div class="form__btn">
            <button class="form__btn-submit" type="submit">送信</button>
            <a href="{{ route('index') }}">修正</a>
        </div>
    </form>
</div>
@endsection