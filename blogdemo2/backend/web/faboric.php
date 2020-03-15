<?php
    $a = 1;
    $b = 1;
    $res = 2;
    $tmp;
    for($i = 3; $i <= 20; $i++){
        $tmp = $a + $b;
        $a = $b;
        $b = $tmp;
        $res += $tmp;
    }
    echo "$res";
?>