<!-- ログイン画面 -->

@extends('layout.userapp')

@section('content')

<!-- ↓セッションがあるのかを真偽判定しています。 -->
@if (session('userloginerror'))
    <div id="msg" style="display:none;">
        {{ session('userloginerror') }}
    </div>
@endif

<h1>ログイン</h1>

<br>
<br>

<!-- ユーザー登録画面 -->
<form action="{{ route('users.create') }}" class="form2" method="get">
    <button type="submit" class="submit2">ユーザー登録</button>
</form>

<br>
<br>

<form action="{{ route('users.login') }}" class="form1" method="post">
    @csrf
    <h3>
        ID <input type="text" name="id" class="text1">
        <br>
        PW <input type="password" name="pw" class="text2">
    </h3>

    <br>
    <br>
    <br>
    <br>

    <button type="submit" class="submit1">ログイン</button>
</form>

@endsection