<?php

$txt = file_get_contents('./input.txt');

$array = explode("\n", $txt);
$gameArray = [];
$finalArray = [];

foreach ($array as $game) {
    $explode = explode(": ", $game);
    $gameArray[] = $explode[1];
}

foreach ($gameArray as $key => $string) {
    $gameArray[$key] = explode("; ", $string);
}

foreach ($gameArray as $index => $combi) {
    foreach ($combi as $sousCombi) {
        $explodeCombi[$index][] = explode(", ", $sousCombi);
    }
}

foreach ($explodeCombi as $ind => $tab1) {
    foreach ($tab1 as $tab2) {
        foreach ($tab2 as $tab3) {
            if (strpos($tab3, "green")) {
                $number = filter_var($tab3, FILTER_SANITIZE_NUMBER_INT);

                if (empty($finalArray[$ind]["green"]) || $number > $finalArray[$ind]["green"]) {
                    $finalArray[$ind]["green"] = intval($number);
                }
            } elseif (strpos($tab3, "red")) {
                $number = filter_var($tab3, FILTER_SANITIZE_NUMBER_INT);

                if (empty($finalArray[$ind]["red"]) || $number > $finalArray[$ind]["red"]) {
                    $finalArray[$ind]["red"] = intval($number);
                }
            } elseif (strpos($tab3, "blue")) {
                $number = filter_var($tab3, FILTER_SANITIZE_NUMBER_INT);

                if (empty($finalArray[$ind]["blue"]) || $number > $finalArray[$ind]["blue"]) {
                    $finalArray[$ind]["blue"] = intval($number);
                }
            }
        }
    }
}

foreach ($finalArray as $color) {
    $arrayNumber[] = $color['green'] * $color['blue'] * $color['red'];
}

echo array_sum($arrayNumber);
