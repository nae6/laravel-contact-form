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
        <form action="{{ route('admin.search') }}" method="get" class="search__form">
            <input type="text" name="keyword" value="{{ request('keyword') }}" class="search__input" placeholder="名前やメールアドレスを入力してください">
            <select name="gender" class="search__select">
                <option value="" disabled {{ request('gender') === null ? 'selected' : '' }}>性別</option>
                <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>
            <select name="category" class="search__select">
                <option value="" disabled {{ request('category') === null ? 'selected' : '' }}>お問い合わせの種類</option>
                <option value="all" {{ request('category') === 'all' ? 'selected' : '' }}>全て</option>
                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ (string)request('category') === (string)$category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>
            <input type="date" name="created_at" value="{{ request('created_at') }}" class="search__date">
            <button type="submit" class="search__btn search__btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="search__btn search__btn-reset">リセット</a>
        </form>
    </div>
    <!-- other functions -->
    <div class="functions">
        <form action="" method="" class="export">
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
                    <p>{{ $contact->last_name }}　{{ $contact->first_name }}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->gender_text}}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->email}}</p>
                </td>
                <td class="table__items">
                    <p>{{ $contact->category?->content }}</p>
                </td>
                <td class="table__items">
                    <a href="#modal-{{ $contact->id }}" class="modal-open-btn">詳細</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <!-- modal -->
    @foreach ($contacts as $contact)
    <div class="modal" id="modal-{{ $contact->id }}">
        <div class="modal-wrapper">
            <a href="#" class="close">x</a>

            <div class="modal-content">
                <dl class="modal-items">
                    <dt class="item-title">お名前</dt>
                    <dd class="item__text">{{ $contact->last_name }}　{{ $contact->first_name }}</dd>
                </dl>

                <dl class="modal-items">
                    <dt class="item-title">性別</dt>
                    <dd class="item__text">{{ $contact->gender_text }}</dd>
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
                <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" class="delete-btn">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn__submit">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection