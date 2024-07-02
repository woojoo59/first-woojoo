<?php
session_start();
if(!isset($_SESSION['username'])){
    echo '<script>';
        echo 'alert("잘못된 접근입니다.")';
        echo '</script>';
        echo '<script>window.location.href = "http://localhost/boardproject/"</script>';
}
include '../dbconfig.php';





$password = $_POST['password'];
$useridx = $_POST['useridx'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$email .='@'.$_POST['emailback'];


$sql = "select uname from usertbl where useridx = :useridx";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':useridx',$useridx);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();



$dbuname = $row['uname'];


if($dbuname == $uname){
    if($password == ''){
    

        $sql = "UPDATE usertbl SET email = :email where useridx = :useridx";
        
        $stmt = $conn->prepare($sql);
        

        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':useridx',$useridx);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        } else {
            $pwd = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "UPDATE usertbl SET `userpassword` = :pwd, email = :email where useridx = :useridx";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':useridx',$useridx);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        }
} else {
    if($password == ''){
    

        $sql = "UPDATE usertbl SET uname = :uname, email = :email where useridx = :useridx";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':useridx',$useridx);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        } else {
            $pwd = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "UPDATE usertbl SET `userpassword` = :pwd, uname = :uname, email = :email where useridx = :useridx";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':useridx',$useridx);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        }
}





if($_SESSION['useridx'] == 1 && $_SESSION['username']=='master'){
    echo '<script>';
echo 'alert("수정되었습니다.")';
echo '</script>';
echo '<script>';
echo 'self.location.href="manage.html"';
echo '</script>';
}




echo '<script>';
echo 'alert("수정되었습니다.")';
echo '</script>';
echo '<script>';
echo 'self.location.href="../login/logout_index.php"';
echo '</script>';
