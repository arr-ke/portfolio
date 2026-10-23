<!-- 未ログインエラー画面 -->

@extends('layout.portapp')

@section('content')

<h1>エラー</h1>

<br>

<header id="header">
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <nav class="nav">
        <ul>
            <h3 class="text1">{{ Auth::user()->name }}</h3>

            <!-- ↓ポートフォリオ一覧画面 -->
            <form action="{{ route('ports.index') }}" class="form3">
                <button type="submit" class="submit2">一覧</button>
            </form>

            <br>

            <!-- ユーザー登録画面 -->
            <form action="{{ route('ports.logout') }}" class="form2" onsubmit="return confirm('ログアウトしますか')" method="get">
                <button type="submit" class="submit2">ログアウト</button>
            </form>

        </ul>
    </nav>
</header>

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