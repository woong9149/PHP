<!DOCTYPE html>
<?php include('dbconn.php');
$id = $_GET['id'];
$result = mysqli_query($conn,"SELECT * FROM board WHERE id=$id");
$row = mysqli_fetch_array($result);
?>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type ="text/css" href="board.css">
  </head>
  <body>
    <form action="update.php?id=<?=$id?>" method="post">
      <table width="580" border="1">
        <tr>
          <td height="20" align="center"><b>글수정</b>
          </td>
        </tr>
        <tr>
          <td>&nbsp;
            <table>
              <tr>
                <td width="60">이름</td>
                <td><input type="text" name="name" size="20" maxlength="10" value="<?=$row['name']?>"></td>
              </tr>
              <tr>
                <td>이메일</td>
                <td><input type="text" name="email" size="20" maxlength="25" value="<?=$row['email']?>"></td>
              </tr>
              <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pass" size="8" maxlength="8">(비밀번호가 맞아야 수정 가능 )</td>
              </tr>
              <tr>
                <td>제목</td>
                <td><input type="text" name="title" size="60" maxlength="35" value="<?=$row['title']?>"></td>
              </tr>
              <tr>
                <td>내용</td>
                <td><textarea name="content" cols="65" rows="15"><?=$row['content']?></textarea></td>
              </tr>
              <tr>
                <td colspan="10" align="center">
                <input type="submit" value="글 저장하기">&nbsp;&nbsp;
                <input type="reset" value="다시 쓰기">&nbsp;&nbsp;
                <input type="button" value="되돌아가기" onclick="history.back(-1)">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
