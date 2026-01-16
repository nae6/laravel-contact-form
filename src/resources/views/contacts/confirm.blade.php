@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-form">
    <div class="form__heading">
        <h2>Confirm</h2>
    </div>
    <div class="form">
        <table class="confirm-table">
            <tr class="table__row">
                <th class="table__header">お名前</th>
                <td class="table__text">{{ $contact['last_name'] }}　{{ $contact['first_name'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">性別</th>
                <td class="table__text">{{ $contact['gender_label'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">メールアドレス</th>
                <td class="table__text">{{ $contact['email'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">電話番号</th>
                <td class="table__text">{{ $contact['tel'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">住所</th>
                <td class="table__text">{{ $contact['address'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">建物名</th>
                <td class="table__text">{{ $contact['building'] ?: '―' }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">お問い合わせの種類</th>
                <td class="table__text">{{ $contact['category_name'] }}</td>
            </tr>
            <tr class="confirm-table__row">
                <th class="table__header">お問い合わせ内容</th>
                <td class="table__text">{{ $contact['detail'] }}</td>
            </tr>
        </table>
    </div>
    <div class="form form__btn--flex">
        <form action="{{ route('thanks') }}" method="post">
            @csrf
            <div class="form__btn">
                <button class="form__btn-submit" type="submit">送信</button>
            </div>
        </form>
        <form action="{{ route('contacts.back') }}" method="post" >
            @csrf
            <div class="form__back-btn">
                <button type="submit">修正</button>
            </div>
        </form>
    </div>
</div>
@endsection