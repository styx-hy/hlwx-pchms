<?php
include_once('cache-kit.php');
$cache_active = true;
$cache_folder = 'cache/';

session_start();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="/base.css" type="text/css" />
	<title>Personal Center</title>
	<style type="text/css">
a:link, a:visited {
	text-decoration:none;
}
</style>
	<?php
if (count($_SESSION) == 0) {
$url = "/index.php";
echo "you have not loggin yet, will return to login page in 3s";
echo "<script type=\"text/javascript\">window.setTimeout(function() {location.href=\"/index.php\";}, 3000);</script>";
}
?>
	<script language="javascript" type="text/javascript" src="/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript">
		$(document).ready(function () {
		$("#menus tr").mouseover(function() {
		$(this).addClass("over");}).mouseout(function() {
		$(this).removeClass("over");});
		$("#menus tr:even").addClass("alt");

		});
	</script>
	</head>

	<body>
  <div class="wrapper" align="center">
    <div id="top-title" align="right">
      <table width="100">
          <td align="center" id="welcome"><div>
              <h3>Hello, <?php echo $_SESSION['username']; ?></h3>
            </div></td>
      </table>
    </div>
    <br />
    <div id="plot_area">
      <table id="plot">
        <tr>
          <td><div class="menu" align="center">
              <table id="menus">
                  <tr><td><a href="javascript:;" id="daily_count" onclick="daily()"> Daily Count </a></td></tr>
                  <tr><td><a href="javascript:;" id="mouse_count" onclick="mouse()"> Mouse Count </a></td></tr>
                  <tr><td><a href="javascript:;" id="keyboard_count" onclick="keyboard()"> Keyboard Count </a></td></tr>
            </table>
            </div></td>
          <td><div id="placeholder" style="width:800px;height:400px" align="center"></div></td>
        </tr>
      </table>
    </div>
    <div align="center"> <br />
      <br />
      <br />
    </div>
    <script language="javascript" type="text/javascript">
	$("#daily_count").click(function() {
			var options = {
					lines: { show: true },
					points: { show: true },
			};
			var dataurl = "getdata.php";
			var already_fetched = {};
			var data = [];
			function on_data_received(series) {
					data.push(series.data);
					$.plot($("#placeholder"), data, options);
			}
			$.ajax({
					url: dataurl,
					method: 'GET',
					dataType: 'json',
					success: on_data_received
			});
	});

$("#mouse_count").click(function() {
	var options = {
			xaxis: {
					mode: "time"
//            timeformat: "%y/%m/%d"
			},
			lines: { show: true },
			points: { show: true },
	};
	var dataurl = "getmouse.php";
	var already_fetched = {};
	var data = [];
	function on_data_received(series) {
			// if (!already_fetched[series.label]) {
			//     already_fetched[series.label] = true;
			//     data.push(series);
			data.push(series.data);
			$.plot($("#placeholder"), data, options);
			// }
	}

	$.ajax({
			url: dataurl,
			method: 'GET',
			dataType: 'json',
			success: on_data_received
	});

});
		</script> 
  </div>
</body>
</html>
