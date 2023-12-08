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

$arrayStart = [];
foreach($array as $key => $start) {
    
    if($key[2] === "A") {
        $arrayStart[] = $key; 
}
}

$arrayCount = [];
$i = 0;
$nbrInstruction = strlen($instructions);

foreach($arrayStart as $key => $start) {
    $i = 0;
    do{

    $index = $i %$nbrInstruction;
    $direction = $instructions[$index];

    if($direction === "L") {
        $start = $array[$start]['left'];
    } else {
        $start = $array[$start]['right'];
    }

    $i++;
    $arrayCount[$key] = $i;
} while (
    substr($start, -1) !== "Z"
);
}

function pgcd($a, $b) {
    while ($b != 0) {
        $t = $b;
        $b = $a % $b;
        $a = $t;
    }
    return $a;
}

function ppcm($a, $b) {
    if ($a == 0 || $b == 0) {
        return 0;
    }
    
    return abs($a * $b) / pgcd($a, $b);
}

function ppcmArray($numbers) {
    if (count($numbers) < 2) {
        return 0;
    }

    $result = $numbers[0];
    $count = count($numbers);

    for ($i = 1; $i < $count; $i++) {
        $result = ppcm($result, $numbers[$i]);
    }

    return $result;
}

$resultat_ppcm = ppcmArray($arrayCount);

echo $resultat_ppcm;