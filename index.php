<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <script src="login copy.js"></script>
</head>
<body>
    <?php 
    if(!isset($_SESSION['ss_id']) or $_SESSION['ss_id'] == ''){
        echo '<header>
            <form method="post" action="login.php" name="login_form" autocomplete="off">
                <input type="text" name="userName" id="identify" placeholder="ID">
                <input type="password" name="userpassword" id="password" placeholder="Password">
                <button id="login_btn">Login</button>
            </form>
        </header>';}
        else {
            echo '<header>
            <p>'.$_SESSION['ss_id'].'님 어서오세요</p>
            <button id="logout_btn">Logout</button>
            </header>';
        }
        
    ?>
    <hr>
    <main>

    </main>
</body>
</html>