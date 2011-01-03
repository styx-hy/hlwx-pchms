<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<script language="javascript" type="text/javascript" src="../jquery.js"></script>
<script language="javascript" type="text/javascript" src="../jquery.flot.js"></script>
</head>
<body>
  <div id="placeholder" style="width:600px;height:300px;"></div>

  <script id="source" language="javascript" type="text/javascript">
	$(function () {
		var points = [[1,1], [2,2], [3,3], [4,4], [5,5]];
		$.plot($("#placeholder"), [ { data: points, label: "test points ($)" } ], {
			
		});
	});
	</script>
	<?php
  // phpinfo();
  $insert = "something";
  print "hello{$insert}world"."<br>";
  print $_POST['username']."<br>";
	$result = $_POST;
	foreach ($result as $elem) {
		print $elem."<br>";
	}
	print sizeof($_POST);
  ?>
</body>
</html>