<!-- ユーザー登録画面 -->

@extends('layout.userapp')

@section('content')

<!-- ↓セッションがあるのかを真偽判定しています。 -->
@if (session('usercreateerror'))
    <div id="msg" style="display:none;">
        {{ session('usercreateerror') }}
    </div>
@endif

<h1>ユーザー登録</h1>

<br>
<br>

<!-- ログイン画面 -->
<form action="{{ route('users.index') }}" class="form2" method="get">
    <button type="submit" class="submit2">ユーザーログイン</button>
</form>

<br>
<br>

<form action="{{ route('users.store') }}" class="form1" method="post">
    @csrf

    <h3>
        ID <input type="text" name="id" minlength="5" maxlength="10" value="{{ old('id') }}" prttern="^(?=.*[a-zA-Z])(?=.*[0-9][a-zA-Z0-9]{5,10}$" placeholder="英数字を含む文字数5～10文字以内" class="text4" required>
        <br>
        PW <input type="password" name="pw" minlength="10" maxlength="20" value="{{ old('pw') }}" prttern="^(?=.*[a-zA-Z])(?=.*[0-9][a-zA-Z0-9]{5,10}$" placeholder="英数字を含む文字数10～20文字以内" class="text5" required>
        <br>
        PW確認 <input type="password" name="pwasr" minlength="10" maxlength="20" value="{{ old('pwasr') }}" prttern="^(?=.*[a-zA-Z])(?=.*[0-9][a-zA-Z0-9]{5,10}$" placeholder="英数字を含む文字数5～10文字以内" class="text6" required>
    </h3>

    <br>
    <br>
    <br>
    <br>

    <button type="submit" class="submit1">登録</button>
</form>

@endsection