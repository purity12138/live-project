<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Lives;
use common\models\Post;
$cond = [ 'id' => $id]; 
$post = Post::find()->where($cond)->all(); 
error_reporting(0);
ini_set('date.timezone','Asia/Shanghai');
$title=$post[0]->title;
$date=date("Y/m/d");
$time=date("H:i:s");
$title=str_replace(" ", "|", $title);
?>
<div class="lives-create">

    <h1><?= Html::encode("按歌名添加直播记录") ?></h1>
      <h2>
	<?php 
	echo "你要添加的直播记录歌曲名为：".$post[0]->title;

	?>
  </h2>
  <br>
<form class="form-inline" action="" id="w0" method="get">
	<div class="form-group">
	
		<?php echo "<input value=$title type=\"text\" class=\"form-control\" name=\"title\" id=\"w0input\" style=\"width:700px;margin:30px;\"/>"?>
		<?php echo "<input value=$date type=\"text\" class=\"form-control\" name=\"date\" id=\"w0input\" style=\"width:700px;margin:30px;\"/>"?>
		<?php echo "<input value=$time type=\"text\" class=\"form-control\" name=\"time\" id=\"w0input\" style=\"width:700px;margin:30px;\"/>"?>
		
	</div>						  
	<input value="添加" name="submit" type="submit" style="margin:30px;"/>
</form>
</div>

