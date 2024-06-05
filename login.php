<?php
include 'db.php';

$id = (isset($_POST['userName']) and $_POST['userName'] != '')? $_POST['userName']: '';
$pw = (isset($_POST['userpassword']) and $_POST['userpassword'] != '')? $_POST['userpassword']: '';



if($id == ''){
    echo "
    <script>
        alert('아이디를 입력바랍니다.')
        history.go(-1)
    </script>
    ";
    exit;
}
if($pw == ''){
    echo "
    <script>
        alert('비밀번호를 입력바랍니다.')
        history.go(-1)
    </script>
    ";
    exit;
}

$sql = "select userPassword from usertbl where userName =:userName";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userName', $id);
try{
    $stmt->execute();
} catch (Exception $e){
    echo "
    <script>
        alert('존재하지 않는 아이디입니다.')
        history.go(-1)
    </script>
    ";
};

$rs = $stmt->fetch();
if($pw ==$rs['userPassword']) {
    session_start();

    $_SESSION['ss_id'] = $id;
    
    echo "<script>
        alert('로그인 성공했습니다.');
        self.location.href='./';
    </script>";
} else {
    echo "
    <script>
        alert('비밀번호가 틀렸습니다.')
        history.go(-1)
    </script>
    ";
}