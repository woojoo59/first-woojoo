<?php

include '../dbconfig.php';

$sql = "select count(*) cnt from usertbl where username = '".$_POST['id']."'";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();

$rs = array("result" => $row['cnt'] ? "exist" : "not_exist");

die(json_encode($rs));