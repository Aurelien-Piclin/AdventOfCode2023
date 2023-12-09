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
    $value = $liste[$k - 1][0] - $liste[$k][0];
    array_unshift($liste[$k - 1], $value);
   }

  $sum += $liste[0][0];
   
}

echo $sum;