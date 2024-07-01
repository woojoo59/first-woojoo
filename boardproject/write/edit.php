<?php
include '../dbconfig.php';

$sql = 'select * from board where idx='.$_GET['view'];
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$sql = 'select * from file_upload where idx='.$_GET['view'];
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

// echo $row['imglist'];
