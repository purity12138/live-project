<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

use yii\helpers\HtmlPurifier;
use common\models\Comment;
use common\models\Likes;
use yii\helpers\Url;
use common\models\Peroid;
use common\models\Appointment;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
ini_set('date.timezone','Asia/Shanghai');
$total=Peroid::find()->where(['id'=>$model->id])->all();
$used=Appointment::find()->where(['period_id'=>$model->id])->all();
$count=0;
for($i=0;$i<count($used);$i++){
    $count+=$used[$i]->number;
}
$max=$total[0]->num;
$left=$total[0]->total-$count;
$start=$total[0]->start_time;
$end=$total[0]->endtime;
echo "<h3>最大可预约数量：".$max."</h3>";
echo "<h3>总数量：".$total[0]->total."</h3>";
echo "<h3>已预约个数：".$count."</h3>";
echo "<h3>开始时间：".$start."</h3>";
echo "<h3>结束时间：".$end."</h3>";
?>
<style>
.pf{
    width:500px;
    height:35px;
    background-size: cover;
}
.pk{
    height:35px;
}
.form-control{
    position:relative;
}
.btn-primary{
    position:relative;
    left:500px;
}
</style>

<div class="c" style='margin-top:10px;'>
	<?php 
	$id=$model->id;
    
	if(strtotime('now')>strtotime($start)&&strtotime('now')<strtotime($end)){
	        echo "
     <form action=\"../views/peroid/handle.php\" >
        <input class='form-control' type=\"text\" class=\"pf\" name=\"name\" placeholder=\"真实姓名\">
		<br>
		<input class='form-control' type=\"text\" class=\"pf\" name=\"id\" placeholder=\"身份证号码\">
		<br>
		<input class='form-control' type=\"text\" class=\"pf\" name=\"tel\" placeholder=\"电话\">
		<br>
		<input class='form-control' type=\"text\" class=\"pf\" name=\"num\" placeholder=\"预约数量\">	
		<input value=$id type=\"text\" style=\"display: none;\" name=\"period_id\"  >	
		<input value=$max type=\"text\" style=\"display: none;\" name=\"max\" >	
		<input value=$left type=\"text\" style=\"display: none;\" name=\"left\" >	
		<br>		  
		<input class='btn-primary' value=\"提交\" class=\"pk\" name=\"submit\" type=\"submit\"/>
	</form>
            ";
	   }
	   else{
	       echo "现在不是当期预约的预约时间";
	   }
	?>
	
</div>