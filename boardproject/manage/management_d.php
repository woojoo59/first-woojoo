<?php
session_start();
if($_SESSION['username'] !='master'){
    echo '<script>';
        echo 'alert("잘못된 접근입니다.")';
        echo '</script>';
        echo '<script>window.location.href = "http://localhost/boardproject/"</script>';
}
include '../dbconfig.php';

$ids = $_GET['ids'];

$sql='select idx from board where useridx = :idx';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idx', $ids);
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






$sql = "delete from board WHERE useridx = :useridx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx', $ids);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

$sql = "select cidx from comments WHERE useridx = :useridx order by cidx desc";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx', $ids);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$co = $stmt->fetchAll();

foreach($co as $cd){
    $subidx = $cd['cidx'];

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

    } else {
        $sql = 'update comments set useridx = 0, content = "삭제된 댓글입니다." where cidx = :subidx';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':subidx', $subidx);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

}
}







$sql = 'delete from usertbl where useridx=:ids';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ids', $ids);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

echo '<script>';
echo 'alert("삭제되었습니다.")';
echo '</script>';
echo '<script>window.location.href = "manage.html"</script>';
