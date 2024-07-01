<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 'id'와 'pw' 값 받기
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pw = isset($_POST['pw']) ? $_POST['pw'] : '';}

$uname = $id;


include '../dbconfig.php';

$sql = "select * from usertbl where uname = '{$uname}'";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$pwd = $row['userpassword'];
if(password_verify($pw, $pwd)){
    $rs = array("result" => "exist");
} else {
    $rs = array("reuslt" => "not_exist");
}
die(json_encode($rs));
// $sql = "select count(*) cnt from usertbl where username = '".$_POST['id']."'";
// $stmt = $conn->prepare($sql);
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $stmt->execute();
// $row = $stmt->fetch();

// $rs = array("result" => $row['cnt'] ? "exist" : "not_exist");

// die(json_encode($rs));