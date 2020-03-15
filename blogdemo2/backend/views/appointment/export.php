<?php
use common\models\Appointment;


?>
<div  style="float:left;">
<ul class="list-group">
<li class="list-group-item">
<form action="export.php" method="post" enctype="multipart/form-data">
<div class="form-group">
<input  type="submit" value="导出"/>
<?php 
    $post = Appointment::find()->all(); 
    echo "共".count($post)."条记录";
    $count=count($post);
    echo "<input value=$count type=\"text\" class=\"form-control\" name=count id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    $array1=array();
    $array2=array();
    $string1="";
    $string2="";
    $string3="";
    $string4="";
    $string5="";
    $string6="";
    for($i=0;$i<count($post);$i++){
        $date=$post[$i]->identify;
        $time=$post[$i]->tel;
        $name=$post[$i]->number;
        $serial=$post[$i]->serial;
        $win=$post[$i]->win;
        $nam=$post[$i]->name;
        $string1=$string1.','.trim(str_replace(" ",'',$date));
        $string2=$string2.','.trim(str_replace(" ",'',$time));
        $string3=$string3.','.trim(str_replace(" ",'',$name));
        $string4=$string4.','.trim(str_replace(" ",'',$serial));
        $string5=$string5.','.trim(str_replace(" ",'',$win));
        $string6=$string6.','.trim(str_replace(" ",'',$nam));
    }
    echo "<input value=$string1 type=\"text\" class=\"form-control\" name=date id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string2 type=\"text\" class=\"form-control\" name=time id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string3 type=\"text\" class=\"form-control\" name=name id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string4 type=\"text\" class=\"form-control\" name=serial id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string5 type=\"text\" class=\"form-control\" name=win id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
    echo "<input value=$string6 type=\"text\" class=\"form-control\" name=nam id=\"w0input\" style=\"width:700px;margin:30px;\"/>";
?>
<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
</div>
<!--file定义输入字段和 "浏览"按钮，供文件上传。-->

</form>
</li>
</ul>
</div>