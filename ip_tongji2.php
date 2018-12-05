<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="woodpecker.ico" / >
	<META HTTP-EQUIV=REFRESH CONTENT='10;URL=ip_tongji2.php'>
    <title>啄木鸟日志分析</title>
</head>
<?php
//save a new backup from remote
file_put_contents("baba.txt",file_get_contents("http://192.168.1.252/data.txt"));
//connect mysql
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rizhi";
$array_ip = array();
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
//open data.txt
$myfile = fopen("baba.txt", "r") or die("请导入新日志
	");
$line_num = count(file('baba.txt')); 

$file = file("baba.txt");
for ($i=0; $i < $line_num; $i++) { 
	$line = $file[$i];
	$start_line = substr($line,0,1);
	if ($start_line == 2) {
		// $preg = "/20.* /is";
		// preg_match($preg,$line,$arr);
		// $con_date = $arr[0];
		// echo $con_date;
		//echo $line;
	} else if ($start_line == " ") {
		//echo "TCP连接：";
		//正则匹配
		$preg = "/3389 .* /is";
		preg_match($preg,$line,$arr);
		$ip = $arr[0];
		//echo $ip."<br/>";
		$sql = "SELECT * FROM TCP WHERE ip=".'"'.$ip.'"';//查询是否存在该ip的记录
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$ip_num = $row["num"];
		if ($ip_num == NULL) {
			//如果该ip第一次访问，在mysql里面新建记录
			$into_sql = "INSERT INTO TCP (num,ip)VALUES ('1','$ip')";
			if (mysqli_query($conn, $into_sql)) {
		   //echo "新记录插入成功";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} else {
			//如果该ip之前访问过系统，则在原来基础上增加ip_num
			$ip_num = $ip_num +1;
			$into_sql = "UPDATE TCP SET num='$ip_num' WHERE ip='$ip'";
			if (mysqli_query($conn, $into_sql)) {
		    // echo "数据更新成功"."<br/>";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			//echo "该IP第".$ip_num."次访问"."<br/>";
		}
	} else {
		//输出日志生成时间
		//echo $line."非法连接建立"."<br/>";
	}
}
//关闭日志文件
//rename data.txt
fclose($myfile);
$now_time = date("ymdhi");
$ori_name = "baba.txt";
$next_name = "data".$now_time.".txt";
//rename 
if (file_exists($ori_name)||!file_exists($ori_name)) {
	copy("baba.txt",$next_name);
} else {
	echo "请先导入日志";
}
if (file_exists($ori_name)) {
	unlink($ori_name);
} 

//read

if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
$array = array();
$sql = "SELECT ip FROM TCP";
$result = mysqli_query($conn, $sql);
$i = 0;
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
    	// echo $i;
        // echo "IP:".$row["ip"]."<br>";
        $array_ip[$i]=$row["ip"];
        // $array_num[$i] = $row["num"];
        $i=$i+1;
    }
} else {
    echo "0 结果";
}
$sql = "SELECT num FROM TCP";
$result = mysqli_query($conn, $sql);
$i = 0;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    	// echo $i;
        // echo "IP:".$row["ip"]."<br>";
        // $array_ip[$i]=$row["ip"];
        $array_num[$i] = $row["num"];
        $i=$i+1;
    }
} else {
    echo "0 结果";
}
$array_num_type = [];
$delt = "truncate table TCP";
mysqli_query($conn, $delt);
mysqli_close($conn);
for ($q=1; $q <=$i ; $q++) { 
	$array_num_type[$q]=[$q];
}
$array_ip_json = json_encode($array_ip);
$array_num_json = json_encode($array_num);
$array_num_type1 = json_encode($array_num_type);

?>
<script type="text/javascript" src="jQuery.js"></script>
<script type="text/javascript" src="jqplot.js"></script>
<script type="text/javascript">
function ajax_test(params){
$.ajax({
url:'./php/data_read.php',
type:'post',
dataType:'html',
data:params,
error: function(){alert('error');},
success:function(products){
alert(products);
}
});
}
$(document).ready(function() {
    // var data = [[1,2,3,4,5,6,7,8,9],[3,2,5,4,1,6,7,3,10]];
    var data = [<?=$array_num_json?>];
    // var data = <?=$array_num_json?>;
    var data_max = 30; //Y轴最大刻度
    var line_title = ["A","B"]; //曲线名称
    var y_label = "攻击次数"; //Y轴标题
    var x_label = "IP(编号）"; //X轴标题
    var x = <?=$array_num_type1?>;
    // alert("3");
    // var x = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]; //定义X轴刻度值
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
	<div>
		<div style="width: 50%;text-align: center;float: left;">
			<h3>ip编号</h3>
			<?php 
			for ($q=1; $q <=$i ; $q++) { 
				echo $q."<br/>";
			}
			?>
		</div>
		<div style="width: 50%;text-align: center;float: right;">
			<h3>ip</h3>
			<?php 
			for ($q=0; $q <$i ; $q++) { 
				print_r($array_ip[$q]);
				echo "<br/>";
			}
			?>
		</div>
	</div>
</body>
<!-- By: co0ontty-->
</html>