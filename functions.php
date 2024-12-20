<?php

function calculateSquareSum($n) {
    $squares = [];
    $sumOfSquares = 0;
    for ($i = 1; $i <= $n; $i++) {
        $square = $i * $i;
        $squares[] = $square;
        $sumOfSquares += $square;
    }
    return [$squares, $sumOfSquares];
}

function isLeapYear($year) {
    return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
}

function checkYearInRange($year) {
    return ($year >= 0 && $year <= 9999);
}

function getNumberByWord($word) {
    global $assocArray;
    return $assocArray[$word] ?? 0;
}

function calculateArrayProduct($array, $conditionFn) {
    return array_product(array_filter($array, $conditionFn, ARRAY_FILTER_USE_BOTH));
}

function swapArrayMinMax(&$array) {
    $minIndex = array_search(min($array), $array);
    $maxIndex = array_search(max($array), $array);
    list($array[$minIndex], $array[$maxIndex]) = [$array[$maxIndex], $array[$minIndex]];
}

function generateArray($length, $min = 0, $max = 100) {
	$array = [];
	for ($i = 0; $i < $length; $i++) {
			$array[] = rand($min, $max);
	}
	return $array;
}

function calculateSeriesSum($x, $epsilon, $nMax) {
	$sum = 0;
	$term = $x;
	for ($n = 0; $n < $nMax && abs($term) >= $epsilon; $n++) {
			$sum += $term;
			$term *= -$x * $x / ($n * ($n + 1));
	}
	return $sum;
}

function calculateAlternativeSeriesSum($x, $epsilon, $nMax) {
	$sum = 0;
	$term = $x / 2; // Start with x/2 for the Taylor series expansion
	$n = 0;
	while (abs($term) >= $epsilon && $n < $nMax) {
			$sum += $term;
			$n++;
			$term *= -($x * $x) / (2 * $n * ($n + 1));
	}
	return $sum;
}

