<?php  session_start();//初始化session

if (isset ($_SESSION['shili'])){
    header ("Location:shili.php") ;     //重新定向到其他页面
    exit;
}
?>
<script language="javascript">
function checklogin (){
    if ((login.username.value!="") && (login.password.value!=""))
        return true                    //判断用户名和密码不为空,返回TRUE
    else {
        alert("昵称或密码不能为空!")
    }
}
</script>
<style type="text/css">
.style1 {
	font-size: 13px;
	font-family: "黑体";
	font-weight: normal;
	color: #0099FF;
}
</style>
<div align="center">
  <table width="260" border="1" bgcolor="#D8EFFA">
    <form name="login" method="post" action="06.php" onSubmit="return checklogin()">
      <tr align="center">
        <td height="30" colspan="2"><span class="style1">管理系统登录</span></td>
      </tr>
      <tr>
        <td width="90" align="center" class="style1">管理员: </td>
        <td width="170" height="20" align="left" valign="middle"><input name="username" type="text" id="username" size="20"></td>
      </tr>
      <tr>
        <td align="center" class="style1">密码: </td>
        <td height="20" align="left" valign="middle"><input name="password" type="password" id="password" size="20"></td>
      </tr>
      <tr>
        <td align="center" class="style1">&nbsp ; </td>
        <td height="20" align="center"><input type="submit" name="Submit" value="登 录"></td>
      </tr>
    </form>
  </table>
</div>
