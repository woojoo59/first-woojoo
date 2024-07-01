<?php
include '../dbconfig.php';
session_start();


$user_id = $_SESSION['useridx'];
$cidx = $_POST['subidx'];
$com_content = $_POST['input'];



$sql = "select * from comments where cidx=:cidx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cidx', $cidx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row_coco = $stmt->fetch();
$comg = $row_coco['comg'];
$corder = $row_coco['corder'];


function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

$safe_input = sanitize_input($com_content);






$sql = "insert into comments(idx, useridx, content, rdate, comg)
value(:idx, :useridx, :com, now(), :comg)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx', $user_id);
$stmt->bindParam(':com', $safe_input);
$stmt->bindParam(':idx', $row_coco['idx']);
$stmt->bindParam(':comg', $cidx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
header( 'Location: ../view.html?view='.$row_coco['idx'] );