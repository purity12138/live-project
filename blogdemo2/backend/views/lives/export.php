<?php
use common\models\Lives;


?>
<div  style="float:left;">
<ul class="list-group">
<li class="list-group-item">
<form action="export.php" method="post" enctype="multipart/form-data">
<div class="form-group">
<input  type="submit" value="导出"/>
<?php 
    $post = Lives::find()->all(); 
    echo "共".count($post)."条记录";
    $count=count($post);
    echo "<input value=$count type=\"text\" class=\"form-control\" name=count id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    $array1=array();
    $array2=array();
    $string3="";
    for($i=0;$i<count($post);$i++){
        $date=$post[$i]->date;
        $time=$post[$i]->time;
        $name=$post[$i]->name;
        $array1[$i]=$date;
        $array2[$i]=$time;
            $string3=$string3.','.trim(str_replace(" ",'',$name));
    }
    $string1=implode(",",$array1);
    $string2=implode(",",$array2);
    echo "<input value=$string1 type=\"text\" class=\"form-control\" name=date id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string2 type=\"text\" class=\"form-control\" name=time id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string3 type=\"text\" class=\"form-control\" name=name id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
?>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
</div>
<!--file定义输入字段和 "浏览"按钮，供文件上传。-->

</form>
</li>
</ul>
</div>