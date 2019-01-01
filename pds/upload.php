<?php
$upload_dir = "C:\Bitnami\wampstack-7.1.22-0\apache2\htdocs\pds\uploads\\";//파일 업로드 디렉토리

$file_name = $_FILES['userfile']['name'];
//파일 이름 중복 방지
$file_name = mktime(). "_". $file_name;

//파일 확장자 체크
//explode("구분자",문자열) 구분자를 기준으로 문자열을 나누에 배열로 저장
//strtolower() 문자열을 소문자로 변환
//count(배열) 배열의 사이즈
$ext = explode(".",strtolower($file_name));
$cnt = count($ext) -1;
//eregi("패턴", 문자열) 패턴에 맞으면 eio_truncate//@함수() 함수 실행 과정의 에러 무시
if(@eregi("php|inc|html|exe|sh|bat",$ext[$cnt])){
  echo "<script>
        alert('업로드 할 수 없는 형식의 파일입니다.')
        history.back(-1);
        </script>
  "
  exit();
}
//서버에 저장된 임시파일 이름
$file_tmp_name = $_FILES['userfile']['tmp_name'];
$file_size= $_FILES['userfile']['size'];
$mimetype = $_FILES['userfile']['type'];

$uploadfile = $upload_dir.basename($file_name);
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){
  echo "파일 이름: $file_name<br>
        파일 사이즈:$file_size<br>
        파일 타입: $mimetype<br>
        임시 파일이름: $file_tmp_name<br>
        성공적으로 업로드되었습니다.
        ";
}else{
  echo "파일 업로드 실패...";
}
?>
