<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<html>
<head>
	<title>啄木鸟日志分析系统</title>
    <link rel="shortcut icon" href="woodpecker.ico" / >
</head>
<body style="text-align: center;">
<div>
<h1>啄木鸟日志分析系统</h1>
<?php 
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rizhi";
//连接数据库
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
//打开需要导入的日志文件
$myfile = fopen("data.txt", "r") or die("请导入新日志");
$line_num = count(file('data.txt')); 
//输出文件中的总行数
echo "数据总量：".$line_num."行"."<br/>"; 
$file = file("data.txt");
for ($i=0; $i < $line_num; $i++) { 
	$line = $file[$i];
	$start_line = substr($line,0,1);
	if ($start_line == "2") {
		// $preg = "/20.* /is";
		// preg_match($preg,$line,$arr);
		// $con_date = $arr[0];
		// echo $con_date;
		echo $line."<br/>";
	} else if ($start_line == " ") {
		echo "TCP连接：";
		//正则匹配
		$preg = "/3389 .* /is";
		preg_match($preg,$line,$arr);
		$ip = $arr[0];
		echo $ip."<br/>";
		$sql = "SELECT * FROM TCP WHERE ip=".'"'.$ip.'"';//查询是否存在该ip的记录
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$ip_num = $row["num"];
		if ($ip_num == NULL) {
			//如果该ip第一次访问，在mysql里面新建记录
			$into_sql = "INSERT INTO TCP (num,ip)VALUES ('1','$ip')";
			if (mysqli_query($conn, $into_sql)) {
		    echo "该ip第一次访问";
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
			echo "该IP第".$ip_num."次访问"."<br/>";
		}
		} else if ($start_line == "U") {
			$sql = "SELECT * FROM TCP WHERE ip='new user create'";//查询是否存在该ip的记录
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$ip_num = $row["num"];
			if ($ip_num == NULL) {
				$into_sql = "INSERT INTO TCP (num,ip)VALUES ('1','new user create')";
			if (mysqli_query($conn, $into_sql)) {
		    	echo "该ip第一次创建用户";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} else {
			$ip_num = $ip_num +1;
			$into_sql = "UPDATE TCP SET num='$ip_num' WHERE ip='new user create'";
			if (mysqli_query($conn, $into_sql)) {
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			echo "第".$ip_num."次用户被创建"."<br/>";
		}
		// echo "新用户被创建"."<br/>";
		}else if ($start_line == "S") {
			$sql = "SELECT * FROM TCP WHERE ip='Siemens TIA Portal V15'";//查询是否存在该ip的记录
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$ip_num = $row["num"];
			if ($ip_num == NULL) {
				$into_sql = "INSERT INTO TCP (num,ip)VALUES ('1','Siemens TIA Portal V15')";
			if (mysqli_query($conn, $into_sql)) {
		    	echo "Siemens TIA Portal V15 被打开"."<br/>";
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		} else {
			$ip_num = $ip_num +1;
			$into_sql = "UPDATE TCP SET num='$ip_num' WHERE ip='Siemens TIA Portal V15'";
			if (mysqli_query($conn, $into_sql)) {
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			echo "第".$ip_num."次打开Siemens TIA Portal V15"."<br/>";
		}
		// echo "Siemens TIA Portal V15 被打开"."<br/>";
		}else {
		echo $line."用户登陆"."<br/>";
	}
}
//关闭日志文件
fclose($myfile);
$now_time = date("ymdhi");
$ori_name = "data.txt";
// $next_name = "/var/www/html/".$now_time.".txt";
$next_name = "data".$now_time.".txt";
// echo $ori_name;
// echo $next_name;
if (file_exists($ori_name)||!file_exists($ori_name)) {
	copy("data.txt",$next_name);
} else {
	echo "请先导入日志";
}
if (file_exists($ori_name)) {
	unlink($ori_name);
} 
?>
</div>
</body>
</html>