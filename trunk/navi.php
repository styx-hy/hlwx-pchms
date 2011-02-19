<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/base.css" type="text/css" />
    <title>Personal Center</title>
    <?php
    if (count($_SESSION) == 0) {
        $url = "/index.php";
        echo "you have not loggin yet, will return to login page in 3s";
        echo "<script type=\"text/javascript\">window.setTimeout(function() {location.href=\"/index.php\";}, 3000);</script>";
    }
    ?>
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
          <ul style="display:block;">
            <li>Hello, <?php echo $_SESSION['username']; ?></li>
            <li><a href="action.php?action=help">帮助</a></li> |
            <li><a href="action.php?action=settings">设置</a></li> |
            <li><a href="action.php?action=logout">退出</a></li>
          </ul>
        </div>
      </div>
	    <br />
	    <div id="plot">
	  <div id="menus">
	    <ul>
              <li><a href="javascript:void(0);" id="daily_count"> Daily Count </a></li>
              <li><a href="javascript:void(0);" id="mouse_count"> Mouse Count </a></li>
              <li><a href="javascript:void(0);" id="keyboard_count"> Keyboard Count </a></li>
              <li><a href="javascript:void(0);" id="scatter"> Click Scatterring </a></li>
              <li><a href="javascript:void(0);" id="heatmap"> Heat Map </a></li>
              <li><a href="javascript:void(0);" id="enable_tooltip"> Enable Tooltip </a></li>
	    </ul>
	  </div>
	  <div id="holder">
	    <div id="chart_title" align="center">图表将在以下区域画出</div>
	    <div id="placeholder" align="center"></div>
      <canvas id="myCanvas"></canvas>
	    <div id="hover_option" align="center">
              <p id="hoverdata">Mouse hovers at (<span id="x">0</span>, <span id="y">0</span>). <span id="clickdata"></span></p>
              <p>
		<input id="enableTooltip" type="checkbox">
		  Enable Tooltip</p>
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
    $("#daily_count").click(function() {
	document.getElementById("placeholder").style.display = "block";
	document.getElementById("myCanvas").style.display = "none";
	$("#chart_title").html("Daily Count");
	var stack = 0, bars = true, lines = false, steps = false;
	var options = {
	    xaxis: {
		mode: "time",
		timeFormat: "%m%d",
		min: (new Date()).getTime() - 86400000 * 22,
		max: (new Date()).getTime() - 86400000 * 11
	    },
	    series: {
		stack: stack,
		lines: { show: lines, steps: steps },
		bars: { show: bars, barWidth: 10 }
	    },
	    legend: { show: true, position: 'ne' },
	    grid: {
		hoverable: true
	    }
	};
	var dataurl = "getdaily.php";
	var already_fetched = {};
	var data_mouse = [];
	var data_key = [];
	function on_data_received(series) {
	    data = series.data;
	    $.plot($("#placeholder"), [ { data:data[0], label: "Mouse Data" },
					{ data:data[1], label: "Keyboard Data" } ], options);
	}
	$.ajax({
	    url: dataurl,
	    method: 'GET',
	    dataType: 'json',
	    success: on_data_received
	});
    });

$("#mouse_count").click(function() {
    document.getElementById("placeholder").style.display = "block";
    document.getElementById("myCanvas").style.display = "none";
    $("#chart_title").html("Mouse Count Per 10 minutes");
    var options = {
	xaxis: {
	    color: ["#ffffff"],
	    mode: "time",
	    min: (new Date()).getTime() - 86400000 * 21,
	    max: (new Date()).getTime() - 86400000 * 20
	},
	lines: { show: true },
	points: { show: true },
	legend: { show: true, position: 'ne' },
	grid: {
	    hoverable: true,
	    // color: "#000",
	    // tickColor: "#ffffff"
	}
    };
    var dataurl = "getmouse.php";
    var already_fetched = {};
    var data = [];
    function on_data_received(series) {
	data.push(series.data);
	$.plot($("#placeholder"), [ { data:data[0], label: "Mouse Click" } ], options);
    }
    $.ajax({
	url: dataurl,
	method: 'GET',
	dataType: 'json',
	success: on_data_received
    });
});

$("#keyboard_count").click(function() {
    document.getElementById("placeholder").style.display = "block";
    document.getElementById("myCanvas").style.display = "none";
    $("#chart_title").html("Keyboard Count");
    var options = {
	xaxis: {
	    color: ["#000"],
	    mode: "time",
	    min: (new Date()).getTime() - 86400000 * 20,
	    max: (new Date()).getTime() - 86400000 * 17
	},
	lines: { show: true },
	points: { show: true },
	legend: { show: true, position: 'ne' },
	grid: {
	    hoverable: true,
	    color: "#000",
	    tickColor: "#ffffff"
	}
    };
    var dataurl = "getkeyboard.php";
    var already_fetched = {};
    var data = [];
    function on_data_received(series) {
	data.push(series.data);
	$.plot($("#placeholder"), [ { data:data[0], label: "Keyboard Press" } ], options);
    }
    $.ajax({
	url: dataurl,
	method: 'GET',
	dataType: 'json',
	success: on_data_received
    });
});


$("#scatter").click(function() {
    document.getElementById("placeholder").style.display = "block";
    document.getElementById("myCanvas").style.display = "none";
    $("#chart_title").html("Mouse Click on the Screen");
    var options = {
	xaxis: {
	    color: ["#000"],
	    // mode: "time",
	    // min: (new Date()).getTime() - 86400000 * 18,
	    // max: (new Date()).getTime() - 86400000 * 17
	},
	// lines: { show: true },
	points: { show: true },
	legend: { show: true, position: 'ne' },
	grid: {
	    hoverable: true,
	}
    };
    var dataurl = "getclickscatter.php";
    var already_fetched = {};
    var data = [];
    function on_data_received(series) {
	data.push(series.data);
	$.plot($("#placeholder"), [ { data:data[0], label: "Click" } ], options);
    }
    $.ajax({
	url: dataurl,
	method: 'GET',
	dataType: 'json',
	success: on_data_received
    });
});

$("#enable_tooltip").click(function() {
    if ($("#enableTooltip:checked").length > 0) {
	$("#enableTooltip").attr("checked", false);
    } else {
	$("#enableTooltip").attr("checked", true);
    }
});


/**
 * decide whether to show tooltip
 */

$(function() {
    function showTooltip(x, y, contents) {
	$('<div id="tooltip">' + contents + '</div>').css( {
	    position: 'absolute',
	    display: 'none',
	    top: y + 5,
	    left: x + 5,
	    border: '1px solid #fdd',
	    padding: '2px',
	    'background-color': '#fee',
	    opacity: 0.80
	}).appendTo("body").fadeIn(200);
    }
    
    var previousPoint = null;
    $("#placeholder").bind("plothover", function (event, pos, item) {
	$("#x").text(pos.x.toFixed(2));
	$("#y").text(pos.y.toFixed(2));
	
	if ($("#enableTooltip:checked").length > 0) {
	    if (item) {
		if (previousPoint != item.datapoint) {
		    previousPoint = item.datapoint;
		    
		    $("#tooltip").remove();
		    var x = item.datapoint[0].toFixed(2),
		    y = item.datapoint[1].toFixed(2);
		    
		    showTooltip(item.pageX, item.pageY,
				item.series.label + " of " + x + " = " + y);
		}
	    }
	    else {
		$("#tooltip").remove();
		previousPoint = null;            
	    }
	}
    });
    
    $("#placeholder").bind("plotclick", function (event, pos, item) {
	if (item) {
	    $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
	    plot.highlight(item.series, item.datapoint);
	}
    });
});

$("#heatmap").click(function() {
    document.getElementById("placeholder").style.display = 'none';
    document.getElementById("myCanvas").style.display = 'block';
    var dataurl = "getheat.php";
    $.ajax({
	url: dataurl,
	method: 'GET',
	dataType: 'json',
	success: draw_heat_map
    });
    function draw_heat_map(series) {
	var points = [];
	points.push(series.data);
	var canvas = document.getElementById("myCanvas");
	var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.globalAlpha = 0.8;
        context.globalCompositeOperation = "lighter";
	// context.translate(0, canvas.height);
	// context.scale(1, -1);
	if (context) {
	    //context.fillRect(0, 0, 150, 100);
	}
	var cache = {};
	//计算每个点的密度
	for (var i = 0, len = points.length; i < len; i++) {
	    for (var j = 0, len2 = points[i].length; j < len2; j++) {
		var key = points[i][j][0] + '*' + points[i][j][1];
		if (cache[key]) {
		    cache[key] ++;
		} else {
		    cache[key] = 1;
		}
	    }
	}
	//点数据还原
        var xmax = series.xmax;
        var ymax = series.ymax;
	var oData = [];
	for (var m in cache) {
	    if (m == '0*0') continue;
	    var x = parseInt(m.split('*')[0], 10)/xmax*canvas.width;
	    var y = parseInt(m.split('*')[1], 0)/ymax*canvas.height;
	    oData.push([x, y, cache[m]]);
	}
	//简单排序，使用数组内建的sort
	oData.sort(function(a, b){
	    return a[2] - b[2];
	});
	var max = oData[oData.length - 1][2];
	var pi2 = Math.PI * 2;
	//设置阈值，可以过滤掉密度极小的点
	var threshold = this._points_min_threshold * max;
	//alpha增强参数
	var pr = (Math.log(245)-1)/245;
	for (var i = 0, len = oData.length; i < len; i++) {
	    if (oData[i][2] > 0 ? 0 : 1);
	    //q参数用于平衡梯度差，使之符合人的感知曲线log2N，如需要精确梯度，去掉log计算
	    var q = parseInt(Math.log(oData[i][2]) / Math.log(max) * 255);
	    var r = parseInt(128 * Math.sin((1 / 256 * q - 0.5 ) * Math.PI ) + 200);
	    var g = parseInt(128 * Math.sin((1 / 128 * q - 0.5 ) * Math.PI ) + 127);
	    var b = parseInt(256 * Math.sin((1 / 256 * q + 0.5 ) * Math.PI ));
	    var alp = (0.92 * q + 20) / 255;
	    //如果需要灰度增强，则取消此行注释
	    //var alp = (Math.exp(pr * q + 1) + 10) / 255
	    var radgrad = context.createRadialGradient(oData[i][0], oData[i][1], 1, oData[i][0], oData[i][1], 8);
	    radgrad.addColorStop( 0, 'rgba(' + r + ',' + g + ','+ b + ',' + alp + ')');
	    radgrad.addColorStop( 1, 'rgba(' + r + ',' + g + ','+ b + ',0)');
	    context.fillStyle = radgrad;	
	    context.fillRect( oData[i][0] - 8, oData[i][1] - 8, 16, 16);
	}
    }

});
	  </script> 
	</div>
      </body>
    </html>
