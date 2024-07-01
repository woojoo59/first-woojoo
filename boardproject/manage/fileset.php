<?php



$serialized_array = serialize($_POST); //문자화

$file = "../fileset.txt";
$pf=fopen($file,'w');
fwrite($pf, $serialized_array);
fclose($pf);

echo '<script>';
echo 'alert("수정되었습니다.")';
echo '</script>';
echo '<script>';
echo 'self.location.href="http://localhost/boardproject/manage/manage.html"';
echo '</script>';


//$array = unserialize($serialized_array); //배열화

