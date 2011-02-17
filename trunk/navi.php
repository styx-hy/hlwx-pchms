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
      $("#menus ul li").mouseover(function() {
      $(this).addClass("over");}).mouseout(function() {
      $(this).removeClass("over");});
      $("#menus ul li:even").addClass("alt");

      });
    </script>
    </head>

    <body>
    <div class="wrapper" align="center">
      <div id="top_title" align="right">
        <table class="user_settings">
          <tr align="center">
            <td><div>
                <h3>Hello, <?php echo $_SESSION['username']; ?></h3>
              </div></td>
            <td><ul>
                <li>设置</li>
                <li><a href="action.php?action=logout">退出</li>
              </ul></td>
          </tr>
        </table>
      </div>
      <br />
      <div id="plot">
        <div id="menus">
          <ul >
            <li><a href="javascript:void(0);" id="daily_count"> Daily Count </a></li>
            <li><a href="javascript:void(0);" id="mouse_count"> Mouse Count </a></li>
            <li><a href="javascript:void(0);" id="keyboard_count"> Keyboard Count </a></li>
            <li><a href="javascript:void(0);" id="scatter"> Click Scatterring </a></li>
            <li><a href="javascript:void(0);" id="enable_tooltip"> Enable Tooltip </a></li>
          </ul>
        </div>
        <div id="holder">
          <div id="chart_title" align="center">图表将在以下区域画出</div>
          <div id="placeholder" align="center"></div>
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
        $("#chart_title").html("Daily Count");
        var stack = 0, bars = true, lines = false, steps = false;
        var options = {
	    xaxis: {
	        mode: "time",
                timeFormat: "%m%d",
	        min: (new Date()).getTime() - 86400000 * 19,
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
    $("#chart_title").html("Mouse Count Per 10 minutes");
    var options = {
	xaxis: {
	    color: ["#ffffff"],
	    mode: "time",
	    min: (new Date()).getTime() - 86400000 * 20,
	    max: (new Date()).getTime() - 86400000 * 17
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
      </script> 
    </div>
</body>
</html>
