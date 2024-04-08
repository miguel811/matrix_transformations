<?php

/*
 * The function accepts following parameters:
 *  1. 2D ARRAY matrix
 *  2. INTEGER r
 */
function rotate($matrix, $r) {
    
    while($r > 0) {
        $r--;
        $matrix = leftRotateMatrix($matrix);
    }
    display($matrix);
}

 function display($m)
 {
     foreach($m as $row) {
         echo implode(" ", $row). "\n";
     }
 }
 
 function leftRotateMatrix($matrix)
 {
    $nextMatrix = [];
    $height = count($matrix);
    $width = count($matrix[0]);
    
    $x = 0;
    $y = 0;
    
    $row = array_fill(0, $width, "|");
    $nextMatrix = array_fill(0, $height, $row);
    // Lets try the squares
    // Outer square
    $square = 0;
    $n = $height;
    if ($width < $height) {
        $n = $width;
    }
    for($square = 0; $square < $n / 2; $square++)
    {
        // LEFT ?
        $x = $square;
        $y = $square;
        $stepsCount = $height - $square * 2 - 1;
        $nextMatrix[$y][$x] = $matrix[$y][$x + 1];
        while($stepsCount > 0) {
            $nextMatrix[$y + $stepsCount][$x] = $matrix[$y + $stepsCount - 1][$x];
            $stepsCount--;
        }
        // RIGHT ?
        $x = $width - 1 - $square;
        $y = $height - 1 - $square ;
        $stepsCount = $height - $square * 2 - 1;
        $nextMatrix[$y][$x] = $matrix[$y][$x - 1];
        while($stepsCount > 0) {
            $nextMatrix[$y - $stepsCount][$x] = $matrix[$y - $stepsCount + 1][$x];
            $stepsCount--;
        }
        // TOP ?
        $x = $width - 1 - $square;
        $y = $square ;
        $stepsCount = $width - $square * 2 - 1;
        $nextMatrix[$y][$x] = $matrix[$y + 1][$x];
        while($stepsCount > 0) {
            $nextMatrix[$y][$x - $stepsCount] = $matrix[$y][$x - $stepsCount + 1];
            $stepsCount--;
        }
        // BOTTOM ?
        $x = $square;
        $y = $height - 1 - $square ;
        $stepsCount = $width - $square * 2 - 1;
        $nextMatrix[$y][$x] = $matrix[$y - 1][$x];
        while($stepsCount > 0) {
            $nextMatrix[$y][$x + $stepsCount] = $matrix[$y][$x + $stepsCount - 1];
            $stepsCount--;
        }
    }
    return $nextMatrix;
 }


