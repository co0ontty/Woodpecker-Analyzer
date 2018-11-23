<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$new_db = "test";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password);
// 检测连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
 
// 创建数据库
$sql = "CREATE DATABASE ".$new_db;//动态生成数据库
if (mysqli_query($conn, $sql)) {
    echo "数据库创建成功";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
 
mysqli_close($conn);