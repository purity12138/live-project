<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\Lives;
use common\models\Info;
require('/../../vendor/autoload.php');
ini_set('max_execution_time', '0');
//配置启动ffmpeg
$configuration = array(
    'ffmpeg.binaries' => 'C:/FFmpeg/bin/ffmpeg.exe',
    'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe', //这里是电脑或服务器上所安装的位置
    //        'timeout'          => 3600, // The timeout for the underlying process
//        'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
);
$ffmpeg = FFMpeg\FFMpeg::create($configuration);
 
//  $video->filters()->clip(FFMpeg\Coordinate\TimeCode::fromSeconds(30), FFMpeg\Coordinate\TimeCode::fromSeconds(15));
//  $video->save(new FFMpeg\Format\Video\x264('aac'),'music/test.mp4');
 //$video = $ffmpeg->open('music/test.mp4');
//剪辑操作 mp4->mp3 mp3->小mp3 删mp4
$list=glob("music/*.mp4");
var_dump($list);
$date=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 6,10);
$hours=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 17,2);
$minutes=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 20,2);
$seconds=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 23,2);
$title=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 26,-4);
$configuration = array(
    'ffmpeg.binaries' => 'C:/FFmpeg/bin/ffmpeg.exe',
    'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe', //这里是电脑或服务器上所安装的位置
    //        'timeout'          => 3600, // The timeout for the underlying process
//        'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
);
//$ffprobe = FFMpeg\FFProbe::create($configuration);
// returns the duration property
//$duration = $ffprobe->format($list[0])->get('duration',100);
//var_dump(date('H:i:s',strtotime($hours.":".$minutes.":".$seconds." +".intval($duration)." seconds")));
echo "若有一个以上的mp4文件请停止操作 联系管理员处理";
echo '直播日期：'.$date;
echo '开播时间：'.$hours.':'.$minutes.':'.$seconds;
//echo '下播时间：'.date('H:i:s',strtotime($hours.":".$minutes.":".$seconds." +".intval($duration)." seconds"));
echo '直播标题：'.$title;
// $info=new Info();
// $info->title=$title;
// $info->start_time=date('Y-m-d H:i:s',strtotime($date." ".$hours.":".$minutes.":".$seconds));
// $info->end_time=date('Y-m-d H:i:s',strtotime($date." ".$hours.":".$minutes.":".$seconds." +".intval($duration)." seconds"));
// if($info->save()){
//     echo "直播信息保存";
// }
//var_dump($info);
// //整个mp4变成mp3 超时 放弃
// // $video = $ffmpeg->open($list[0]); 
// // $audio_format = new FFMpeg\Format\Audio\Mp3();//Set an audio format
// // $video->save($audio_format, 'music/nowadays.mp3');
// for($i=0;$i<count($list);$i++){
//     var_dump(mb_convert_encoding($list[$i], 'utf-8', 'gbk'));
//     //$video = $ffmpeg->open(mb_convert_encoding($list[$i], 'utf-8', 'gbk'));
//     //var_dump(mb_convert_encoding(mb_convert_encoding($list[$i], 'utf-8', 'gb2312'), 'gb2312', 'utf-8'));
// }
$cond=['date'=>$date];
$lives=Lives::find()->where($cond)->all();
//var_dump($lives);
$dir = iconv("UTF-8", "GBK", "music/".$date);
if (!file_exists($dir)){
    mkdir ($dir,0777,true);
    echo '创建文件夹'.$date.'成功';
} else {
    echo '需创建的文件夹'.$date.'已经存在';
}

//mp4->小mp4

$list=glob("music/*.mp4");
$video = $ffmpeg->open($list[0]);
 $audio_format = new FFMpeg\Format\Audio\Mp3();
for($i=0;$i<count($lives);$i++){
    var_dump($lives[$i]->time);
    $title=$lives[$i]->name;
    var_dump(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hour -".$minutes." minute -".$seconds." second")));
    $parsed = date_parse(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hour -".$minutes." minute -".$seconds." second")));
    //$parsed = date_parse(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hours ".$minutes." minutes ".$seconds." seconds")));
    $second = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
    var_dump($second);
    echo $second;
    $second=$second-10;
    echo 'music/'.$title.'.mp4';
    echo $second;
    $video->filters()->clip(FFMpeg\Coordinate\TimeCode::fromSeconds($second), FFMpeg\Coordinate\TimeCode::fromSeconds(240));
    
    
    //$audio->save($audio_format, 'music/'.$date.mb_convert_encoding($title, 'gb2312', 'utf-8').'.mp3');
    //$video->save($audio_format, 'music/'.'test.mp3');
    //$video->save($audio_format, 'music/'.$date.'/'.mb_convert_encoding($title, 'gbk', 'utf-8').'.mp3');
    $video->save(new FFMpeg\Format\Video\x264('aac'),'music/'.$date.'/'.mb_convert_encoding($title, 'gbk', 'utf-8').'.mp4');
}
$tt=date('Y-m-d',strtotime($date)+86400);
$cond = ['like','date', $tt];
$lives = Lives::find()->where($cond)->all();
for($i=0;$i<count($lives);$i++){
    if(substr( $lives[$i]->time, 0, 1 )=='0'){
        var_dump($lives[$i]->time);
        $title=$lives[$i]->name;
        var_dump(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hour -".$minutes." minute -".$seconds." second")));
        $parsed = date_parse(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hour -".$minutes." minute -".$seconds." second")));
        //$parsed = date_parse(date('H:i:s',strtotime($lives[$i]->time."- ".$hours." hours ".$minutes." minutes ".$seconds." seconds")));
        $second = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        $second=$second-10;
        echo 'music/'.$title.'.mp4';
        $video->filters()->clip(FFMpeg\Coordinate\TimeCode::fromSeconds($second), FFMpeg\Coordinate\TimeCode::fromSeconds(240));
        //$audio->save($audio_format, 'music/'.$date.mb_convert_encoding($title, 'gb2312', 'utf-8').'.mp3');
        //$audio->save($audio_format, 'music/'.$date.'/'.mb_convert_encoding($title, 'gbk', 'utf-8').'.mp3');
        $video->save(new FFMpeg\Format\Video\x264('aac'),'music/'.$date.'/'.mb_convert_encoding($title, 'gbk', 'utf-8').'.mp4');
    }
}


$list=glob("music/".$date."/*.mp4");
var_dump($list);

$audio_format = new FFMpeg\Format\Audio\Mp3();
for($i=0;$i<count($list);$i++){
    $audio = $ffmpeg->open($list[$i]);
    $title=substr(mb_convert_encoding($list[$i], 'utf-8', 'gbk'), 17,-4);
    echo $title."\n"; 
    $audio->save($audio_format, 'music/'.$date.'/'.mb_convert_encoding($title, 'gbk', 'utf-8').'.mp3');
    echo mb_convert_encoding($list[$i], 'utf-8', 'gbk')."保存为mp3";
}


 
 
 echo '剪辑完成';
// unlink ('music/b.mp4');  //删除原mp4文件
?>


 
<script>
//myVid=document.getElementById("video1");
</script> 