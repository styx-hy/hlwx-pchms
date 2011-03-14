<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/base.css" type="text/css" />
    <link rel="stylesheet" href="/reg.css" type="text/css" />
    <title>PCHMS-HLWX注册</title>
    <script language="javascript" type="text/javascript" src="/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="/jquery.flot.js"></script>
    <script language="javascript" type="text/javascript" src="/effects.js"></script>
    <script language="javascript" type="text/javascript">
      $(document).ready(function () {
      $("#menus ul li").mouseover(function() {
      $(this).addClass("over");}).mouseout(function() {
      $(this).removeClass("over");});
      $("#menus ul li:even").addClass("alt");

      });
    </script>
  </head>

  <body>
    <div id="wrapper" align="center">
      <div id="top_title" align="right">
        <div style="float:left;margin-left:220px;font-size:13px;" align="left">
          <span>这里是PCHMS-hlwx edition在线版</span>
          <br />
          <br />
          <span>基于Javascript的数据系统，若Internet Explorer无法显示</span>
          <br />
          <br />
          <span>请使用FF、Chrome、Opera、Safari等开源浏览器</span>
        </div>
        <div class="user_settings">
       </div>
      </div>
      <br />
      <div id="regholder">
        <div id="formitems">
          <div id="reg_title" align="left">注册PCHMS-HLWX</div>
          <div id="formholder" aligh="left">
            <form name="reg" id="reg_info" method="post" action="action.php?action=register">
              <p>
                  <label class="reg_input" for="user_name"><span title="Required" class="xf">*</span> Email</label>
                  <input type="text" tabindex="1" name="user_name" id="email"></input>
                  <p class="hint" align="left">登录及用于找回密码</p>
              </p>
              <p>
                  <label class="reg_input" for="user_name"><span title="Required" class="xf">*</span> 用户名</label>
                  <input type="text" tabindex="2" name="user_name" id="user_name"></input>
                  <p class="hint" align="left">常用网名，可使用真实姓名</p>
              </p>
              <p>
                  <label class="reg_input" for="pwd"><span title="Required" class="xf">*</span> 密码</label>
                  <input type="text" tabindex="3" name="pwd" id="pwd"></input>
                  <p class="hint" align="left">最少4个字符</p>
              </p>
              <p>
                  <label class="reg_input" for="pwd_rep"><span title="Required" class="xf">*</span> 确认密码</label>
                  <input type="text" tabindex="4" name="pwd_rep" id="pwd_rep"></input>
              </p>
              <div style="height: 35px;line-height: 35px;">
                <input type="submit" tabindex="5" value="注册" id="submit_button"></input>
              </div>
            </form>
          </div>
          <div id="registered" align="center">
            已经注册过了？<a href="index.php">登录</a>
          </div>
        </div>
      </div>
      <div align="center"> <br />
        <br />
        <br />
        <br />
        <div class="info">
          <ul class="proj">
            <li>SE09@SJTU Intel-SJTU Project 2011-2</li>
            |
            <li>Member: 洪扬，柳古月，王立擘，许欣昊</li>
	  </ul>
	</div>
      </div>
      <script language="javascript" type="text/javascript">
      </script> 
    </div>
  </body>
</html>
