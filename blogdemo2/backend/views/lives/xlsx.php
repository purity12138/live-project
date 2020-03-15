<?php


require('/../../vendor/yiisoft/yii2/web/PHPExcel.php');
var_dump($_FILES);
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Lives;
$model=new Lives();


if($_FILES["file"]["error"])
{
    echo $_FILES["file"]["error"];
}

$filename = $_FILES["file"]["tmp_name"];
    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);; //准备打开文件
    $objPHPExcel = $objReader->load($filename);   //载入文件
    $objPHPExcel->setActiveSheetIndex(0);         //设置第一个Sheet
    $sheet=$objPHPExcel->getActiveSheet();
    $highestRow =  $objPHPExcel->getActiveSheet()->getHighestRow();// 取得总行数
    var_dump($highestRow);
    for ($row = 2; $row <= $highestRow; $row++)    //行号从1开始
    {
        $data = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("B".$row)->getValue()));
        $time = gmdate("H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("C".$row)->getValue()));
        $name = $sheet->getCell("D".$row)->getValue();
        if($name==NULL)
              break;
                var_dump($data);
                var_dump($time);
                var_dump($name);

    //             if($model->save()){
    //                 echo "wdnmd";
    //             }
                break;
            }
    