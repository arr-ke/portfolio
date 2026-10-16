<!-- 未ログインエラー画面 -->

@extends('layout.userapp')

@section('content')

<h1>エラー</h1>

<br>
<br>
<br>
<br>


@if (session('value') == '1')
    <h3 class="text3">リンクエラーです。</h3>
    <h3 class="text3">000-0000-0000</h3>
    <h3 class="text3">この電話番号にご連絡ください。</h3>
@elseif (session('value') == '2')
    <h3 class="text3">原因不明エラーです。</h3>
    <h3 class="text3">000-0000-0000</h3>
    <h3 class="text3">この電話番号にご連絡ください。</h3>
@endif

@endsection