<!-- ポートフォリオ閲覧画面 -->

@extends('layout.portapp')

@section('content')

<h1>{{ $port->titlename }}</h1>

<br>
<br>

<header id="header">
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <nav class="nav">
        <ul>
            
            <br>
            <br>

            <!-- ユーザー登録画面 -->
            <form action="{{ route('ports.logout') }}" class="form2" onsubmit="return confirm('ログアウトしますか')" method="get">
                <button type="submit" class="submit2">ログアウト</button>
            </form>

            <br>

            <!-- ↓ポートフォリオ一覧画面 -->
            <form action="{{ route('ports.index') }}" class="form3">
                <button type="submit" class="submit2">一覧</button>
            </form>

            <br>

            <!-- ↓ポートフォリオ一覧画面 -->
            <form action="" class="form3">
                <button type="submit" class="submit2">編集</button>
            </form>

            <br>

            <form action="" class="form3">
                <button type="submit" class="submit2">白紙作成</button>
            </form>

            <br>

            <form action="" class="form4">
                <button type="submit" class="submit2">デフォルト作成</button>
            </form>
        </ul>
    </nav>
</header>


<h3>
    <div class="box2" style="background-color: {{$port->backgroundcolor }};">
        <h1>{{ $port->titlename }}</h1>
            <br>
            <br>
        <h3>
            @foreach ($portitems as $portitem)
                {{ $portitem->itemname }}
                <br>
                {{ $portitem->contentname }}
                <hr>
            @endforeach
        </h3>
    </div>
</h3>

<form action="" class="form1">
    <button type="submit" class="submit1">PDF出力</button>
</form>

<br>

<form action="" class="form1">
    <button type="submit" class="submit1">削除</button>
</form>

@endsection