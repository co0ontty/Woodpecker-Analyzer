<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>啄木鸟日志分析</title>
</head>
<script type="text/javascript" src="jQuery.js"></script>
<script type="text/javascript" src="jqplot.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var data = [[1,2,3,4,5,6,7,8,9]];
    var data_max = 30; //Y轴最大刻度
    var line_title = ["A","B"]; //曲线名称
    var y_label = "攻击次数"; //Y轴标题
    var x_label = "IP"; //X轴标题
    var x = [1,2,3,4,5,6,7,8,9]; //定义X轴刻度值
    var title = "IP统计"; //统计图标标题
    j.jqplot.diagram.base("chart1", data, line_title, "源ip", x, x_label, y_label, data_max, 1);
    j.jqplot.diagram.base("chart2", data, line_title, "攻击次数统计", x, x_label, y_label, data_max, 2);
});
</script>
<style>
    .bg{
        /*background: url("woodpecker.png");*/
        background-size: 100%,100%
        /*background-repeat: no-repeat;*/
    }
    input{
        border: 1px solid #ccc;/*边框加颜色*/
        padding: 7px 0px;
        border-radius: 3px;/*设置圆角边框*/
        padding-left:5px;
    }
    input:focus{/*当边框被选中*/
        border-color: #00CC66;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
    }
    p{
        color: #5dafd1;
        height: 0%;
    }
    .login_btn{
        width:15%;
        height: auto;
        margin:40px auto 0 auto;
    }
</style>
<body class="bg" onkeydown="_key()" style="text-align: center;">
    <div style="padding-top: 10%;">
        <h1>啄木鸟日志分析系统</h1>
    </div>
	<div id="chart1"></div>
	<div id="chart2"></div>
	</div>
</body>
<!-- By: co0ontty-->
</html>