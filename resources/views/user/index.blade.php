<!-- ログイン画面 -->

@extends('layout.userapp')

@section('content')

<h1>ログイン</h1>

<br>
<br>

<!-- ユーザー登録画面 -->
<form action="{{ route('users.create') }}" class="form2" method="get">
    <button type="submit" class="submit2">ユーザー登録</button>
</form>

<br>
<br>

<form action="" class="form1">
    <h3>ID <input type="text" class="text1"></h3>
    <h3>PW <input type="text" class="text2"></h3>

    <br>
    <br>
    <br>
    <br>

    <button type="submit" class="submit1">ログイン</button>
</form>

@endsection