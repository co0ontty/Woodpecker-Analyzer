<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>啄木鸟日志分析</title>
</head>
<script>
    function re_uplode(){
        window.location.href="uplode.html"
    }
    function result() {
        window.location.href="ip_tongji.php"
    }
    function into(){
        window.location.href="rizhi_select.php"
    }
</script>
<style>
    .bg{
        background: url("woodpecker.png");
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
        width:10%;
        height: auto;
        margin:40px auto 0 auto;
    }
</style>
<body class="bg" onkeydown="_key()" style="text-align: center;">
    <div style="padding-top: 10%;">
        <h1>啄木鸟日志分析系统</h1>
            <input class="login_btn" type="button" value="重新上传" onclick="re_uplode()">
            <input class="login_btn" type="button" value="统计情况" onclick="result()">
            <input class="login_btn" type="button" value="分析日志" onclick="into()">
    </div>

</body>
<!-- By: co0ontty-->
</html>
<?php
//取文件信息
$arr = $_FILES["file"];
//var_dump($arr);
//加限制条件
//1.文件类型
//2.文件大小
//3.保存的文件名不重复
if(($arr["type"]=="text/plain") && $arr["size"]<10241000 )
{
//临时文件的路径
$arr["tmp_name"];
//上传的文件存放的位置
//避免文件重复: 
//1.加时间戳.time()加用户名.$uid或者加.date('YmdHis')
//2.类似网盘，使用文件夹来防止重复
$filename = $arr["name"];
//保存之前判断该文件是否存在
  if(file_exists($filename))
  {
    echo "该文件已存在";
  }
  else
  {
  //中文名的文件出现问题，所以需要转换编码格式
  $filename = iconv("UTF-8","gb2312",$filename);
  //移动临时文件到上传的文件存放的位置（核心代码）
  //括号里：1.临时文件的路径, 2.存放的路径
  move_uploaded_file($arr["tmp_name"],$filename);
  }
}
else
{
  echo "上传的文件大小或类型不符";
}
?>