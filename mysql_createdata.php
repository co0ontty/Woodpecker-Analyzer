<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "rizhi";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
$sql = "INSERT INTO TCP (num,date,time,ip)VALUES('12','2018-2-3','08:59','192.168.1.3')";
 
if (mysqli_query($conn, $sql)) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
mysqli_close($conn);
?>