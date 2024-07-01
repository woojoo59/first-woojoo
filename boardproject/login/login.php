<?php

include '../dbconfig.php';

$user_id = (isset($_POST['user_id']) && $_POST['user_id'] != '') ? $_POST['user_id'] : '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';


$sql = "select * from usertbl where username=:user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
$rspwd = (isset($row['userpassword']) && $row['userpassword'] != '') ? $row['userpassword'] : '';




if($row['userpassword']==''){
    echo '<script>';
    echo 'alert("존재하지 않는 계정입니다.")';
    echo '</script>';
    echo '<script>window.location.href = "http://localhost/boardproject/"</script>';
}




if(password_verify($password, $rspwd)){
    session_start();
    $_SESSION['useridx'] = $row['useridx'];
    $_SESSION['username'] = $row['username'];
    echo '<script>';
    echo 'alert("로그인 되었습니다.")';
    echo '</script>';
    echo '<script>';
    echo 'history.go(-1)';
    echo '</script>';

} else {
    echo '<script>';
    echo 'alert("비밀번호가 틀렸습니다.")';
    echo '</script>';
    echo '<script>window.location.href = "http://localhost/boardproject/"</script>';
   
}
