<?php

$txt = file_get_contents('./input.txt');

$rows = explode("\n", $txt);

function isValidPosition($row, $col, $rowCount, $colCount)
{
    return $row >= 0 && $row < $rowCount && $col >= 0 && $col < $colCount;
}

$sum = 0;
$rowCount = count($rows);
$colCount = strlen($rows[0]);

for ($row = 0; $row < $rowCount; $row++) {
    for ($col = 0; $col < $colCount; $col++) {
        $char = $rows[$row][$col];


        if ($char !== '.' && !is_numeric($char)) {
            $sequence = '';

            for ($i = -1; $i <= 1; $i++) {
                for ($j = -1; $j <= 1; $j++) {
                    $adjacentRow = $row + $i;
                    $adjacentCol = $col + $j;

                    if (isValidPosition($adjacentRow, $adjacentCol, $rowCount, $colCount)) {
                        $adjacentChar = $rows[$adjacentRow][$adjacentCol];

                        if (is_numeric($adjacentChar)) {
                            $sequence .= $adjacentChar;
                            $rows[$adjacentRow][$adjacentCol] = '.';
                            $k = 1;

                            while (isset($rows[$adjacentRow][$adjacentCol - $k]) && is_numeric($rows[$adjacentRow][$adjacentCol - $k])) {
                                $sequence = $rows[$adjacentRow][$adjacentCol - $k] . $sequence;
                                $rows[$adjacentRow][$adjacentCol - $k] = '.';
                                $k++;
                            }

                            $l = 1;
                            while (isset($rows[$adjacentRow][$adjacentCol + $l]) && is_numeric($rows[$adjacentRow][$adjacentCol + $l])) {
                                $sequence .= $rows[$adjacentRow][$adjacentCol + $l];
                                $rows[$adjacentRow][$adjacentCol + $l] = '.';
                                $l++;
                            }

                            $sum += intval($sequence);
                            $sequence = '';
                        }
                    }
                }
            }
        }
    }
}

echo $sum;
