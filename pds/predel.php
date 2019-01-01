<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="board.css">
  </head>
  <body>
    <form action="delete.php?id=<?=$_GET['id']?>" method="post">
      <table width="300" border="1">
        <tr>
          <td>비밀번호 확인</td>
        </tr>
        <tr>
          <td>
          <b>비밀번호 : </b>
          <input type="password" name="pass" size="8">
          <input type="submit" value="확인">
          <input type="button" value="취소" onclick="history.go(-1)">
           </td>
        </tr>
      </table>

    </form>
  </body>
</html>
