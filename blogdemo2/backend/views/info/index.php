<?php
ignore_user_abort(true);
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Info;
/* @var $this yii\web\View */
/* @var $searchModel common\models\InfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>

  <meta charset="utf-8">
  <title>站点创建成功-phpstudy for windows</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="format-detection" content="telephone=no">
  <meta HTTP-EQUIV="pragma" CONTENT="no-cache"> 
  <meta HTTP-EQUIV="Cache-Control" CONTENT="no-store, must-revalidate"> 
  <meta HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT"> 
  <meta HTTP-EQUIV="expires" CONTENT="0">
  <style>
    
  </style>
</head>
<body>
  <?php

  set_time_limit(0);
  date_default_timezone_set('PRC'); // 切换到中国的时间
  
  $run_time = strtotime('+1 day'); // 定时任务第一次执行的时间是明天的这个时候
  $interval = 3600*12; // 每12个小时执行一次
  
  if(!file_exists(dirname(__FILE__).'/cron-run')) exit(); // 在目录下存放一个cron-run文件，如果这个文件不存在，说明已经在执行过程中了，该任务就不能再激活，执行第二次，否则这个文件被多次访问的话，服务器就要崩溃掉了

  function curl_file_get_contents($durl){
      // 初始化
      $curl = curl_init();
      // 设置url路径
      curl_setopt($curl, CURLOPT_URL, $durl);
      // 将 curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true) ;
      // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
      curl_setopt($curl, CURLOPT_BINARYTRANSFER, true) ;
      // CURLINFO_HEADER_OUT选项可以拿到请求头信息
      curl_setopt($curl, CURLINFO_HEADER_OUT, true);
      // 不验证SSL
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
      // 执行
      $data = curl_exec($curl);
      // 关闭连接
      curl_close($curl);
      // 返回数据
      return $data;
  }
  $loop=1;
   do {
       var_dump(file_exists(dirname(__FILE__).'/cron-switch'));
      if(!file_exists(dirname(__FILE__).'/cron-switch')) break; // 如果不存在cron-switch这个文件，就停止执行，这是一个开关的作用
      $gmt_time = microtime(true); // 当前的运行时间，精确到0.0001秒
      $loop = isset($loop) && $loop ? $loop : $run_time - $gmt_time; // 这里处理是为了确定还要等多久才开始第一次执行任务，$loop就是要等多久才执行的时间间隔
      $loop = $loop > 0 ? $loop : 0;
      if(!$loop) break; // 如果循环的间隔为零，则停止
      sleep($loop);
      // ...
      // 执行某些代码
      ini_set('date.timezone','Asia/Shanghai');
      $url='https://www.douyu.com/betard/2550505';
      $data = curl_file_get_contents($url);
      $json = json_decode($data);
      $start_time = date('Y-m-d H:i:s', $json->room->show_time);
      $end_time = date('Y-m-d H:i:s', $json->room->end_time);
      $title = $json->room->room_name;
      $model=new Info();
      $model->title=$title;
      $model->start_time=$start_time;
      $model->end_time=$end_time;
      var_dump($model);
      $cond = ['start_time'=> $start_time];
      $find=Info::find()->where($cond)->all();
      if(!$find){
          $model->save();
      }
      echo '开始时间:', $start_time;
      echo "<br>";
      echo '结束时间:', $end_time;
      echo "<br>";
      echo '标题:', $title;
      // ...
      @unlink(dirname(__FILE__).'/cron-run'); // 这里就是通过删除cron-run来告诉程序，这个定时任务已经在执行过程中，不能再执行一个新的同样的任务
      $loop = $interval;
      
      
    } while(true);
  
  
  
  
  
  
  ?>
</body>
</html>