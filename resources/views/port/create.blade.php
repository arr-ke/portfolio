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
        <button type="submit" name="create" value="create" class="submit3">作成</button>
        　
        <button type="submit" name="create" value="save" class="submit3">途中保存</button>

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

        <!-- 項目全体を囲む親コンテナ -->
        <div id="items-container">
            <!-- 1つ目のブロック（初期表示・削除不可） -->
            <div class="item-block" style="border: 1px; padding: 15px; margin-bottom: 20px;">
                <span class="label-itemname">項目1名</span>
                <br>
                <input type="text" name="itemname[]" maxlength="50" value="{{ old('itemname.0') }}" placeholder="50文字以内" class="text2" required>

                <br><br>

                <span class="label-itemfontsize">項目1名文字サイズ</span>
                <br>
                <select name="itemfontsize[]" class="select">
                    @for ($i = 24; $i <= 28; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <br><br>

                <span class="label-itemfontcolor">項目1名文字色</span>
                <br>
                <input type="color" name="itemfontcolor[]" value="{{ old('itemfontcolor.0', '#000000') }}" class="color" required>

                <br><br>

                <span class="label-contentname">項目1内容</span>
                <br>
                <textarea name="contentname[]" maxlength="1000" rows="25" cols="100" placeholder="1000文字以内" required>{{ old('contentname.0') }}</textarea>

                <br><br>

                <span class="label-contentsize">項目1内容文字サイズ</span>
                <br>
                <select name="contentsize[]" class="select">
                    @for ($i = 15; $i <= 23; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <br><br>

                <span class="label-contentcolor">項目1内容文字色</span>
                <br>
                <input type="color" name="contentcolor[]" value="{{ old('contentcolor.0', '#000000') }}" class="color" required>

                <br><br>

                <span class="label-image">画像1</span>
                <br>
                <input type="file" name="image[0][]" class="input-image">
            </div>
        </div>

        <!-- 追加・削除ボタン -->
        <div>
            <button type="button" id="add-btn">+</button>
            <button type="button" id="remove-btn" style="display: none;">-</button>
        </div>
    </form>

    
</h3>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('items-container');
    const addBtn = document.getElementById('add-btn');
    const removeBtn = document.getElementById('remove-btn');

    // ↓項目一覧の最小数
    const minItems = 1;
    
    // ↓項目一覧の最大数
    const maxItems = 10;

    // ボタンの表示・非表示と、番号を振り直す関数
    function updateState() {
        const blocks = container.querySelectorAll('.item-block');
        const count = blocks.length;

        // 1. ボタンの表示制御
        // 項目一覧が10であれば、＋ボタンを非表示
        addBtn.style.display = (count >= maxItems) ? 'none' : 'inline-block';
        // ↓項目一覧が1であれば、マイナスボタンを非表示
        removeBtn.style.display = (count <= minItems) ? 'none' : 'inline-block';

        // 2. 「項目1名」「項目2名」などの番号と、画像のname属性を更新
        blocks.forEach((block, index) => {
            const num = index + 1;
            block.querySelector('.label-itemname').textContent = `項目${num}名`;
            block.querySelector('.label-itemfontsize').textContent = `項目${num}名文字サイズ`;
            block.querySelector('.label-itemfontcolor').textContent = `項目${num}名文字色`;
            block.querySelector('.label-contentname').textContent = `項目${num}内容`;
            block.querySelector('.label-contentsize').textContent = `項目${num}内容文字サイズ`;
            block.querySelector('.label-contentcolor').textContent = `項目${num}内容文字色`;
            block.querySelector('.label-image').textContent = `画像${num}`;
            
            // 画像のname属性も image[0][], image[1][] のように揃える
            block.querySelector('.input-image').name = `image[${index}][]`;
        });
    }

    // ＋ボタンの処理
    addBtn.addEventListener('click', function () {
        const blocks = container.querySelectorAll('.item-block');
        if (blocks.length >= maxItems) return;

        // 1つ目のブロックを複製
        const clone = blocks[0].cloneNode(true);

        // 複製した項目の値をリセット(1つめのの値をコピーしないための対策)
        clone.querySelector('input[type="text"]').value = '';
        clone.querySelector('textarea').value = '';
        clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
        clone.querySelectorAll('input[type="color"]').forEach(color => color.value = '#000000');
        clone.querySelector('input[type="file"]').value = '';

        container.appendChild(clone);
        updateState();
    });

    // -ボタンの処理
    removeBtn.addEventListener('click', function () {
        const blocks = container.querySelectorAll('.item-block');
        if (blocks.length <= minItems) return;

        // 一番下のブロックを削除
        blocks[blocks.length - 1].remove();
        updateState();
    });

    updateState();
});
</script>

@endsection