<?php declare(strict_types=1);

$in = rtrim(file_get_contents('input'));
$lines = explode("\n", $in);

$leftSides  = [];
$rightSides = [];

foreach ($lines as $line) {
    $parts = explode('   ', $line);
    $leftSides[]  = (int)$parts[0];
    $rightSides[] = (int)$parts[1];
}

sort($leftSides);
sort($rightSides);

$totalDistance   = 0;
$similarityScore = 0;

// super minor optimization of my n^2 :)
$jl = count($rightSides);
for ($i = 0, $il = count($leftSides); $i < $il; ++$i) {
    $leftSidePart  = $leftSides[$i];
    $rightSidePart = $rightSides[$i];
    $distance = abs($leftSidePart - $rightSidePart);
    $totalDistance += $distance;
    $similarInstances = 0;

    for ($j = 0; $j < $jl; ++$j) {
        $rightSideCand = $rightSides[$j];
        if ($rightSideCand === $leftSidePart) {
            ++$similarInstances;
        }
    }

    $similarityScore += $similarInstances * $leftSidePart;
}

echo 'Solution for part A, the total distance: ' . $totalDistance;
echo "\n";
echo 'Solution for part B, the total similarity score: ' . $similarityScore;
echo "\n";
