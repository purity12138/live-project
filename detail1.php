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
header("Content-Type: text/html;charset = utf-8");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdemo2db";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

?><style type="text/css">
    a:hover{
         text-decoration:none;
    }
		 .b{/*设置导航栏的框框*/
		 display: block;/*将a变成块状*/
		 width:100%;
		  height:75px;
		  background-color: black;
		  z-index:998;
		  position:relative;
		  left:-10px;
		  top:-10px;
		}
		@media (max-width: 1200px) {
		    .cc{
		      display:none;
		    }
		    .se{
		  background-color: black;
			color:white;
		  width:150px;
		  height:75px;
		  position:fixed;
		  left:calc(100% - 150px);
		  z-index:999;
		  font-size: 25px;
		}
		}
		 .cc{
		  width:200px;
		  background-color: black;
		  height:100%;
			list-style-type: none;/* 去掉li前的点 */
			float: left;/*将li设置成做浮动，变为联动*/
			text-align: center;/*字体居中*/
			position: relative;
			left:700px;
			color: white;
			z-index:998;
		}
		.cc:hover{
		  background-color:green;
		}
		 .a{
		 background-color: black;
			display: block;/*将a变成块状*/
			height: 100%;/*设置块的长度*/
			line-height: 70px;/*设置字体在块中的高度*/
			margin: 0px 0px;/*块里的高宽通过margin设置*/
			text-align: center;/*字体居中*/
			text-decoration: none;/*去掉下划线*/
			font-size: 25px;
			color:white;
			z-index:998;
		}
		.aa{
		  background-color: #FFCDB5;
			display: block;/*将a变成块状*/
			height: 100%;/*设置块的长度*/
			margin: 0px 0px;/*块里的高宽通过margin设置*/
			font-size: 0px;
			z-index:998;
			background: url('images/2.webp') no-repeat;
            background-size: cover;
            border-style: none;
		}
		.ccc{
		height:75px;
		    width:200px;
		   background-color: #FFCDB5;
			list-style-type: none;/* 去掉li前的点 */
			float: left;/*将li设置成做浮动，变为联动*/
			text-align: center;/*字体居中*/
			position: relative;
			left:21.7%;
			z-index:998;
			border-style: none;
			overflow: hidden;
			
		}
		.a:hover{
			background-color: #469A99;
			color:white;
		}
	
		.footer{
		  background-color:#000;
		  color:white;
		  position: relative;
          height: 100px;
		  font-size:20px;
		  bottom:0;
		  width:100%;
		  clear: both;
		}
		.header{
		  width:100%;
		}
		.op{
		  width:100px;
		  height:100px;
		}
	</style>

<div class='header'>
		<ul class=b>
			<li class=cc><a id='yy' class=a href="/blogdemo2/frontend/web/index.php?r=peroid%2Findex"><font color="">预约</font></a></li>
			<li class=cc><a id='cx' class=a href="/blogdemo2/frontend/web/index.php?r=appointment%2Findex"><font color="">查询</font></a></li>
		</ul>
</div>
<?php 
$sql="SELECT *
    FROM appointment
    WHERE serial ='".$_GET['id']."'
    and win <> '".'0'."'
    ";
$result = mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result)){
    print_r('<h3 style=\'text-align:center;\'>姓名：'.$row[7].'</h3></br>');
    print_r('<h3 style=\'text-align:center;\'>身份证号：'.$row[1].'</h3></br>');
    print_r('<h3 style=\'text-align:center;\'>电话号码：'.$row[2].'</h3></br>');
    print_r('<h3 style=\'text-align:center;\'>购买数量：'.$row[6].'</h3></br>');
}
else{
    echo "<script>alert('您没有中签')</script>";
}
$conn->close();

?>
<style>


</style>
<div class="c" style='margin-top:10px;'>
	<?php 
	   
	?>
	
</div>
	