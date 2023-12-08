<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$hands = [];
foreach($rows as $row) {
    $hands[] = explode(" ", $row);
}

foreach($hands as $key=>$hand){
    for($i=0; $i<5;$i++) {
        $caractere = $hand[0][$i];
        if(isset($hands[$key][$caractere])) {
            $hands[$key][$caractere] += 1;
        } else {
            $hands[$key][$caractere] = 1;
        }
    }
}

$newHands = [];
foreach($hands as $key=>$hand) {
    $count = (count($hand) - 2);

    switch($count) {
        case 1:
            $force = 7;
            break;
        case 2:
            if($hand[$hand[0][2]] == 2 || $hand[$hand[0][2]] == 3 ) {
                $force = 5;
            } else {
                $force = 6;
            }
            break;
        case 3:
            if($hand[$hand[0][2]] == 3 ||  $hand[$hand[0][3]] == 3 || $hand[$hand[0][4]] == 3) {
                $force = 4;
            } else {
                $force = 3;
            }
            break;
        case 4 : 
            $force = 2;
            break;
        case 5 :
            $force = 1;
            break;       
    }

   
    $newHands[$force][] = $hand;
}


function comparerFirstCard($firstArray, $secondArray) {

    $a = $firstArray[0][0];
    $b = $secondArray[0][0];

    if($a === $b) {
        $a = $firstArray[0][1];
        $b = $secondArray[0][1];
    }

    if($a === $b) {
        $a = $firstArray[0][2];
        $b = $secondArray[0][2];
    }

    if($a === $b) {
        $a = $firstArray[0][3];
        $b = $secondArray[0][3];
    }

    if($a === $b) {
        $a = $firstArray[0][4];
        $b = $secondArray[0][4];
    }

    if($a === "T"){
        $a = 10;
    } elseif($a === "J") {
        $a = 11;
    } elseif( $a === "Q") {
        $a = 12;
    } elseif( $a === "K") {
        $a = 13;
    } elseif( $a === "A") {
        $a = 14;
    }


    if($b === "T"){
        $b = 10;
    } elseif($b === "J") {
        $b = 11;
    } elseif( $b === "Q") {
        $b = 12;
    } elseif( $b === "K") {
        $b = 13;
    } elseif( $b === "A") {
        $b = 14;
    }

    return $a - $b;
}

for($j=1; $j <=7; $j++) {
    usort($newHands[$j], 'comparerFirstCard');
}

$total = 0;
$rank = 1;
for($j=1; $j <=7; $j++) {
    foreach($newHands[$j] as $newHand) {
        $total += ($rank * $newHand[1]);
        $rank++;
    }
}

echo $total;
