<?php
include '../dbconfig.php';
session_start();


$subidx=$_GET['subidx'];




$sql = 'select count(*) as cnt from comments where comg =:subidx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':subidx', $subidx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$re = $stmt->fetch();



if($re['cnt']==0){
    $sql='delete from comments where cidx = :subidx';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':subidx', $subidx);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    echo '<script>';
    echo 'history.go(-1)';
    echo '</script>';
} else {
    $sql = 'update comments set useridx = 0, content = "삭제된 댓글입니다." where cidx = :subidx';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':subidx', $subidx);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    echo '<script>';
    echo 'history.go(-1)';
    echo '</script>';
}




?>