<!-- ユーザー登録画面 -->

@extends('layout.userapp')

@section('content')

<h1>ユーザー登録</h1>

<br>
<br>

<!-- ログイン画面 -->
<form action="{{ route('users.index') }}" class="form2" method="get">
    <button type="submit" class="submit2">ユーザーログイン</button>
</form>

<br>
<br>

<form action="" class="form1">
    <h3>ID <input type="text" class="text4"></h3>
    <h3>PW <input type="text" class="text5"></h3>
    <h3>PW確認 <input type="text" class="text6"></h3>

    <br>
    <br>
    <br>
    <br>

    <button type="submit" class="submit1">登録</button>
</form>

@endsection