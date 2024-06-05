<?php

$servername = 'localhost';
$username = 'root';
$password = '4562516';
$db = 'woojoo';

try{
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "연결성공";
} catch (PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}
?>