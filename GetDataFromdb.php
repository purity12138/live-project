<?php
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

/*
echo $max;
echo $left;
echo $start;
echo $end;
*/
?>