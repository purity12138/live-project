<?php
$file = fopen("zbjl.txt", "r") or exit("Unable to open file!");
while(!feof($file))
{
    $line=fgets($file);
    
    $line=str_replace("\t","_",$line);
    
    $arr = explode('_' , $line);
    
    
    print_r($arr);
    //             $model=new Lives();
    //             $model->date="2020-1-1";
    //             $model->time="20:20:20";
    //             $model->name="hanser";
    //             if($model->save()){
    //                 echo "wdnmd";
    //             }
    echo "<br>";
}
fclose($file);

?>