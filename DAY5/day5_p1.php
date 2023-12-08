<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

$firstArray = [];
$i = 0;
foreach($rows as $row) {
    if($row === '') {
        $i++;
    } else {
        $firstArray[$i][] = $row;
    }
    
}

$secondArray = [];
foreach($firstArray as $key=>$bloc) {
    foreach($bloc as $index=>$line) {
        if($key === 0) {
            $explode = explode(': ', $line);
            $secondArray[$explode[0]] = $explode[1];
        } else {
            if($index === 0) {
                $explode = explode(':', $line);
                $name = $explode[0];
                $secondArray[$name] = [];
                
            } else {
                $secondArray[$name][] = $line;
            }
        }
    }
}

$thirdArray = [];
foreach($secondArray as $key => $bloc) {
    if($key === 'seeds') {
       
        $explode = explode(' ', $bloc);
        $thirdArray[$key] = $explode;
    } else {
        foreach($bloc as $index => $line) {
            $explode = explode(' ', $line);
            $thirdArray[$key][$index] = $explode;
        }
    }
}

function getDestination($entry, $array) {
    if($entry >= $array[1] && $entry <= ($array[1] + $array[2]) ) {

        $delta = $entry - $array[1];

        $destination = $array[0] + $delta;
    }

    return !empty($destination) ? $destination : false;
}


// ================== SEED TO SOIL ============ //
foreach($thirdArray['seeds'] as $key=>$seed) {
    
foreach($thirdArray['seed-to-soil map'] as $seedToSoil) {

    $destination = getDestination($seed, $seedToSoil);
    
    if($destination !== false) {
        break;
    } else {
        $destination = $seed;
    }
    }

    $finalArray['seedToSoil'][] = intval($destination);
}

// =================== SOIL TO FERTILIZER ========= //

foreach($finalArray['seedToSoil'] as $key=>$soil) {
    
    foreach($thirdArray['soil-to-fertilizer map'] as $soilToFertilizer) {
    
        $destination = getDestination($soil, $soilToFertilizer);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $soil;
        }
        }
    
        $finalArray['soilToFertilizer'][] = intval($destination);
    }

// =================== FERTILIZER TO WATER ========= //

foreach($finalArray['soilToFertilizer'] as $key=>$fertilizer) {
    
    foreach($thirdArray['fertilizer-to-water map'] as $fertilizerToWater) {
    
        $destination = getDestination($fertilizer, $fertilizerToWater);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $fertilizer;
        }
        }
    
        $finalArray['fertilizerToWater'][] = intval($destination);
    }


// =================== WATER TO LIGHT ========= //

foreach($finalArray['fertilizerToWater'] as $key=>$water) {
    
    foreach($thirdArray['water-to-light map'] as $waterToLight) {
    
        $destination = getDestination($water, $waterToLight);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $water;
        }
        }
    
        $finalArray['waterToLight'][] = intval($destination);
    }

// =================== LIGHT TO TEMPERATURE ========= //

foreach($finalArray['waterToLight'] as $key=>$light) {
    
    foreach($thirdArray['light-to-temperature map'] as $lightToTemp) {
    
        $destination = getDestination($light,  $lightToTemp);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $light;
        }
        }
    
        $finalArray['lightToTemperature'][] = intval($destination);
    }

// =================== TEMPERATURE TO HUMIDITY ========= //

foreach($finalArray['lightToTemperature'] as $key=>$temp) {
    
    foreach($thirdArray['temperature-to-humidity map'] as $tempToHumidity) {
    
        $destination = getDestination($temp, $tempToHumidity);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $temp;
        }
        }
    
        $finalArray['temperatureToHumidity'][] = intval($destination);
    }

// =================== HUMIDITY TO LOCATION ========= //

foreach($finalArray['temperatureToHumidity'] as $key=>$humidity) {
    
    foreach($thirdArray['humidity-to-location map'] as $humidityToLocation) {
    
        $destination = getDestination($humidity, $humidityToLocation);
        
        if($destination !== false) {
            break;
        } else {
            $destination = $humidity;
        }
        }
    
        $finalArray['humidityToLocation'][] = intval($destination);
    }

echo min($finalArray['humidityToLocation']);