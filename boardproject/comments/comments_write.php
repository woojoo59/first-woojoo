<?php
include '../dbconfig.php';
session_start();
$user_id = $_SESSION['useridx'];
$com_content = $_POST['com'];





function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$safe_input = sanitize_input($com_content);




$sql = "insert into comments(idx, useridx, content, rdate)
value(:idx, :useridx, :com, now())";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx', $user_id);
$stmt->bindParam(':com', $safe_input);
$stmt->bindParam(':idx', $_POST['idx']);

$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
header( 'Location: http://localhost/boardproject/view.html?view='.$_POST['idx'] );