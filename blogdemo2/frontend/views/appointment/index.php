<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Appointment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppointmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<style>
.la{
    background-color: #FFCDB5;
	display: block;/*将a变成块状*/
	height: 100%;/*设置块的长度*/
	line-height: 70px;/*设置字体在块中的高度*/
	margin: 0px 0px;/*块里的高宽通过margin设置*/
	text-align: center;/*字体居中*/
	text-decoration: none;/*去掉下划线*/
	font-size: 25px;
	color:black;
	z-index:999;
    background-color: #469A99;
	color:white;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<div class="appointment-index">
	<?php 
	echo "
     <form action=\"../views/appointment/detail.php\" >
		<input class='form-control' type=\"text\"  name=\"id\" placeholder=\"预约编号\">
		<br>
		<input class='btn-primary' value=\"提交\"  name=\"submit\" type=\"submit\"/>
	</form>
            ";
	?>
</div>
<script>
	var head=document.getElementById("cx");
	head.className='la';		       
</script>
