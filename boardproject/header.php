<?php
        include 'dbconfig.php';
        if(isset($_SESSION['useridx'])){

        $user = $_SESSION['useridx'];

        $sql = "select uname from usertbl where useridx =:useridx";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':useridx', $user);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $uname = $stmt->fetch();


        $uname = $uname['uname'];}



            if( !isset($_SESSION['username'])){echo '<div style="justify-content: space-between; display: flex; align-items: center;"><div><a href="http://localhost/boardproject/"><img style="max-height: 30px;" src="http://localhost/boardproject/uploads\home.png"></a></div>
                <div><form method="post" id="login_form0" autocomplete="off">
                    <input type="text" id="user_id0" name="user_id" placeholder="아이디" pattern="[A-Za-z0-9]+" title="영어와 숫자만 입력가능합니다.">
                    <input type="password" id="password0" name="password" placeholder="비밀번호">
                    <button type="submit" name="login" id="login0">Login</button>
                    <button type="button" name="signin" id="signin0" onclick=location.href="http://localhost/boardproject/login/signin.html">signin</button>
                </form></div></div>';}
                else {
                    echo '<div style="justify-content: space-between; display: flex; align-items: center;"><div><a href="http://localhost/boardproject/"><img src="http://localhost/boardproject/uploads\home.png" style="max-height: 30px;"></a></div><div class="status_login" style="display: flex;">';
                    echo '<a class="pdr-1">'.$uname.'님!</a>';
                    echo '<form action="http://localhost/boardproject/login/logout_index.php">
                        <button id="logout0" style="margin-right: 0.5vw;">로그아웃</button>';
                        echo '</form>';
                    echo '<a href="http://localhost/boardproject/manage/usermanage.html"><button id="header_btn">회원정보</button></a>';
    
                    echo '</div></div>';}
                    
                
                echo '<hr>';
                
?>