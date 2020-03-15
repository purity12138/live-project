<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Lives;
/* @var $this yii\web\View */
/* @var $searchModel common\models\LivesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '直播记录管理';
$this->params['breadcrumbs'][] = $this->title;


?>


<div class="lives-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建直播记录', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('导出', ['export'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('剪辑当天直播的歌曲（请在直播结束后 录播软件结束录制后使用）', ['cut'], ['class' => 'btn btn-success']) ?>
    </p>
     <h1>用Excel文件导入直播记录</h1>
	
	<div >
			<div style="float:left;">
				<ul class="list-group">
				  <li class="list-group-item">				  
				  <form action="xlsx.php" method="post" enctype="multipart/form-data">
				  <div class="form-group">
						  <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
						  </div>
                        <!--file定义输入字段和 "浏览"按钮，供文件上传。-->
    						<input type="file" name="file" onchange="PreviewImage(this,'imgHeadPhoto','divPreview');" size="20" />
    						<input  type="submit" value="导入"/>
							
				</form>
					
				  
				  </li>
				</ul>			
			</div>
			
			
<!--enctype 属性规定在发送到服务器之前应该如何对表单数据进行编码,"multipart/form-data"在使用包含文件上传控件的表单时，必须使用该值。-->

<script type="text/javascript">
        //js本地图片预览，兼容ie[6-9]、火狐、Chrome17+、Opera11+、Maxthon3
        function PreviewImage(fileObj, imgPreviewId, divPreviewId) {
            var allowExtention = ".xlsx"; //允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
            var extention = fileObj.value.substring(fileObj.value.lastIndexOf(".") + 1).toLowerCase();
            var browserVersion = window.navigator.userAgent.toUpperCase();
            if (allowExtention.indexOf(extention) > -1) {
                if (fileObj.files) {//HTML5实现预览，兼容chrome、火狐7+等
                    if (window.FileReader) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            document.getElementById(imgPreviewId).setAttribute("src", e.target.result);
                        }
                        reader.readAsDataURL(fileObj.files[0]);
                    } else if (browserVersion.indexOf("SAFARI") > -1) {
                        alert("不支持Safari6.0以下浏览器的图片预览!");
                    }
                } else if (browserVersion.indexOf("MSIE") > -1) {
                    if (browserVersion.indexOf("MSIE 6") > -1) {//ie6
                        document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
                    } else {//ie[7-9]
                        fileObj.select();
                        if (browserVersion.indexOf("MSIE 9") > -1)
                            fileObj.blur(); //不加上document.selection.createRange().text在ie9会拒绝访问
                        var newPreview = document.getElementById(divPreviewId + "New");
                        if (newPreview == null) {
                            newPreview = document.createElement("div");
                            newPreview.setAttribute("id", divPreviewId + "New");
                            newPreview.style.width = document.getElementById(imgPreviewId).width + "px";
                            newPreview.style.height = document.getElementById(imgPreviewId).height + "px";
                            newPreview.style.border = "solid 1px #d2e2e2";
                        }
                        newPreview.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";
                        var tempDivPreview = document.getElementById(divPreviewId);
                        tempDivPreview.parentNode.insertBefore(newPreview, tempDivPreview);
                        tempDivPreview.style.display = "none";
                    }
                } else if (browserVersion.indexOf("FIREFOX") > -1) {//firefox
                    var firefoxVersion = parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
                    if (firefoxVersion < 7) {//firefox7以下版本
                        document.getElementById(imgPreviewId).setAttribute("src", fileObj.files[0].getAsDataURL());
                    } else {//firefox7.0+                    
                        document.getElementById(imgPreviewId).setAttribute("src", window.URL.createObjectURL(fileObj.files[0]));
                    }
                } else {
                    document.getElementById(imgPreviewId).setAttribute("src", fileObj.value);
                }
            } else {
                alert("仅支持" + allowExtention + "为后缀名的文件!");
                fileObj.value = ""; //清空选中文件
                if (browserVersion.indexOf("MSIE") > -1) {
                    fileObj.select();
                    document.selection.clear();
                }
                fileObj.outerHTML = fileObj.outerHTML;
            }
            return fileObj.value;    //返回路径
        }
    </script>
</html>
</div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            'time',
            'name:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <div class="enclosure-create">

   
    <?php
    
//     $post = Lives::find()->all();
//     $arr=array();
//     $aaa=array();
//     $count=count($post);
//     for($i=0;$i<count($post);$i++){
//         $aaa['date']=$post[$i]->date;
//         $aaa['name']=$post[$i]->name;
//         $aaa['time']=$post[$i]->time;
//         $arr[$i]=$aaa;
//         $post[$i]->delete();
//     }

//     for($i=0;$i<$count;$i++){
//                     $model=new Lives();
//                     $model->date=trim($arr[$i]['date']);
//                     $model->time=trim($arr[$i]['time']);
//                     $model->name=trim($arr[$i]['name']);
// //                     if($model->save()){
// //                         echo "wdnmd";
// //                     }
       
//      }
//     var_dump($_FILES);
//     if(isset($_FILES['file']))
//     var_dump($_FILES["file"]);
    
    
//     $filename = $_GET["file"]["tmp_name"];
//     $objReader = PHPExcel_IOFactory::createReaderForFile($filename);; //准备打开文件
//     $objPHPExcel = $objReader->load($filename);   //载入文件
//     $objPHPExcel->setActiveSheetIndex(0);         //设置第一个Sheet
//     $sheet=$objPHPExcel->getActiveSheet();
//     $highestRow =  $objPHPExcel->getActiveSheet()->getHighestRow();// 取得总行数
//     var_dump($highestRow);
//     for ($row = 2; $row <= $highestRow; $row++)    //行号从1开始
//     {
//         $data = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("B".$row)->getValue()));
//         $time = gmdate("H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("C".$row)->getValue()));
//         $name = $sheet->getCell("D".$row)->getValue();
//         if($name==NULL)
//             break;
//             var_dump($data);
//             var_dump($time);
//             var_dump($name);
//             $model=new Lives();
//             $model->date=$data;
//             $model->time=$time;
//             $model->name=$name;
//             if($model->save()){
//                 echo "wdnmd";
//             }
//             break;
//     }


//     $filename = 'tttt.xlsx';
//     $objReader = PHPExcel_IOFactory::createReaderForFile($filename);; //准备打开文件
//     $objPHPExcel = $objReader->load($filename);   //载入文件
//     $objPHPExcel->setActiveSheetIndex(0);         //设置第一个Sheet
//     $sheet=$objPHPExcel->getActiveSheet();
//     $highestRow =  $objPHPExcel->getActiveSheet()->getHighestRow();// 取得总行数
//     var_dump($highestRow);
//     for ($row = 2; $row <= $highestRow; $row++)    //行号从1开始
//     {
//         $data = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("B".$row)->getValue()));
//         $time = gmdate("H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("C".$row)->getValue()));
//         $name = $sheet->getCell("D".$row)->getValue();
//         if($name==NULL)
//             break;
//         var_dump($data);
//         var_dump($time);
//         var_dump($name);
// //         $model=new Lives();
// //         $model->date=$data;
// //         $model->time=$time;
// //         $model->name=$name;
// //         if($model->save()){
// //             echo "wdnmd";
// //         }
        
//     }
    
    
    //从word中导入
//     $file = fopen("gd.txt", "r") or exit("Unable to open file!");
//     $i=0;
//     while(!feof($file))
//     {
//         $line=fgets($file);
        
//         $line=str_replace(" ","_",$line);
        
//         $arr = explode('_' , $line);

//         var_dump($arr[0]);
//         var_dump($arr[1]);
//         var_dump(trim(str_replace("_"," ",substr($line,18))));
//          print_r($arr);
//         $model=new Lives();
//         $model->date=$arr[0];
//         $model->time=$arr[1];
//         $model->name=trim(str_replace("_"," ",substr($line,18)));
        
//         if($model->save()){
//             echo "wdnmd";
//         }
//         echo "<br>";
//         $i++;
//     }
//     fclose($file);

//删除重复
// $lives = Lives::find()->all();
// for($i=0;$i<count($lives);$i++){
//     for($j=$i+1;$j<count($lives);$j++){
//         if($lives[$i]->date==$lives[$j]->date&&$lives[$i]->time==$lives[$j]->time&&$lives[$i]->name==$lives[$j]->name){
//             $lives[$j]->delete();
//         }
//     }
// }
		      ?>	

</div>
