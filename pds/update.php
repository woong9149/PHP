<?php
include('dbconn.php');
$id = $_GET['id'];//글번호
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$title = $_POST['title'];
$content = $_POST['content'];

//비밀번호 조회
$query = "SELECT pass FROM board WHERE id=$id";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
if($pass==$row['pass']){//비밀번호가 일치하면
  $query = "UPDATE board SET name='$name', email='$email',title='$title',content='$content' WHERE id=$id ";
  //sql을 실행하다가 에러가 발생하면 에러메세지 출력
  //die()에러가 발생할 경우 실행됨.
  //mysqli_error() mysql 관련 에러메세지 출력
  $result = mysqli_query($conn,$query) or die(mysqli_error());
}else{//비밀번호가 일치하지 않으면
  echo "<script>
        alert('비밀번호가 일치하지 않습니다');
        history.back(-1);
        </script>
         ";
}
//클라이언트의 ip주소
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

mysqli_close($conn);//mysql 접속 종료
?>
<meta http-equiv="refresh" content="0;url=read.php?id=<?=$id?>">

<!-- limit 용법 2가지
limit 레코드인덱스, 레코드갯수
limit 레코드갯수 -->
