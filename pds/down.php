<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('dbconn.php');
$id=$_GET['id'];
//글 번호에 해당되는 첨부파일의 이름
$result = mysqli_query($conn," SELECT filename FROM board WHERE id=$id");
$row= mysqli_fetch_array($result);
$filename= $row['filename'];
if($filename){
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
}//다운로드 횟수 증가 처리
mysqli_query($conn,"UPDATE board SET down=down+1 WHERE id=$id");
mysqli_close($conn);
 ?>
