<?php

$txt = file_get_contents('./input.txt');

$array = explode("\n", $txt);
$newArray = [];

foreach($array as $key => $string) {
    
    for($i=13; $i<=20;$i++) {
        if(strpos($string, "$i red")) {
            unset($array[$key]);
        }
    }

    for($j=14; $j<=20;$j++) {
        if(strpos($string, "$j green")) {
            unset($array[$key]);
        }
    }

    for($k=15; $k<=20;$k++) {
        if(strpos($string, "$k blue")) {
            unset($array[$key]);
        }
    }
   
 };

 foreach($array as $game) {
    $explode = explode(":", $game);
    $newArray[] = str_replace("Game ", "", $explode[0]);
 }
 

 echo array_sum($newArray);