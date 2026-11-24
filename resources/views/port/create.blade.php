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

<h3>
    <form action="{{ route('ports.store') }}" method="post">
        <button type="submit" name="create" class="submit3">作成</button>
        　
        <button type="submit" name="save" class="submit3">途中保存</button>

        <br>
        <br>

        タイトル
        <br>
        <input type="text" name="title" maxlength="30" value="{{ old('title') }}" placeholder="30文字以内" class="text2" required>

        <br>
        <br>

        タイトル文字サイズ
        <br>
        <select name="titlesize" class="select">
            @for ($i = 32; $i <= 40; $i++)
                <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
            @endfor
        </select>

        <br>
        <br>

        タイトル文字色
        <br>
        <input type="color" name="titlecolor" value="{{ old('titlecolor') }}" class="color" required>

        <br>
        <br>

        背景
        <br>
        <input type="color" name="back1" value="{{ old('back1') }}" class="color">
        or
        <input type="file" name="back2">

        <br>
        <br>

        項目1名
        <br>
        <input type="text" name="itemname[]" maxlength="50" value="{{ old('itemname[]') }}" placeholder="50文字以内" class="text2" required>

        <br>
        <br>

        項目1名文字サイズ
        <br>
        <select name="itemfontsize[]" class="select">
            @for ($i = 24; $i <= 28; $i++)
                <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
            @endfor
        </select>

        <br>
        <br>

        項目1名文字色
        <br>
        <input type="color" name="itemfontcolor[]" value="{{ old('itemfontcolor[]') }}" class="color" required>

        <br>
        <br>

        項目1内容
        <br>
        <textarea name="contentname[]" maxlength="1000" rows="25" cols="100" value="{{ old('contentname[]') }}" placeholder="1000文字以内" required></textarea>

        <br>
        <br>

        項目1内容文字サイズ
        <br>
        <select name="contentsize[]" class="select">
            @for ($i = 15; $i <= 23; $i++)
                <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
            @endfor
        </select>

        <br>
        <br>

        項目1内容文字色
        <br>
        <input type="color" name="contentcolor[]" value="{{ old('contentcolor[]') }}" class="color" required>

        <br>
        <br>

        画像1
        <br>
        <input type="file" name="image[][]">

        <input type="hidden" name="milled" value="NULL">
    </form>

    <button type="bottan">+</button>
</h3>

@endsection