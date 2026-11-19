<!-- ポートフォリオPDFインプット画面 -->

<!-- ↓ブラウザー表示しているのかを真偽判定しています。 -->
@if (empty($isPdf))
    @extends('layout.portapp')

    @section('content')
@endif


<!DOCTYPE html>
<html land="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <title>port</title>

    <style>
        /* 日本語フォントの設定 */
        @font-face {
            font-family: 'ipaexg';
            font-style: normal;
            font-weight: normal;
            src: url("file://{{ storage_path('fonts/ipaexg.ttf') }}") format('truetype');
        }

        /* 太字（bold）用を追加 */
        @font-face {
            font-family: 'ipaexg';
            font-style: normal;
            font-weight: bold;
            src: url("file://{{ storage_path('fonts/ipaexg.ttf') }}") format('truetype');
        }
        
        * {
            font-family: 'ipaexg', sans-serif;;
        }

        html {
            /* リンク移動時のヘッダー高さ調整 */
            scroll-padding-top: 100px;
        }

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
            background-color: #CCFF99;
            /* 内側サイズ */
            margin-top: -170px;
            margin-left: -20px;
            /* 外側サイズ */
            padding-left: 30px;
            padding-top: 55px;
            /* 高さサイズ */
            height: 50px;
            /* 横サイズ */
            width: 1500px;
        }
    </style>
</head>

<body>

<!-- ↓ブラウザー表示しているのかを真偽判定しています。 -->
@if (empty($isPdf))
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

                <!-- ↓ポートフォリオ一覧画面 -->
                <form action="{{ route('ports.index') }}" class="form3" method="get">
                    <button type="submit" class="submit2">一覧</button>
                </form>

                <!-- ↓ポートフォリオ一覧画面 -->
                <form action="" class="form3">
                    <button type="submit" class="submit2">編集</button>
                </form>

                <form action="" class="form3">
                    <button type="submit" class="submit2">白紙作成</button>
                </form>

                <form action="" class="form4">
                    <button type="submit" class="submit2">デフォルト <br> 作成</button>
                </form>

                <!-- ↓ポートフォリオ閲覧画面 -->
                <form action="{{ route('ports.show', $port->id) }}" class="form6" method="get">
                    <button type="submit" class="submit2">閲覧</button>
                </form>
            </ul>
        </nav>
    </header>
@endif



<h1 style="font-size: {{ $port->titlenamesize }}px; color: {{ $port->titlenamecolor }};">
        {{ $port->titlename }}
</h1>

<h3>
        
    @php
        $count2 = 1;
    @endphp

    <!-- ↓ブラウザー表示しているのかを真偽判定しています。 -->
    @if (empty($isPdf))
        <div class="header1">
            @foreach ($portitems as $portitem)
                <!-- ↓ユーザIDとログインIDの一致とポートIDとポート項目のポートIDが一致しているのかを真偽判定しています。 -->
                @if (Auth::id() == $port->user_id && $port->id == $portitem->port_id)
                    <a href="#itemname{{ $count2 }}">
                        <!-- ↓文字数を超える者は、...表示しています。 -->
                        {{ Str::limit($portitem->itemname, 5, '...') }}
                    </a>
                    
                    @php
                        $count2++;
                    @endphp

                    <!-- ↓count2が10以下なのかを真偽判定しています。 -->
                    @if ($count2 <= 10)
                        　
                    @endif
                @endif
            @endforeach

        </div>
    @endif

    <hr>

    @php
        $count2 = 1;
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

                        <!-- ↓ブラウザー表示していないのかを真偽判定しています。 -->
                        @if (!empty($isPdf))
                            <img src="{{ public_path($portitemimg->image_name) }}" height="100" width="135">
                        @else
                            <img src="{{ asset($portitemimg->image_name) }}" height="100" width="150">
                        @endif
                    @endif
                    <!-- ↓count1が5なのかを真偽判定しています。 -->
                    @if ($count1 == 5)
                        <br>
                        <br>
                    @endif
                @endforeach
            <hr>
        @endif
    @endforeach
</h3>

<!-- ↓ブラウザー表示しているのかを真偽判定しています。 -->
@if (empty($isPdf))
    <form action="{{ route('ports.pdfoutput') }}" class="form1" method="post">
        @csrf
        <input type="hidden" name="port_id" value="{{ $port->id }}">
        <button type="submit" class="submit1">PDF出力</button>
    </form>
@endif

</body>
</html>

<!-- ↓ブラウザー表示しているのかを真偽判定しています。 -->
@if (empty($isPdf))
    @endsection
@endif