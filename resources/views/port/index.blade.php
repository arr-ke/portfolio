<!-- ログイン画面 -->

@extends('layout.userapp')

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

<!-- ユーザー登録画面 -->
<form action="{{ route('ports.logout') }}" class="form2" onsubmit="return confirm('ログアウトしますか')" method="get">
    <button type="submit" class="submit2">ログアウト</button>
</form>

<br>
<br>

@foreach ($ports as $port)
    <h3>{{ $port->titlename }}</h3>
@endforeach

@endsection