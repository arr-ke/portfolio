// ハンバーガーメニュー関数JSファイル
$(function () {
    // ハンバーガーメニュークリック処理
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('#header .nav').toggleClass('active');
    });

    // メニュー内リンククリック処理
    $('.nav a').click(function () {
        $('.hamburger').removeClass('active');
        $('#header .nav').removeClass('active');
    });
});