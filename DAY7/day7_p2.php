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
            // 5 cards
            $force = 7;
            break;
        case 2:
            if(isset($hand["J"])) {
                // 5 cards
                $force = 7;
            } 
            elseif($hand[$hand[0][2]] == 2 || $hand[$hand[0][2]] == 3 ) {
                // full
                $force = 5;
            } else {
                // 4 cards
                $force = 6;
            }
            break;
        case 3:
            // 3 - 1 - 1
            // 2 - 2 - 1

            if(isset($hand["J"])) {
                $add = $hand["J"];

                if($add === 3 || $add === 2) {
                    //devient un 4 cards
                    $force = 6;
                } else {
                    if($hand[$hand[0][2]] == 3 ||  $hand[$hand[0][3]] == 3 || $hand[$hand[0][4]] == 3) {
                        // devient un 4 cards
                        $force = 6;
                    } else {
                        // full
                        $force = 5;
                    }
                }
                }
            else {
                if($hand[$hand[0][2]] == 3 ||  $hand[$hand[0][3]] == 3 || $hand[$hand[0][4]] == 3) {
                    // 3 cards
                    $force = 4;
                } else {
                    // double pair
                    $force = 3;
                }
            }
            break;
        case 4 :

            if(isset($hand["J"])) {
                // brelan
                $force = 4;
            } else {
                 // pair
            $force = 2;
            }
            break;
        case 5 :
            if(isset($hand["J"])) {
                // paire
                $force = 2;
            } else {
                 //carte Haute
            $force = 1;
            }
            break;       
    }

   
    $newHands[$force][] = $hand;
}


function convertirTete($x) {
    if($x === "T"){
        $x = 10;
    } elseif($x === "J") {
        $x = 1;
    } elseif( $x === "Q") {
        $x = 12;
    } elseif( $x === "K") {
        $x = 13;
    } elseif( $x === "A") {
        $x = 14;
    }

    return $x;
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

    $a = convertirTete($a);
    $b = convertirTete($b);

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
