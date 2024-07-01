<?php

include '../dbconfig.php';

$sql = "select * from usertbl";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetchAll();

