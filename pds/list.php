<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('dbconn.php');
$page_size=10; //페이지당 게시물수
$page_list_size=10;//한 화면에 표시할 페이지의 갯수
$no="";//레코드 시작 번호
//isset(변수) 변수의 값이 설정되어 있으면
if(isset($_GET["no"])){
  $no = $_GET["no"];
}
//no 변수의 값이 없거나 음수이면
if(!$no || $no < 0) $no = 0; //레코드 시작 번호를 0으로
//limit 시작 인덱스,레코드 갯수
$query = "SELECT * FROM board ORDER BY id DESC LIMIT $no,$page_size";

$result = mysqli_query($conn,$query);
$result_count= mysqli_query($conn,"SELECT COUNT(*)FROM board");
$result_row = mysqli_fetch_array($result_count);
$total_row = $result_row[0];
if($total_row <= 0) $total_row=0;
//전체 페이지 갯수 계산
//ceil(레코드갯수/페이지사이즈)
//1/10=>0.1, ceil(0.1)=>1 (올림)
$total_page = ceil($total_row/$page_size);
//현재 페이지 계산
//0=>1페이지
//10=>2페이지
$current_page=ceil(($no+1)/$page_size);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="board.css">
  </head>
  <body>
    <br>
    <h2>게시판</h2>
    <br>
    <br>
    <table width="680" border="1">
      <tr height="20" align="center">
        <td width="30">번호</td>
        <td width="370">제 목</td>
        <td width="50">글쓴이</td>
        <td width="60">날 짜</td>
        <td width="40">조회수</td>
        <td width="50">첨부파일</td>
        <td width="50">다운로드</td>
      </tr>
      <?php
      while($row = mysqli_fetch_array($result)){
         ?>
         <tr>
           <td height="20" align="center"><?= $row['id']; ?></td>
           <td height="20">&nbsp;<a href="read.php?id=<?= $row['id']?>&no=<?php $no?>"><?= strip_tags($row['title'],'<b><i>');?></a>
             <!-- strip_tags(문자열,"제외할태그")
             문자열에서 태그를 제거 -->
           </td>
           <td align="center" height="20"><a href="mailto:<?=$row['email']?>"><?=$row['name']?></a>
           </td>
           <td align="center" height="20"><?=$row['wdate']?></td>
           <td align="center" height="20"><?=$row['view']?></td>
           <td align ="center">

             <?php
            if( $row['filesize']>0 ){
              echo "<a href='down.php?id= $row[id]'>
              <img src='/images/folder-303891_640.png'></a>";
            }
            ?>

           </td>
           <td align="center">
             <?= $row["down"] ?>
           </td>
         </tr>

         <?php
       } //end of while
       mysqli_close($conn);//mysql 접속 해제
       ?>
    </table>
    <!-- 페이지 네비게이션 -->
    <table border="0">
      <tr>
        <td width="600" height="20" align="center" rowspan="4">
          &nbsp;
          <?php
          //ceil() 올림, round()반올림, floor() 버림
           $start_page = floor(($current_page -1)/$page_list_size)*$page_list_size+1;
           //페이지 리스트의 마지막 페이지가 몇 번째 페이지인지 계산
           $end_page = $start_page + $page_list_size -1;
           if($total_page < $end_page)
           $end_page = $total_page;
           if($start_page >= $page_list_size){
             echo "start_page: $start_page<br>";
            //이전 페이지 블록으로 이동
            //($page_size를 곱하여 글번호 계산)
             $prev_list = ($start_page -2)*$page_size;
             //$_SERVER[PHHP_SELF] 현재 페이지의 주소
             echo "<a href=\"$_SERVER[PHP_SELF]?no=$prev_list\">@</a>\n";
           }
           //페이지 리스트 출력
           for($i = $start_page; $i <= $end_page; $i++){
             //페이지값을 no 값으로 변환
             $page = ($i-1)*$page_size;
             if($no != $page){//현재 페이지가 아닐경우만 링크
               echo "<a href=\"$_SERVER[PHP_SELF]?no=$page\">";
             }
             echo"$i";//페이지를 표시
             if($no != $page){
               echo "</a>";
             }
           }
           //다음 페이지 리스트 출력
           if($total_page>$end_page){
             $next_list = $end_page*$page_size;
             echo "<a href=$_SERVER[PHP_SELF]?no=$next_list>#</a>";
           }
           ?>
        </td>
      </tr>

    </table>
    <a href="write.php">글쓰기</a>
  </body>
</html>
