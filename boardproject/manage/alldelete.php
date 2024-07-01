<?php

include '../dbconfig.php';


function base64_url_encode($input) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($input));
}

$sql='delete from comments where useridx = 0';
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql='select idx from board where useridx = 0';
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$all = $stmt->fetchAll();


foreach($all as $al){
    $sql='select filename from file_upload where idx = :idx';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $al['idx']);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $delete = $stmt->fetchAll();

    $sql='delete from file_upload where idx = :idx';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $al['idx']);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    


foreach($delete as $ds){


    $name = $ds['filename'];



    
    
    
            $fname = explode('.',$name);
            $en = base64_url_encode($fname[0]);
            $en .= '.';
            $en .= $fname[1];



            
            
            




            unlink("../uploads/$en");





}
}










$sql='delete from board where useridx = 0';
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();



header( 'Location: http://localhost/boardproject/' );