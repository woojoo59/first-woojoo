<?php

include '../dbconfig.php';
$idx = $_GET['view'];

function base64_url_encode($input) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
}

$sql='delete from comments where idx = :idx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $idx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql='select filename from file_upload where idx = :idx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $idx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$delete = $stmt->fetchAll();

foreach($delete as $ds){


    $name = $ds['filename'];



    
    
    
            $fname = explode('.',$name);
            $en = base64_url_encode($fname[0]);
            $en .= '.';
            $en .= $fname[1];



            
            
            




            unlink("../uploads/$en");





}



$sql='delete from file_upload where idx = :idx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $idx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();



$sql='delete from board where idx = :idx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $idx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

echo "<script>";
echo "alert('삭제되었습니다.')";
echo "</script>";
echo "<script>";
echo "window.location.href='http://localhost/boardproject/'";
echo "</script>";

