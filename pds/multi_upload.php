<?php //첨부파일들을 배열로 저장
//(숫자 인덱스와 파일 이름으로 구성)
//변수 as key변수 => value변수
foreach($_FILES['userfile']['name'] as $key => $val){
echo "$key : $val <br>";
//파일 사이즈가 0보다 크면
if($_FILES['userfile']['size'][$key] > 0){
  //http 방식으로 업로드된 파일인지 검사
  if(is_uploaded_file(
    $_FILES['userfile']['tmp_name'][$key])){
      $filename = $_FILES['userfile']['name'][$key];
      if (move_uploaded_file(
        $_FILES['userfile']['tmp_name'][$key],"C:\Bitnami\wampstack-7.1.22-0\apache2\htdocs\pds\uploads\\".$filename
      )){ echo "$val 파일이 업로드 되었습니다.<br>";}
    }
  }
}
?>
