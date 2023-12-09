<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);


foreach($rows as $row) {
    $listes[][0] = explode(" ", $row);
} 

function allNotEqual($array) {
    $value = $array[0];
    foreach($array as $number) {
        if($number !== $value) {
            return true;
        }
    }
    return false;
}


$sum = 0;
foreach($listes as $index => $liste) {
    $i = 0;

    while(allNotEqual($liste[$i])) {
            $j = $i;
            $i++;
                foreach($liste[$j] as $key => $number) {
                    if(isset($liste[$j][$key + 1])) {
                        $liste[$i][] = $liste[$j][$key + 1] - $number;
                    }
                }
        }

        $j = $i;
        $i++;
        foreach($liste[$j] as $key => $number) {
            if(isset($liste[$j][$key + 1])) {
                $liste[$i][] = 0;
        }
    }

   for($k=$i; $k > 0; $k--) {

    $count = count($liste[$k]);
    $liste[$k - 1][] = $liste[$k][$count - 1] + $liste[$k - 1][$count - 1];

   }

  $sum += $liste[0][21];
   
}

echo $sum;