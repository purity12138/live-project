<?php
ini_set('max_execution_time', '0');
require('/../../vendor/autoload.php');
// function _sock($url) {
//     $host = parse_url($url,PHP_URL_HOST);
//     $port = parse_url($url,PHP_URL_PORT);
//     $port = $port ? $port : 80;
//     $scheme = parse_url($url,PHP_URL_SCHEME);
//     $path = parse_url($url,PHP_URL_PATH);
//     $query = parse_url($url,PHP_URL_QUERY);
//     if($query) $path .= '?'.$query;
//     if($scheme == 'https') {
//         $host = 'ssl://'.$host;
//     }
    
//     $fp = fsockopen($host,$port,$error_code,$error_msg,1);
//     if(!$fp) {
//         return array('error_code' => $error_code,'error_msg' => $error_msg);
//     }
//     else {
//         stream_set_blocking($fp,true);//开启了手册上说的非阻塞模式
//         stream_set_timeout($fp,1);//设置超时
//         $header = "GET $path HTTP/1.1\r\n";
//         $header.="Host: $host\r\n";
//         $header.="Connection: close\r\n\r\n";//长连接关闭
//         fwrite($fp, $header);
//         usleep(1000); // 这一句也是关键，如果没有这延时，可能在nginx服务器上就无法执行成功
//         fclose($fp);
//         return array('error_code' => 0);
//     }
// }


//_sock('/blogdemo2/backend/web/index.php?r=lives%2Fopen');
$list=glob("music/*.mp4");
var_dump($list);
$date=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 6,10);
$hours=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 17,2);
$minutes=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 20,2);
$seconds=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 23,2);
$title=substr(mb_convert_encoding($list[0], 'utf-8', 'gbk'), 26,-4);
echo "<video id=\"video1\" controls=\"controls\">
          <source src=\"".mb_convert_encoding($list[0], 'utf-8', 'gbk')."\">
          您的浏览器不支持 HTML5 audio  标签。
        </video>";
// $configuration = array(
//     'ffmpeg.binaries' => 'C:/FFmpeg/bin/ffmpeg.exe',
//     'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe', //这里是电脑或服务器上所安装的位置
//     //        'timeout'          => 3600, // The timeout for the underlying process
// //        'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
// );
// $ffprobe = FFMpeg\FFProbe::create($configuration);
//          // returns the duration property
// $duration = $ffprobe->format($list[0])->get('duration',100);
// var_dump(date('H:i:s',strtotime($hours.":".$minutes.":".$seconds." +".intval($duration)." seconds")));
// echo "若有一个以上的mp4文件请停止操作 联系管理员处理";
// echo '直播日期：'.$date;
// echo '开播时间：'.$hours.':'.$minutes.':'.$seconds;
// echo '下播时间：'.date('H:i:s',strtotime($hours.":".$minutes.":".$seconds." +".intval($duration)." seconds"));
// echo '直播标题：'.$title;
echo '<h3>请点击下边这个链接 点击后将在服务器开始剪辑操作 点击后页面长时间无法加载 请将它关闭 或者开着放那别管他 约30到60分钟后会完成剪辑 并输出剪辑信息 若出现报错请联系管理员</h3>';
// echo "<video id=\"video1\" controls=\"controls\">
//   <source src=\"music/"."2020-03-02 20-03-36 hanser】春~~~".".mp4\">
//   您的浏览器不支持 HTML5 audio  标签。
// </video>";
?>
<br>
<a href='/blogdemo2/backend/web/index.php?r=lives%2Fopen' target='_blank'>我是链接</a>
<br>