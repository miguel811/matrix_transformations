<?php

/*
 * Complete the 'matrixRotation' function below.
 *
 * The function accepts following parameters:
 *  1. 2D_INTEGER_ARRAY matrix
 *  2. INTEGER r
 */
 
 function display($m)
 {
     foreach($m as $row) {
         echo implode(" ", $row). "\n";
     }
 }
 
 function matrixRotation($matrix, $r)
 {
    $nextMatrix = [];
    $height = count($matrix);
    $width = count($matrix[0]);
    
    $x = 0;
    $y = 0;
    
    $row = array_fill(0, $width, "|");
    $nextMatrix = array_fill(0, $height, $row);
    $nextMatrix = $matrix;
    // Lets try the squares
    // Outer square
    $square = 0;
    $n = $height;
    if ($width < $height) {
        $n = $width;
    }
    for($square = 0; $square < $n / 2; $square++)
    {
        $sqWidth = $width - $square*2;
        $sqHeight = $height - $square*2;
        $squareRotations = calcSquareRotations($sqWidth, $sqHeight, $r);
        // echo "Square rotations $squareRotations = $width, $height, $r\n";
        while($squareRotations > 0) {
            $nextMatrix = rotateSquare($nextMatrix, $square);
            $squareRotations--;
        }
    }
    return $nextMatrix;
 }

function rotateSquare($matrix, $square)
{
    $height = count($matrix);
    $width = count($matrix[0]);
    // LEFT ?
    $x = $square;
    $y = $square;
    $stepsCount = $height - $square * 2 - 1;

    $nextMatrix = $matrix;
    //$nextMatrix[$y][$x] = $matrix[$y][$x];

    if ($stepsCount) {
        $nextMatrix[$y][$x] = $matrix[$y][$x + 1];
    }

    while($stepsCount > 0) {
        $nextMatrix[$y + $stepsCount][$x] = $matrix[$y + $stepsCount - 1][$x];
        $stepsCount--;
    }
    // RIGHT ?
    $x = $width - 1 - $square;
    $y = $height - 1 - $square ;
    $stepsCount = $height - $square * 2 - 1;

    if ($stepsCount)
    $nextMatrix[$y][$x] = $matrix[$y][$x - 1];
    while($stepsCount > 0) {
        $nextMatrix[$y - $stepsCount][$x] = $matrix[$y - $stepsCount + 1][$x];
        $stepsCount--;
    }
    // TOP ?
    $x = $width - 1 - $square;
    $y = $square ;
    $stepsCount = $width - $square * 2 - 1;

    if ($stepsCount)
    $nextMatrix[$y][$x] = $matrix[$y + 1][$x];

    while($stepsCount > 0) {
        $nextMatrix[$y][$x - $stepsCount] = $matrix[$y][$x - $stepsCount + 1];
        $stepsCount--;
    }
    // BOTTOM ?
    $x = $square;
    $y = $height - 1 - $square ;
    $stepsCount = $width - $square * 2 - 1;

    if ($stepsCount)
    $nextMatrix[$y][$x] = $matrix[$y - 1][$x];

    while($stepsCount > 0) {
        $nextMatrix[$y][$x + $stepsCount] = $matrix[$y][$x + $stepsCount - 1];
        $stepsCount--;
    }

    return $nextMatrix;
}

function calcFullRotation($width, $height) 
{
    return ($height - 1) * 2 + ($width - 1) * 2;
}

function calcSquareRotations($width, $height, $r)
{
    $fullRotation = calcFullRotation($width, $height);
    // echo "$r % $fullRotation  ($width, $height)\n";
    if ($fullRotation) {
        return $r % $fullRotation;
    }
    return 0;
}

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$m = intval($first_multiple_input[0]);

$n = intval($first_multiple_input[1]);

$r = intval($first_multiple_input[2]);

$matrix = array();


for ($i = 0; $i < $m; $i++) {
    $matrix_temp = rtrim(fgets(STDIN));

    $matrix[] = array_map('intval', preg_split('/ /', $matrix_temp, -1, PREG_SPLIT_NO_EMPTY));
}

// $matrix = [];
// $matrix[] = [1, 2, 3, 15];
// $matrix[] = [4, 5, 6, 16];
// $matrix[] = [7, 8, 9, 10];
// $matrix[] = [11,12,13,14];

// $matrix = [];
// $matrix[] = [1, 2, 3, 15, 17];
// $matrix[] = [4, 5, 6, 16, 18];
// $matrix[] = [7, 8, 9, 10, 19];
// $matrix[] = [11,12,13,14, 20];
// $matrix[] = [21,22,23,24, 25];

// $matrix = [];
// $matrix[] = [1,2,3];
// $matrix[] = [4,5,6];
// $matrix[] = [7,8,9];

// display($matrix);
// $matrix = rotateMatrix($matrix);
// echo "|||||||||||||||||\n";
// display($matrix);
// $matrix = rotateMatrix($matrix);
// echo "|||||||||||||||||\n";
// display($matrix);
// $matrix = rotateMatrix($matrix);
// echo "|||||||||||||||||\n";
// display($matrix);
// $matrix = rotateMatrix($matrix);
// echo "|||||||||||||||||\n";

$matrix = matrixRotation($matrix, $r);
display($matrix);
