<?php

session_start();
session_unset();
session_destroy();

    echo '<script>';
    echo 'alert("로그아웃되었습니다.")';
    echo '</script>';
    echo '<script>';
    echo 'history.go(-1)';
    echo '</script>';


// header( 'Location: index.html' );
?>