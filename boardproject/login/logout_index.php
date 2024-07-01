<?php

session_start();
session_unset();
session_destroy();

    echo '<script>';
    echo 'alert("로그아웃 되었습니다.")';
    echo '</script>';
    echo '<script>';
    echo 'window.location.href = "http://localhost/boardproject/"';
    echo '</script>';


// header( 'Location: index.html' );
?>