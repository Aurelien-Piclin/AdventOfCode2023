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
        'winningNumber' => $winningNumber
    ];
}

$sum = 0;

foreach ($array as $tirage) {
    $point = 0;
    foreach ($tirage['myNumber'] as $myNum) {
        if (array_search($myNum, $tirage['winningNumber']) !== false) {
            if ($point === 0) {
                $point += 1;
            } else {
                $point *= 2;
            }
        }
    }

    $sum += $point;
}

echo $sum;
