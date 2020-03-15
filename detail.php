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
	
</div>