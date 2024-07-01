<?php



include '../dbconfig.php';



$user_id = (isset($_POST['user_id']) && $_POST['user_id'] != '') ? $_POST['user_id'] : '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
$uname = $_POST['uname'];
$email = isset($_POST['email'])?$_POST['email']:'';

$pwd_hash = password_hash($password, PASSWORD_BCRYPT);

try {
$sql = "insert into usertbl(`username`, `userpassword`, uname, udate, email) value(:user_id,:pwd_hash, :uname, now(), :email)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':pwd_hash', $pwd_hash);
$stmt->bindParam(':uname', $uname);
$stmt->bindParam(':email', $email);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

echo '<script>';
    echo 'alert("계정이 생성되었습니다.")';
    echo '</script>';
    echo '<script>window.location.href = "http://localhost/boardproject"</script>';
} catch (Exception $e) {
    echo '<script>';
    echo 'alert("이미 존재하는 계정입니다..")';
    echo '</script>';
    echo '<script>window.location.href = "http://localhost/boardproject"</script>';}

