<?php

include 'dbconfig.php';
$fp = fopen("boardset.txt", 'r');
$fz = filesize("boardset.txt");
$fr = fread($fp, $fz);


fclose($fp);

$result = [];

// 쉼표를 기준으로 문자열을 분리
$parts = explode(',', $fr);

foreach ($parts as $part) {
    // 각 부분을 등호를 기준으로 분리하여 키와 값을 추출
    list($key, $value) = explode('=', $part);
    
    // 공백 제거
    $key = trim($key);
    $value = trim($value);
    
    // 배열에 저장
    $result[$key] = $value;}
// }} catch(Exception $e){
//     $rs = 'page_limit = 5,limit = 3';

//         $file = "boardset.txt";
//         $pf=fopen($file,'w');
//         fwrite($pf, $rs);
//         fclose($pf);
// }




$select =  isset($_GET['select']) && $_GET['select'] != '' && is_numeric($_GET['select']) ? $_GET['select'] : 1;
$sdate = isset($_GET['sdate'])?$_GET['sdate']:'2024-06-20';
$ldate = isset($_GET['ldate'])?$_GET['ldate']:date('Y-m-d');
$search = isset($_GET['search'])?$_GET['search']:'';

$wh = (isset($_GET['search']) && $_GET['search'] != '') ? $_GET['search'] : '';

// echo $sdate;
// echo '<hr>';
// echo $ldate;
// exit;

$where = " where rdate >= '$sdate' && rdate <= '$ldate'";
$wl = '';
if($wh != ''){
    switch($select){
        case 1 :    $where = " where `subject` like '%".$wh."%' && rdate >= '$sdate' && rdate <='$ldate'"; break;
        case 2 :    $sql = "select useridx from usertbl where uname =:uname";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':uname', $wh);
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if(isset($row['useridx'])){$wl = $row['useridx'];} else {$wl = '0';}
                    
                    $where = " where `useridx` = ".$wl." && (rdate >= '$sdate' && rdate <= '$ldate')";
                    break;
    }
}



// 페이징
$rs_str = '';
try{
    $sql = "select count(*) as cnt from board".$where;
    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $row = $stmt->fetch();}
    catch (Exception $e){
        echo "<script>";
        echo "alert('잘못된 접근입니다.')";
        echo "</script>";
        echo "<script>";
        echo "self.location.href='http://localhost/boardproject/'";
        echo "</script>";
    }

    
    $total = $row['cnt'];   // 총 게시글
    $page_limit = (isset($result['page_limit'])&&$result['page_limit']!=''&&is_numeric($result['page_limit']))?$result['page_limit']:5;        // 페이지당 출력 게시글   
    $limit = (isset($result['limit'])&&$result['limit']!=''&&is_numeric($result['limit']))?$result['limit']:3;           // 1번에 출력할 페이지개수



    // is_int($_GET['page'])&&
    if(isset($_GET['page'])){$_GET['page']=intval($_GET['page']);}
    
    $_GET['page'] = (isset($_GET['page']) && $_GET['page'] !='' && is_int($_GET['page'])&&  $_GET['page']>0)?$_GET['page']:1;
    $page_total = ceil($total/$page_limit)==0?1:ceil($total/$page_limit); // 총 페이지 수
    $page_start = ((isset($_GET['page'])?$_GET['page']:1)-1)*$page_limit; //게시글 출력시작점
    $now_page = isset($_GET['page'])?$_GET['page']:1;
    $block_total = ceil($page_total/$limit); //총 블록 개수



    if($_GET['page']>$page_total){
        echo "<script>";
        echo "alert('잘못된 접근입니다.')";
        echo "</script>";
        echo "<script>";
        echo "self.location.href='http://localhost/boardproject/'";
        echo "</script>";
    }


    $start_block = 1+$limit*(ceil($now_page/$limit)-1);   
    $end_block = $limit+$limit*(ceil($now_page/$limit)-1);     
    if($end_block>$page_total){
        $end_block = $page_total;
    }
    if($now_page != 1){$rs_str .= '<a href="http://localhost/boardproject/"><button>first</button></a>';}
    
    if($now_page >1){
        $rs_str .= '<a href="index.html?page='.($now_page-1).'"><button><</button></a>';
    }

    for($i=$start_block; $i<=$end_block; $i++){
        if($now_page == $i){$rs_str .='<button style="background-color: aquamarine;><a href="index.html?page='.$i.'">'.$i.'</a></button>';}
        else {
        $rs_str .='<a href="index.html?page='.$i.'">'.'<button>'.$i.'</button>'.'</a>';}
    }
    if($now_page < $page_total){
        $rs_str .= '<a href="index.html?page='.($now_page+1).'"><button>></button></a>';
    }
    if($now_page != $page_total){$rs_str .= '<a href="index.html?page='.$page_total.'"><button>last</button></a>';}
//=========================================================================================


    if(isset($_GET['select'])){
        $rs_str = '';
    if($page_total>1)   {if($now_page != 1) {$rs_str .= '<a href="index.html?page=1&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'""><button>first</button></a>';}
    if($now_page >1){
        $rs_str .= '<a href="index.html?page='.($now_page-1).'&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'"><button><</button></a>';
    }

    for($i=$start_block; $i<=$end_block; $i++){
        if($now_page == $i){$rs_str .='<button style="background-color: aquamarine;"><a href="index.html?page='.$i.'&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'">'.$i.'</a></button>';}
        else {
        $rs_str .='<a href="index.html?page='.$i.'&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'"><button>'.$i.'</button></a>';}
    }
    if($now_page < $page_total){
        $rs_str .= '<a href="index.html?page='.($now_page+1).'&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'"><button>></button></a>';
    }
    if($now_page != $page_total){$rs_str .= '<a href="index.html?page='.$page_total.'&sdate='.$sdate.'&ldate='.$ldate.'&select='.$select.'&search='.$search.'"><button>last</button></a>';}}
    }



    //=================================================================================


$sql = "select idx, subject, useridx ,rdate, hit from board".$where." order by idx desc limit ".$page_start.",".$page_limit;
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetchAll();


if($page_total == 1){
    $rs_str = '';
}

?>