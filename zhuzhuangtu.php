<?php
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_bar.php");
 
$data  = array(19,23,34,38,45,67,71,78,85,87,96,145);         
$ydata = array("一","二","三","四","五","六","七","八","九","十","十一","十二");
 
$graph = new Graph(500,300);  //创建新的Graph对象
$graph->SetScale("textlin");  //刻度样式
$graph->SetShadow();          //设置阴影
$graph->img->SetMargin(40,30,40,50); //设置边距
 
$graph->graph_theme = null; //设置主题为null，否则value->Show(); 无效
 
$barplot = new BarPlot($data);  //创建BarPlot对象
$barplot->SetFillColor('blue'); //设置颜色
$barplot->value->Show(); //设置显示数字
$graph->Add($barplot);  //将柱形图添加到图像中
 
$graph->title->Set("CDN流量图"); 
$graph->xaxis->title->Set("月份"); //设置标题和X-Y轴标题
$graph->yaxis->title->Set("流 量(Mbits)");                                                                      
$graph->title->SetColor("red");
$graph->title->SetMargin(10);
$graph->xaxis->title->SetMargin(5);
$graph->xaxis->SetTickLabels($ydata);
 
$graph->title->SetFont(FF_SIMSUN,FS_BOLD);  //设置字体
$graph->yaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->title->SetFont(FF_SIMSUN,FS_BOLD);
$graph->xaxis->SetFont(FF_SIMSUN,FS_BOLD);
 
$graph->Stroke();
?>
