@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="post">
        @csrf
        <table class="confirm-table__inner">
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                    <input type="text" name="name" value="{{ $contact['name'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    <input type="text" name="name" value="{{ $contact['gender'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                    <input type="text" name="email" value="{{ $contact['email'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                    <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                    <input type="text" name="name" value="{{ $contact['address'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                    <input type="text" name="name" value="{{ $contact['building'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                    <input type="text" name="name" value="{{ $contact['category'] }}" readonly>
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                    <input type="text" name="content" value="{{ $contact['message'] }}" readonly>
                </td>
            </tr>
        </table>
        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button type="submit">修正</button>
        </div>
    </form>
</div>
@endsection