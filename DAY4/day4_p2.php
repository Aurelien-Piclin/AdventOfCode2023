<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$array = [];

foreach ($rows as $row) {
    $data = explode(": ", $row);

    $game = explode(" | ", $data[1]);

    $myNumber = explode(" ", $game[0]);

    foreach ($myNumber as $key => $number) {
        if ($number == '') {
            unset($myNumber[$key]);
        }
    }

    $winningNumber = explode(" ", $game[1]);

    foreach ($winningNumber as $index => $numberW) {
        if ($numberW == '') {
            unset($winningNumber[$index]);
        }
    }

    $array[] = [
        'myNumber' => $myNumber,
        'winningNumber' => $winningNumber,
        'nbrExemplaire' => 1
    ];
}

$sum = 0;

foreach ($array as $key => $tirage) {
    $numberMatching = 0;
    foreach ($tirage['myNumber'] as $myNum) {
        if (array_search($myNum, $tirage['winningNumber']) !== false) {
            $numberMatching += 1;
        }
    }

    for ($i = $key + 1; $i <= $key + $numberMatching; $i++) {
        $array[$i]['nbrExemplaire'] += 1 * $array[$key]['nbrExemplaire'];
    }
}

foreach ($array as $numberExemplary) {
    $sum += $numberExemplary['nbrExemplaire'];
}

echo $sum;
