<?php declare(strict_types=1);

$in = file_get_contents('input');
  
$mulPattern = '/mul\(\d+,\d+\)/';

// since 'do' and 'don't' share the same 'do', I just replace these to avoid
// that small trick :)
$in = str_replace('don\'t()', 'ignorethis', $in);
$in = str_replace('do()', 'keepthis', $in);

preg_match_all($mulPattern, $in, $matches);

$sumPartA = 0;
$sumPartB = 0;

foreach($matches[0] as $match) {
    // there are no duplicate exact mul instructions, so we exploit this fact
    $splitMain = explode($match, $in);

    $posDont = strrpos($splitMain[0], 'ignorethis');
    $posDo = strrpos($splitMain[0], 'keepthis');

    $numbers = explode(',', $match);
    $numbers[1] = rtrim($numbers[1], ')');
    $numbers[0] = substr($numbers[0], 4);
    $numbers[1] = (int)$numbers[1];
    $numbers[0] = (int)$numbers[0];
    $mult = $numbers[0] * $numbers[1];

    $sumPartA += $mult;

    if ($posDont === false) {
        $sumPartB += $mult;
        continue;
    }

    if ($posDo > $posDont) {
        $sumPartB += $mult;
        continue;
    }
}

echo 'Solution for the part A of the problem is: ' . $sumPartA;
echo "\n";
echo 'Solution for the part B of the problem is: ' . $sumPartB;
echo "\n";
