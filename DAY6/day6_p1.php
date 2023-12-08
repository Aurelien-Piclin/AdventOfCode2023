<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$explodeRow1 = explode(": ", $rows[0]);
$explodeRow2 = explode(": ", $rows[1]);


$time = explode(" ", $explodeRow1[1]);
$distance =  explode(" ", $explodeRow2[1]);

$numberWay = 1;
foreach($time as $key=>$timeCourse) {

    $distanceToBeat = $distance[$key];
    $possibility = 0;

    for($timeHold=0; $timeHold < $timeCourse; $timeHold++) {

        $timeRestant = $timeCourse - $timeHold;

        $distanceParcouru = $timeRestant * $timeHold;

        if($distanceParcouru > $distanceToBeat) {
            $possibility++;
        }
    }

    $numberWay *= $possibility;
}

echo $numberWay;
