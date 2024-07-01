<?php
session_start();
include '../dbconfig.php';
if(!isset($_SESSION['useridx'])){
    
        echo '<script>';
        echo 'alert("잘못된 접근입니다.")';
        echo '</script>';
        echo '<script>';
        echo 'self.location.href="http://localhost/boardproject/"';
        echo '</script>';
}
$user_id = $_SESSION['useridx'];

// print_r($_POST);
// echo "<br>";
// // print_r($_FILES['userfile']['name'][0]);
// print_r($_FILES);
// echo "<br>";

// print_r($content);
// print_r($_FILES['userfile']);
// echo "<br>";

// foreach($_FILES['userfile']['name'] as $value) {
//     echo $value;
//     echo "<br>";
// }
// exit;
// print_r($_FILES['file']);
// echo "<hr>";
// print_r($_FILES['file']['tmp_name']);

// $i=1;
// foreach($_FILES['file']['tmp_name'] as $value){

//     ${"file" . $i} = $value;
//     ${"file_name". $i} = $_FILES['file']['name'][$i-1];
//     ${"base64_file". $i} = base64_encode(file_get_contents(${"file" . $i}));

//     $i++;
// }




function base64_url_encode($input) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
}





$subject = $_POST['write_subject'];
$content = $_POST['write_content'];

function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


$safe_input = sanitize_input($subject);


$sql = "insert into board(`subject`, `content`, `useridx`, `rdate`)
VALUE (:subject, :content, :user_id, now())";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':subject', $safe_input);
$stmt->bindParam(':content', $content);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();




$sql = "SELECT MAX(idx) AS idx FROM board";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();


$i=0;
$uploadDir = 'C:\xampp\htdocs\boardproject\uploads/';



if($_FILES['file']['tmp_name'][0] != ''){
foreach($_FILES['file']['tmp_name'] as $value){




    $tmp = $value;
    $name = $_FILES['file']['name'][$i];
    $type = $_FILES['file']['type'][$i];
    $size = $_FILES['file']['size'][$i];


    

    








    
    
    
    $uploadDir = 'C:\xampp\htdocs\boardproject\uploads/';
    

    
    
    
    
    
    
    
    
    $currentTime = time(); // 현재 시간을 timestamp로 얻음
    $newFileName = $currentTime . '_' . $name; // 새 파일 이름 생성
        
    $fname = explode('.',$newFileName);
    $en = base64_url_encode($fname[0]);
    $en .= '.';
    $en .= $fname[1];
    $file_path = $uploadDir.$en;
    echo $file_path;
    
    
    move_uploaded_file($tmp, $file_path);


    



    
    $sql = "insert into file_upload (idx, filename, filesize)
    value (:idx, :filename, :filesize)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $row['idx']);
    $stmt->bindParam(':filename', $newFileName);
    $stmt->bindParam(':filesize', $size);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $i++;
}}


header( 'Location: http://localhost/boardproject/' );