<?php
//$_REQUEST[] get/post공용(속도는 떨어질수 있으나 문제없음)
$filename = $_GET['filename'];//다운로드할 파일 이름
$path = "C:\Bitnami\wampstack-7.1.22-0\apache2\htdocs\pds\uploads\\$filename";
//파일이름에 한글, 특수문자 있을때 => urldecode
$real_filename=urldecode('filename');//url decode
header('Content-Type: application/x-octetstream');
header('Content-Dispositon: attachment; filename='.$real_filename);
header('Content=Length:'.filesize($path));
header('Content-Transfer-Encoding: binary');
header('Pragma: no-cache');
header('Expires:0');
flush();//출력 버퍼 비우기
$fp = fopen($path,"r");//파일을 읽기 모드로 오픈
fpassthru($fp);//파일 내용을 곧바로 출력
fclose($fp);//파일 닫기
?>
