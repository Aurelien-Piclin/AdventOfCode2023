<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$explodeRow1 = explode(": ", $rows[0]);
$explodeRow2 = explode(": ", $rows[1]);


$time = explode(" ", $explodeRow1[1]);
$distance =  explode(" ", $explodeRow2[1]);


$distanceToBeat = intval($distance[0] . $distance[1] . $distance[2] . $distance[3]);
$timeCourse = intval($time[0] . $time[1] . $time[2] . $time[3]);
$possibility = 0;

for($timeHold=0; $timeHold < $timeCourse; $timeHold++) {

        $timeRestant = $timeCourse - $timeHold;

        $distanceParcouru = $timeRestant * $timeHold;

        if($distanceParcouru > $distanceToBeat) {
            $possibility++;
        }
    }

echo $possibility;
