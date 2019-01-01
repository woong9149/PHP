<?php
include('dbconn.php');
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$title = $_POST['title'];
$content = $_POST['content'];
//클라이언트의 ip주소
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

//파일 업로드 처리
$filename="";
$filesize=0;
//isset(변수) 변수에 값이 설정되어있으면 true
if(isset($_FILES['userfile'])){
  $upload_dir="C:\Bitnami\wampstack-7.1.22-0\apache2\htdocs\pds\uploads\\";
  $filename= $_FILES['userfile']['name'];
  //파일 이름 중복 방지 처리
  $filename = mktime(). "_".$filename;
  //파일 확장자 검사
  $ext= explode(".", strtolower($filename));
  $cnt= count($ext) -1;
  // if(@eregi("php|inc|html|exe|sh|bat", $ext[$cnt])){
  //   echo "
  //         <script>
  //         alert('업로드 할 수 없는 파일입니다.');
  //         history.back(-1);
  //         </script>
  //   ";
  //   exit();
  // }
  //파일사이즈
  $filesize = $_FILES['userfile']['size'];
  $uploadfile = $upload_dir.basename($filename);
  if($filesize > 0){
    //임시 디렉토리에 저장된 파일을 업로드 디렉토리로
    move_uploaded_file(
      $_FILES['userfile']['tmp_name'], $uploadfile);
  }
}

$query = "INSERT INTO board (name,email,pass,title,content,wdate,ip,filename,filesize) VALUES ('$name','$email','$pass','$title','$content',now(),'REMOTE_ADDR','$filename',$filesize)";
//sql을 실행하다가 에러가 발생하면 에러메세지 출력
//die()에러가 발생할 경우 실행됨.
//mysqli_error() mysql 관련 에러메세지 출력
$result = mysqli_query($conn,$query) or die(mysqli_error());
mysqli_close($conn);//mysql 접속 종료
?>
<meta http-equiv="refresh" content="0;url=list.php">

<!-- limit 용법 2가지
limit 레코드인덱스, 레코드갯수
limit 레코드갯수 -->
