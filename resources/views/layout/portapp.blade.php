<!-- portのappファイル -->
<!DOCTYPE html>
<html land="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/port.css') }}">
    <title>port</title>
    <!-- ↓外部のjqeryへ接続 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/hamburger.js') }}"></script>
</head>
<body>
    
    @yield('content')
</body>
</html>