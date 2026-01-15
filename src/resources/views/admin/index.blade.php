@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-right')
<a href="/register" class="header__link">logout</a>
@endsection

@section('content')
<div class="form_content">
    <div class="form__heading">
        <h2>Admin</h2>
    </div>
    <!-- search -->
    <div class="contact__search">
        <form action="" method="get" class="search__form">
            @csrf
            <input type="text" name="keyword" value="" class="search__input" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="search__select">
                <option value="" selected disabled>性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select name="category" class="search__select">
                <option value="" selected disabled>お問い合わせの種類</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <input type="date" name="created_at" value="" class="search__date">
            <button type="submit" class="search__btn search__btn-search">検索</button>
            <button type="submit" class="search__btn search__btn-reset">リセット</button>
        </form>
    </div>
    <!-- functions -->
    <div class="functions">
        <form action="" methot="" class="export">
            <button type="submit" class="export__btn">エクスポート</button>
        </form>
        <div class="paginate">
            {{ $contacts->links('vendor.pagination.default') }}
        </div>
    </div>
    <!-- Contacts -->
    <div class="contacts">
        <table class="contacts-table">
            <tr class="table__row">
                <th class="table__header">お名前</th>
                <th class="table__header">性別</th>
                <th class="table__header">メールアドレス</th>
                <th class="table__header">お問い合わせの種類</th>
                <th class="table__header"></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="table__row">
                <td class="table__items">
                    <p>{{ $contact->full_name }}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->gender}}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->email}}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->category?->content }}</p>
                </td>
                <td class="table__items">
                    <a href="#modal" class="modal-open-btn">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

<!-- モーダル -->
<div class="modal" id="modal">
    <div class="modal-wrapper">
        <a href="#" class="close">x
            <!-- <img src="{{ asset('images/close.svg') }}" alt="閉じる"> -->
        </a>
        <div class="modal-content">
            <dl class="modal-items">
                <dt class="item-title">お名前</dt>
                <dd class="item__text">
                    {{ $contact->full_name }}
                </dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">性別</dt>
                <dd class="item__text">{{ $contact->gender }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">メールアドレス</dt>
                <dd class="item__text">{{ $contact->email }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">電話番号</dt>
                <dd class="item__text">{{ $contact->tel }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">住所</dt>
                <dd class="item__text">{{ $contact->address }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">建物</dt>
                <dd class="item__text">{{ $contact->building }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">お問い合わせの種類</dt>
                <dd class="item__text">{{ $contact->category?->content }}</dd>
            </dl>
            <dl class="modal-items">
                <dt class="item-title">お問い合わせ内容</dt>
                <dd class="item__text">{{ $contact->detail }}</dd>
            </dl>
        </div>
        <div class="modal-btn">
            <form method="POST" action="" class="delete-btn">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn__submit">削除</button>
            </form>
        </div>
    </div>
</div>