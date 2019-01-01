<?php
include('dbconn.php');
$id = $_GET['id'];//게시물번호
$pass = $_POST['pass'];//사용자가 입력한 비밀번호
//비밀번호 확인
$result = mysqli_query($conn,"SELECT pass FROM board WHERE id=$id");
$row = mysqli_fetch_array($result);
//사용자가 입력한 비밀번호와 테이블에 저장된 비밀번호 비교

if($pass == $row['pass']){//맞으면
  $query = "DELETE FROM board WHERE id=$id";
  mysqli_query($conn,$query);
  mysqli_close($conn);//mysql 접속 해제
}else{//틀리면
  mysqli_close($conn);//mysql 접속 해제
    echo "<script>
         alert('비밀번호가 일치하지 않습니다.');
        history.back(-1);
        </script>";
        exit;
}

?>
<!-- 0초 후 list.php 페이지로 이동 -->
<meta http-equiv="refresh" content="0;url=list.php">
