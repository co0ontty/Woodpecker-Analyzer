<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="woodpecker.ico" / >
    <title>啄木鸟日志分析</title>
</head>
<script>
    function home_page(){
        window.location.href="rizhi.html"
    }
    function result() {
        window.location.href="ip_tongji.php"
    }
    function into(){
        window.location.href="uplode.html"
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
            <input class="login_btn" type="button" value="返回主页" onclick="home_page()">
            <input class="login_btn" type="button" value="统计情况" onclick="result()">
            <input class="login_btn" type="button" value="上传日志" onclick="into()">
    </div>
</body>
<!-- By: co0ontty-->
</html>