<?php
include '../dbconfig.php';
// print_r($_POST);

function base64_url_encode($input) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
}


$sql = "select * from file_upload where idx = :idx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $_GET['view']);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetchAll();



for($x=0; $x<$_POST['hidden']; $x++){
    if(isset($row[$x]['filename'])){
        $result = str_replace('.', '_', $row[$x]['filename']);
        $res = str_replace(' ', '_', $result);
 


        if(isset($_POST[$res])){



            
            
            $uploadDir = 'C:\xampp\htdocs\boardproject\uploads/';
            
            
            $name = $row[$x]['filename'];
            
            
            

            
            
            
            

                
            $fname = explode('.',$name);
            $en = base64_url_encode($fname[0]);
            $en .= '.';
            $en .= $fname[1];



            
            
            




            unlink("../uploads/$en");

            

            $sql = "delete from file_upload where filename = :filename";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':filename', $row[$x]['filename']);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            

    }}
}






$subject = $_POST['write_subject'];
$content = $_POST['write_content'];





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
    
    
        
        print_r($row);
    
    
        
        $sql = "insert into file_upload (idx, filename, filesize)
        value (:idx, :filename, :filesize)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idx', $_GET['view']);
        $stmt->bindParam(':filename', $newFileName);
        $stmt->bindParam(':filesize', $size);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $i++;
    }}

$sql = "UPDATE board 
SET `subject` = :subject, `content` = :content 
WHERE idx = :idx";

function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}


$safe_input = sanitize_input($subject);

echo $safe_input;
echo "<hr>";
echo $content;
echo "<hr>";
echo $_GET['view'];
echo "<hr>";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':subject', $safe_input);
$stmt->bindParam(':content', $content);
$stmt->bindParam(':idx', $_GET['view']);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

header( 'Location: ../view.html?view='.$_GET['view'] );