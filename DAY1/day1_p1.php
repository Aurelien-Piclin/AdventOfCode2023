<?php

$txt = file_get_contents('./input.txt');

$array = explode("\n", $txt);

foreach($array as $string) {
   $arrayBis[] = filter_var($string, FILTER_SANITIZE_NUMBER_INT);
};

foreach($arrayBis as $number) {
    $arrayFinal[] = $number[0] . $number[strlen($number)-1];
}

echo array_sum($arrayFinal);