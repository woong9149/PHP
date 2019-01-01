<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="board.css">
  </head>
  <body>
    <?php
     include('dbconn.php');
     $id = $_GET['id'];//게시물 번호
     if(isset($_GET['no'])){//레코드 인덱스
       $no = $_GET['no'];
     }
     //조회수 증가 처리
     mysqli_query($conn,"UPDATE board SET view=view+1 WHERE id=$id");
     $result = mysqli_query($conn,
       "SELECT * FROM board WHERE id = $id");//sql 실행
       $row = mysqli_fetch_array($result);
     ?>
     <!-- <?php echo $row['title']; ?>
     <?php $row['title']; ?> -->
     <table width="580" border="1">
       <tr>
         <td colspan="4" align="center">
           <b><?php echo $row['title'] ?></b><!-- php출력문 -->
         </td>
       </tr>
       <tr>
         <td align="center">글쓴이</td>
         <td><?php echo $row['name'] ?></td>
         <td align="center">이메일</td>
         <td><?php echo $row['email'] ?></td>
       </tr>
       <tr>
         <td align="center">날짜</td>
         <td><?php echo $row['wdate'] ?></td>
         <td align="center">조회수</td>
         <td><?php echo $row['view'] ?></td>
       </tr>
       <?php
        if($row['filesize'] > 0){
       ?>
       <tr>
         <td>첨부파일</td>
         <td>
           <!-- number_format(숫자) 천단위 컴마 -->
           <?=$row['filename']?>(<?=number_format($row['filesize'])?>)
           <a href="down.php?id=<?=$id?>"><img src='/images/folder-303891_640.png'></a>
         </td>
         <td>다운로드</td>
         <td><?=$row['down']?></td>
       </tr>
     <?php } ?>
       <tr>
         <td colspan="4">
           <!-- pre태그는 해석하지않고 그대로 출력 -->
           <pre><?php echo $row['content'] ?></pre>
         </td>
       </tr>
       <tr>
         <td colspan="4">
           <table width="100%">
             <tr>
               <td>
                 <a href="list.php">[목록보기]</a>
                 <a href="write.php">[글쓰기]</a>
                 <a href="edit.php?id=<?=$id?>">[수정]</a>
                 <a href="predel.php?id=<?=$id?>">[삭제]</a>

               </td>
               <!-- 이전글, 다음글 표시 -->
               <td align="right">
                 <?php
                 $query= mysqli_query($conn, "SELECT id FROM board WHERE id < $id LIMIT 1");//sql실행
                 $prev_id = mysqli_fetch_array($query);//1개의 레코드 선택
                 if($prev_id['id']){//레코드가 존재하면
                   echo "<a href='read.php?id=$prev_id[id]'>[이전]</a>";
                 }else{
                   echo "[이전]";
                 }
                 // 다음글
                 $query= mysqli_query($conn,"SELECT id FROM board WHERE id > $id ORDER BY id DESC LIMIT 1");
                 $next_id = mysqli_fetch_array($query);
                 if($next_id['id']){
                   echo "<a href='read.php?id=$next_id[id]'>[다음]</a>";
                 }else{
                   echo "[다음]";
                 }
                  ?>
               </td>
             </tr>
            </table>
         </td>
       </tr>
     </table>
  </body>
</html>
