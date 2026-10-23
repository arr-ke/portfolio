<!-- ポートフォリオ一覧画面 -->

@extends('layout.portapp')

@section('content')

<!-- 値があるのかを真偽判定しています。 -->
@if (isset($loginsession))
    <div id="msg" style="display:none;">
        {{ $loginsession }}
    </div>
    @php 
        unset($loginsession)
    @endphp
@endif

<!-- ↓セッションがあるのかを真偽判定しています。 -->
@if (session('userloginerror'))
    <div id="msg" style="display:none;">
        {{ session('userloginerror') }}
    </div>
@endif

<h1>ポートフォリオ一覧</h1>

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

            <!-- ユーザー登録画面 -->
            <form action="{{ route('ports.logout') }}" class="form2" onsubmit="return confirm('ログアウトしますか')" method="get">
                <button type="submit" class="submit2">ログアウト</button>
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
    <div class="box1">
        @foreach ($ports as $port)
        <!-- ↓ユーザIDとログインIDが一致しているのかを真偽判定しています。 -->
            @if (Auth::id() == $port->user_id)
                <!-- middleがNULLでないかを真偽判定しています。 -->
                @if ($port->middle != NULL)
                    製作中
                @endif
                <a href="{{ route('ports.show', $port->id) }}"><h3>{{ $port->titlename }}</h3></a>
            @endif
            <br>
        @endforeach
    </div>
</h3>

@endsection