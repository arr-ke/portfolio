<!-- ポートフォリオ閲覧画面 -->

@extends('layout.portapp')

@section('content')

<h1>ポートフォリオ閲覧</h1>

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


<br>
<br>
<h3>
    <div class="box1">
        @foreach ($ports as $port)
            @if ($port->middle != NULL)
                製作中
            @endif
            <a href="{{ route('ports.show', $port->id) }}"><h3>{{ $port->titlename }}</h3></a>
        @endforeach
    </div>
</h3>

@endsection