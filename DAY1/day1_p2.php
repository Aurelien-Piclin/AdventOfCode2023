<?php

$txt = file_get_contents('./input.txt');

$array = explode("\n", $txt);


$arrayOne = ["oneight","twone","threeight","fiveight","sevenine","eightwo","eighthree","nineight","one","two","three","four","five","six","seven","eight","nine"];
$array1 = [18,21,38,58,79,82,83,98,1,2,3,4,5,6,7,8,9];


foreach($array as $string) {
   $newString = str_replace($arrayOne, $array1, $string); 
   $arrayBis[] = filter_var($newString, FILTER_SANITIZE_NUMBER_INT);
};

foreach($arrayBis as $number) {
    $arrayFinal[] = $number[0] . $number[strlen($number)-1];
}

echo array_sum($arrayFinal);