<?php
$_POST['page_limit'] = (isset($_POST['page_limit'])&&$_POST['page_limit'] != '' && is_numeric($_POST['page_limit']))?$_POST['page_limit']:5;
$_POST['limit'] = (isset($_POST['limit'])&&$_POST['limit'] != '' && is_numeric($_POST['limit']))?$_POST['limit']:3;


$rs = 'page_limit = '.$_POST['page_limit'].',limit = '.$_POST['limit'];

$file = "../boardset.txt";
$pf=fopen($file,'w');
fwrite($pf, $rs);
fclose($pf);

echo '<script>';
echo 'alert("수정되었습니다.")';
echo '</script>';
echo '<script>';
echo 'self.location.href="http://localhost/boardproject/"';
echo '</script>';