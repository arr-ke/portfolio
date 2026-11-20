<!-- ポートフォリオ作成画面 -->

@extends('layout.portapp')

@section('content')


<h1>ポートフォリオ作成</h1>

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
            <h3 class="text1">{{ Auth::user()->name }}</h3>

            <!-- ↓ログアウト処理 -->
            <form action="{{ route('ports.logout') }}" class="form2" onsubmit="return confirm('ログアウトしますか')" method="get">
                <button type="submit" class="submit2">ログアウト</button>
            </form>

            <form action="" class="form3">
                <button type="submit" class="submit2">デフォルト作成</button>
            </form>

            <!-- ↓ポートフォリオ一覧画面 -->
            <form action="{{ route('ports.index') }}" class="form4" method="get">
                <button type="submit" class="submit2">一覧</button>
            </form>
        </ul>
    </nav>
</header>



@endsection