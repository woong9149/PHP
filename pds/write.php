<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type ="text/css" href="board.css">
  </head>
  <body>
    <form action="insert.php" method="post" enctype="multipart/form-data">
      <table width="580" border="1">
        <tr>
          <td height="20" align="center"><b>글쓰기</b>
          </td>
        </tr>
        <tr>
          <td>&nbsp;
            <table>
              <tr>
                <td width="60">이름</td>
                <td><input type="text" name="name" size="20" maxlength="10"></td>
              </tr>
              <tr>
                <td>이메일</td>
                <td><input type="text" name="email" size="20" maxlength="25"></td>
              </tr>
              <tr>
                <td>비밀번호</td>
                <td><input type="password" name="pass" size="8" maxlength="8">(수정,삭제시 반드시 필요)</td>
              </tr>
              <tr>
                <td>제목</td>
                <td><input type="text" name="title" size="60" maxlength="35"></td>
              </tr>
              <tr>
                <td>내용</td>
                <td><textarea name="content" cols="65" rows="15"></textarea></td>
              </tr>
              <tr>
                <td>첨부파일</td>
                <td>
                  <input type="file" name="userfile">
                </td>
              </tr>
              <tr>
                <td colspan="10" align="center">
                <input type="submit" value="글 저장하기">&nbsp;&nbsp;&nbsp;&nbsp;  <input type="button" value="되돌아가기" onclick="history.back(-1)">
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
