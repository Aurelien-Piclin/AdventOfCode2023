<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$instructions = $rows[0];

unset($rows[0]);

$array = [];

foreach($rows as $row) {
    if($row !== '') {

        $explode = explode(" = ", $row);

        $explode2 = explode(", ", $explode[1]);

        $array[$explode[0]]['left'] = substr($explode2[0], -3); 
        $array[$explode[0]]['right'] = substr($explode2[1], 0, -1);
    }
}

$start = "AAA";
$i = 0;
$nbrInstruction = strlen($instructions);

do {

    $index = $i %$nbrInstruction;

    $direction = $instructions[$index];

    if($direction === "L") {
        $start = $array[$start]['left'];
    } else {
        $start = $array[$start]['right'];
    }

    $i++;
} while ( $start !== "ZZZ");

echo $i;