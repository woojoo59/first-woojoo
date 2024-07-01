<?php
require_once ( "dbconfig.php" );


// print_r($row);
function base64_url_encode($input) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
    }
    



$i=0;
if((isset($_GET['view']) && $_GET['view'] !='' && is_numeric($_GET['view']))){

        $sql = "select max(idx) from board";
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $row = $stmt->fetch();


        $total = $row['max(idx)'];
        

if($_GET['view']>$total){
        echo '<script>';
        echo 'alert("존재하지 않는 게시판 입니다.")';
        echo '</script>';
        echo '<script>';
        echo 'self.location.href="http://localhost/boardproject/"';
        echo '</script>';
}

$sql = 'update board set hit = hit + 1 where idx = :idx';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $_GET['view']);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql = 'select * from board where idx='.$_GET['view'];
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$sql = 'select * from file_upload where idx='.$_GET['view'];
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$file = $stmt->fetchAll();




$sql = "select uname from usertbl where useridx = :useridx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx', $row['useridx']);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$username = $stmt->fetch();


$creator=$username['uname'];





} else {

        echo '<script>';
        echo 'alert("잘못된 접근입니다.")';
        echo '</script>';
        echo '<script>';
        echo 'self.location.href="http://localhost/boardproject/"';
        echo '</script>';
}
