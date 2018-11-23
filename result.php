<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>啄木鸟日志分析</title>
</head>
<script>
    function goto(){
        window.location.href="rizhi_select.php"
    }
    function _key() { 
    if(event.keyCode ==13) 
    goto(); 
    } 
</script>
<style>

</style>
<body class="bg" onkeydown="_key()">
<div style="width: 35%;height: auto;margin: auto;">
<h1>啄木鸟日志分析系统</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rizhi";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
 
$sql = "SELECT * FROM TCP";
$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        echo "被连接端口及对方IP:".$row["ip"]."   "."总计连接次数".$row["num"]."<br>";
    }
} else {
    echo "0 结果";
}
mysqli_close($conn);
?>
</div>
</body>
</html>