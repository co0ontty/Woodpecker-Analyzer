## **Woodpecker-Analyzer**
#### 使用说明
git clone git@github.com:co0ontty/Woodpecker-Analyzer.git  
将文件夹中的文件全部复制到php根目录中  
访问index.html就可以使用  
默认日志文件为data.txt  
#### 环境需要
Mysql  
本系统默认使用的数据库密码是123456  
创建databases：  
CREATE database rizhi;  
在rizhi数据库中创建tables:  
use rizhi;  
CREATE TABLE TCP (num int,ip VARCHAR(30));  

#### auto_tongji
使用在日志需要备份在备份机的情况  
备份机与靶机都需要安装web服务  
在auto_tongji的文件中修改文件自动下载的ip地址为靶机  
啄木鸟日志分析系统安装在备份机中  