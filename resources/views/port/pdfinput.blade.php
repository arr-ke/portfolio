<!-- ポートフォリオPDFインプット画面 -->

@extends('layout.portapp')

@section('content')

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

<style>
    body {
        /* 背景色 */
        background-color: {{ $port->backgroundcolor }};
    }

    h1 {
        /* 中央揃え */
        text-align: center;
    }

    h3 {
        /* 中央揃え */
        text-align: center;
    }

    .header1 {
        position: fixed;
        display: flex;
        /* 背景色 */
        background-color: white;
        /* 内側サイズ */
        margin-left: 950px;
    }
</style>

<h3>
    <h1 style="font-size: {{ $port->titlenamesize }}px; color: {{ $port->titlenamecolor }};">
        {{ $port->titlename }}
    </h1>
        <br>
    <h3>
        
        @php
            $count2 = 1;
        @endphp
    <div class="header1">
        @foreach ($portitems as $portitem)
            <!-- ↓ユーザIDとログインIDの一致とポートIDとポート項目のポートIDが一致しているのかを真偽判定しています。 -->
            @if (Auth::id() == $port->user_id && $port->id == $portitem->port_id)
                <a href="#itemname{{ $count2 }}">{{ $portitem->itemname }}  </a>

                @php
                    $count2++;
                @endphp
            @endif
        @endforeach

        <hr>
    </div>

    <hr>

        @php
            $count2 = 1;
            $count2++;
        @endphp

        @foreach ($portitems as $portitem)
            <!-- ↓ユーザIDとログインIDの一致とポートIDとポート項目のポートIDが一致しているのかを真偽判定しています。 -->
            @if (Auth::id() == $port->user_id && $port->id == $portitem->port_id)
                <div style="font-size: {{ $portitem->itemfontsize }}px; color: {{$portitem->itemfontcolor }};" id="itemname{{ $count2 }}">
                    {{ $portitem->itemname }}
                </div>
                <div style="font-size: {{ $portitem->contentsize }}px; color: {{$portitem->contentcolor }};">
                    {{ $portitem->contentname }}
                </div>

                @php
                    $count = false;
                    $count2++;
                @endphp
                
                @foreach ($portitemimgs as $portitemimg)
                    <!-- ↓ポートIDとポート項目画像のポートIDの一致とポート項目IDとポート項目画像のポート項目IDが一致しているのか
                            ↓のかを真偽判定しています。 -->
                    @if ($port->id == $portitemimg->port_id && $portitem->id == $portitemimg->portitem_id)
                        @php
                            $count = true;
                            break;
                        @endphp
                    @endif
                @endforeach

                <!-- ↓countがtrueなのかを真偽判定しています。 -->
                @if ($count == true)
                    <br>
                    <div class="img1">
                @endif

                @php
                    $count1 = 0;
                @endphp

                    @foreach ($portitemimgs as $portitemimg)
                        <!-- ↓ポートIDとポート項目画像のポートIDの一致とポート項目IDとポート項目画像のポート項目IDが一致しているのか
                                ↓のかを真偽判定しています。 -->
                        @if ($port->id == $portitemimg->port_id && $portitem->id == $portitemimg->portitem_id)
                                @php
                                    $count1++;
                                @endphp
                                <img src="{{ asset($portitemimg->image_name) }}" height="100" width="150">
                        @endif
                        <!-- ↓count1が5なのかを真偽判定しています。 -->
                        @if ($count1 == 5)
                            </div>
                            <br>
                            <div class="img1">
                        @endif
                    @endforeach

                <!-- ↓countがtrueなのかを真偽判定しています。 -->
                @if ($count == true)
                    </div>
                @endif

                <hr>
            @endif
        @endforeach
    </h3>
</h3>

<form action="" class="form1">
    <button type="submit" class="submit1">PDF出力</button>
</form>

@endsection