@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="">
    <div class="form__heading">
        <h2>Admin</h2>
    </div>
    <!-- search -->
    <div class="">
        <form action="" method="get" class="">
            @csrf
            <div class="create-form__item">
                <input type="text" name="keyword" value="{{ old('keyword') }}" class="">
                <select name="gender" class="">
                    <option value="" selected disabled>性別</option>
                    <option value="male">男性</option>
                    <option value="female">女性</option>
                    <option value="other">その他</option>
                </select>
                <select name="category" class="">
                    <option value="" selected disabled>お問い合わせの種類</option>
                    <!-- foreachでcategory表示 -->
                    <option value="male">男性</option>
                </select>
                <input type="date" name="created_at" value="{{ old('created_at') }}" class="">
            </div>
            <div class="search__btn">
                <button type="submit" class="search__btn-submit">検索</button>
            </div>
            <div class="search__btn">
                <button type="submit" class="search__btn-reset">リセット</button>
            </div>
        </form>
    </div>
    <!-- functions -->
    <div>
        <div>
            エクスポートbtn
        </div>
        <div>
            ページネーション
        </div>
    </div>
    <!-- Contacts List -->
    <div class="todo-table">
        <table class="todo-table__inner">
            <colgroup>
                <col class="col-name">
                <col class="col-gender">
                <col class="col-mail">
                <col class="col-category">
                <col class="col-detail">
            </colgroup>
            <tr class="todo-table__row">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="todo-table__row">
                <td>
                    <p>{{ $contacts->name }}</p>
                </td>
                <td>
                    <p>{{ $contacts->gender}}</p>
                </td>
                <td>
                    <p>{{ $contacts->email}}</p>
                </td>
                <td>
                    <p>{{ $todo->category?->name }}</p>
                </td>
                <td class="todo-table__item">
                    <a href="#modal" class="modal-open-button">詳細</a>
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
        <a href="#" class="close">&times;</a>
        <div class="modal-content">
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">お名前</dt>
                <dd class="confirm-table__text">{{ $contact->name }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">性別</dt>
                <dd class="confirm-table__text">{{ $contact->gender }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">メールアドレス</dt>
                <dd class="confirm-table__text">{{ $contact->email }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">電話番号</dt>
                <dd class="confirm-table__text">{{ $contact->tel }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">住所</dt>
                <dd class="confirm-table__text">{{ $contact->address }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">建物</dt>
                <dd class="confirm-table__text">{{ $contact->building }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">お問い合わせの種類</dt>
                <dd class="confirm-table__text">{{ $contact->category?->name }}</dd>
            </dl>
            <dl class="confirm-table__row">
                <dt class="confirm-table__header">お問い合わせ内容</dt>
                <dd class="confirm-table__text">{{ $contact->content }}</dd>
            </dl>
        </div>
        <div class="modal-btn">
            <form method="POST" action="{{ route('contacts.destroy', $contact) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>
    </div>
</div>