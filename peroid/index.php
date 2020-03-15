<?php

use common\models\Peroid;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PeroidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<div class="peroid-index">
	<?php 

	$lives = Peroid::find()->all();
	//var_dump($lives);
	print_r("<table class=\"table\">
	<caption>"."预约"."</caption>
	<thead>
	   <tr>
		  <th>开始时间</th>
		  <th>结束时间</th>
		  <th>可预约数</th>
		  <th>口罩总数</th>
		  <th>预约</th>
	   </tr>
	</thead>
	");

	for($i=0;$i<count($lives);$i++){
		print_r("
			<tbody>
				<tr>
					<td class='content'>".$lives[$i]->start_time."</td>
					<td class='content'>".$lives[$i]->endtime."</td>
					<td class='content'>".$lives[$i]->num."</td>
					<td class='content'>".$lives[$i]->total."</td>
					<td class='content'>"."<a href=\"".$lives[$i]->url."\">预约"."</td>
				</tr>
			</tbody>
		");
	}


	print_r("</table>");
	echo "
		<form action=\"../views/peroid/start.php\" >
			<input class='btn-primary' value=\"开始新的预约\" class=\"pk\" name=\"submit\" type=\"submit\"/>
		</form>
		<form action=\"../views/peroid/end.php\" >
			<input class='btn-primary' value=\"结束当前预约\" class=\"pk\" name=\"submit\" type=\"submit\"/>
		</form>
				";
	?>
</div>
<script>
	var head=document.getElementById("yy");
	head.className='la';    			       
</script>
