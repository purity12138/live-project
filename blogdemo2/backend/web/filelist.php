<?php
    header("Content-type:text/html;charset=utf-8");
    function my($dir){
        static $item_arr=array();
        $a=scandir($dir);
        foreach($a as $k=>$v){
            if($v=='.'|| $v=='..') continue;
            $v=$dir.'/'.$v;
            if(is_dir($v)){
                my($v);
            }
            else{
                $path=dirname($v);
                $item_arr[]=$path;
            }
        }
        return $item_arr;
    }

    $root=__DIR__;
    $b=array_unique(my($root));
    foreach($b as $k=>$v){
        print_r(glob($v));
        printf("\n");
    }
?>