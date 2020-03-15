<?php

require(__DIR__ . '/../../vendor/yiisoft/yii2/web/PHPExcel.php');

$date=array();
$time=array();
$name=array();
$date=explode(",", $_POST['date']);
$time=explode(",", $_POST['time']);
$name=explode(",", $_POST['name']);
/**
 * Created by lonm.shi.
 * Date: 2012-02-09
 * Time: 下午4:54
 * To change this template use File | Settings | File Templates.
 */
ini_set('date.timezone','Asia/Shanghai');
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
->setLastModifiedBy("Maarten Balliauw")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
->setKeywords("office 2007 openxml php")
->setCategory("Test result file");
$objPHPExcel->setActiveSheetIndex(0);
// $highestRow =  $objPHPExcel->getActiveSheet()->getHighestRow();// 取得总行数
//     var_dump($highestRow);
//     for ($row = 2; $row <= $highestRow; $row++)    //行号从1开始
//     {
//         $data = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("B".$row)->getValue()));
//         $time = gmdate("H:i:s", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("C".$row)->getValue()));
//         $name = $sheet->getCell("D".$row)->getValue();
//         if($name==NULL)
    //               break;
    //         var_dump($data);
    //         var_dump($time);
    //         var_dump($name);
    //     }

    // Add some data
$j=1;
for($i=0;$i<$_POST['count'];$i++){
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$j, $date[$i]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$j, $time[$i]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$j, $name[$i+1]);
    $j++;
}
    


    // for($i = 0; $i < count($result); $i++){
    // $j = $i + 2;
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$j, $result[$i]['id']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$j, $result[$i]['openid']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$j, $result[$i]['nickname']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$j, $result[$i]['sex']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$j, $result[$i]['country']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$j, $result[$i]['province']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$j, $result[$i]['city']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$j, $result[$i]['scene']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$j, $result[$i]['tagid']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$j, $result[$i]['headimgurl']);
    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$j, date("Y-m-d H:i:s", $result[$i]['subscribe']));
    // // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$j, $result[$i]['so2']);
    // // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$j, $result[$i]['pm10']);
    // // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$j, $result[$i]['pm2_5']);
    // // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$j, $result[$i]['quality']);
    // }

    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('userlist');


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);


    // Redirect output to a client’s web browser (Excel2007)
    $filename = date("YmdHis",time());
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
