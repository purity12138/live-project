<?php
$url='https://www.360kuai.com/mob/subject/400?sign=360_6aa05217';

$html= file_get_contents($url);
var_dump($html);
// $fp = fopen("test.txt",'w');
// fwrite($fp,$html);
// fclose($fp);
// preg_match_all('/<span class="(.*?)">(.*?)<\/span>/',$html,$m);
// var_dump($m);