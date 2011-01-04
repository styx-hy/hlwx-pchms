<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="/jquery.js"></script>
<script language="javascript" type="text/javascript" src="/jquery.flot.js"></script>
</head>

<body>
<script language="javascript" id="getdata" type="text/javascript">
function get_data() {
	$("#list").html("");
	$.getJSON("returndata.json", {name: "test", age: 20}, function callback(json) {
		$.each(json, function(i) {
			$("#list").append("<li>name:"+json[i].name+"&nbsp; Age:"+json[i].age+"</li>")
		})
	})};
</script>
<form method="post">
<input id="Button1" type="submit" value="getdata" onclick="getData()" />
</form>
<ul id="list"></ul>
</body>
</html>