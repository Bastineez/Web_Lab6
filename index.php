<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab6</title>
</head>
<body>

<h2>Task 1: Sum of squares of numbers from 1 to n</h2>
<form method="POST">
    <label>Enter a natural number n:</label>
    <input type="number" name="n" required min="1">
    <input type="submit" name="task1" value="Calculate">
</form>

<?php
require 'functions.php';

// Common HTML form generator function
function generateForm($taskName, $fields, $submitLabel) {
    echo "<form method='POST'>";
    foreach ($fields as $label => $name) {
        echo "<label>$label:</label><input type='text' name='$name' required><br>";
    }
    echo "<input type='submit' name='$taskName' value='$submitLabel'>";
    echo "</form><br>";
}

// Render a task header
define("taskHeader", function ($taskNum, $description) {
    echo "<h2>Task $taskNum: $description</h2>";
});

// Task 1
call_user_func(taskHeader, 1, "Sum of squares of numbers from 1 to n");
generateForm('task1', ['Enter a natural number n:' => 'n'], 'Calculate');
if (isset($_POST['task1'])) {
    $n = (int)$_POST['n'];
    list($squares, $sumOfSquares) = calculateSquareSum($n);
    echo "<h3>Squares of numbers from 1 to $n:</h3>" . implode(", ", $squares);
    echo "<h3>Sum of squares:</h3>$sumOfSquares";
}

// Task 2
call_user_func(taskHeader, 2, "Leap Year Check");
generateForm('task2', ['Enter a year:' => 'year'], 'Check');
if (isset($_POST['task2'])) {
    $year = $_POST['year'];
    echo isLeapYear($year) ? "Leap Year" : "Not a Leap Year";
}

// Task 3
call_user_func(taskHeader, 3, "Year Range Check");
generateForm('task3', ['Enter a year:' => 'year'], 'Check');
if (isset($_POST['task3'])) {
    $year = $_POST['year'];
    echo checkYearInRange($year) ? "Year is within range" : "Year is out of range";
}

// Task 4
call_user_func(taskHeader, 4, "Array Operations");
generateForm('task4', ['Enter an index for the function:' => 'index'], 'Execute');
if (isset($_POST['task4'])) {
    $index = (int)$_POST['index'] % 3;
    $array = generateArray(100, 1, 100); // Replace hardcoded logic with reusable function
    echo "Array: " . implode(", ", array_map(fn($i) => $i * getNumberByWord($index), $array));
}

// Task 5
call_user_func(taskHeader, 5, "Traffic Light Color");
generateForm('task5', ['Enter minutes:' => 'minute'], 'Determine');
if (isset($_POST['task5'])) {
    $minute = (int)$_POST['minute'];
    echo $minute % 5 < 3 ? "Signal: green" : "Signal: red";
}

// Task 6
call_user_func(taskHeader, 6, "Abbreviate Full Name");
generateForm('task6', ['Enter full name:' => 'fullname'], 'Abbreviate');
if (isset($_POST['task6'])) {
    $parts = explode(" ", $_POST['fullname']);
    echo "Abbreviation: {$parts[0]} {$parts[1][0]}. {$parts[2][0]}.";
}

// Task 7
call_user_func(taskHeader, 7, "Hours from Degrees");
generateForm('task7', ['Enter degrees:' => 'degrees'], 'Calculate');
if (isset($_POST['task7'])) {
    echo "Hours: " . floor((int)$_POST['degrees'] / 15);
}

// Task 8
call_user_func(taskHeader, 8, "Array Product and Odd Indices");
generateForm('task8', [], 'Execute');
if (isset($_POST['task8'])) {
    $arr = generateArray(20, 1, 100);
    $product = calculateArrayProduct($arr, fn($v, $i) => $v > 0 && $i % 2 === 0);
    $oddIndexes = implode(", ", array_filter($arr, fn($v, $i) => $v > 0 && $i % 2 !== 0, ARRAY_FILTER_USE_BOTH));
    echo "Product: $product<br>Odd indices: $oddIndexes";
}

// Task 9
call_user_func(taskHeader, 9, "Find max and min values, swap them");
generateForm('task9', ['Array size:' => 'size'], 'Execute');
if (isset($_POST['task9'])) {
    $size = (int)$_POST['size'];
    $array = generateArray($size, 1, 100);
    echo "<strong>Array before swap:</strong> " . implode(", ", $array) . "<br>";
    $minIndex = array_search(min($array), $array);
    $maxIndex = array_search(max($array), $array);
    [$array[$minIndex], $array[$maxIndex]] = [$array[$maxIndex], $array[$minIndex]];
    echo "<strong>Array after swap:</strong> " . implode(", ", $array);
}

// Task 10
call_user_func(taskHeader, 10, "Sum of numbers divisible by 5 from 20 to 45");
generateForm('task10', [], 'Execute');
if (isset($_POST['task10'])) {
    $sum = array_sum(array_filter(range(20, 45), fn($n) => $n % 5 === 0));
    echo "<strong>Sum of numbers:</strong> $sum";
}

// Task 11
call_user_func(taskHeader, 11, "Count occurrences of a digit in a number");
generateForm('task11', ['Number:' => 'number', 'Digit to count:' => 'digit'], 'Execute');
if (isset($_POST['task11'])) {
    $number = $_POST['number'];
    $digit = $_POST['digit'];
    echo "Digit '$digit' appears " . substr_count($number, $digit) . " times in number $number.";
}

// Task 12
call_user_func(taskHeader, 12, "Find longest surname among students with the same first name");
generateForm('task12', ["Student's first name:" => 'name'], 'Execute');
if (isset($_POST['task12'])) {
    $students = [
        "Koval" => "Oleg", "Hontcharuk" => "Oleg", "Petrenko" => "Maria",
        "Ivanenko" => "Maria", "Dovzhenko" => "Oleg", "Sydorenko" => "Alexander",
        "Kravets" => "Maria", "Litvinenko" => "Oleg", "Leonov" => "Maria",
        "Shevchenko" => "Oleg"
    ];
    $name = $_POST['name'];
    $longestSurname = array_reduce(array_keys(array_filter($students, fn($n) => $n === $name)), 
        fn($longest, $surname) => strlen($surname) > strlen($longest) ? $surname : $longest, '');
    echo "Longest surname for students with name '$name': $longestSurname";
}

// Task 13
call_user_func(taskHeader, 13, "Sum of numbers in a range divisible by 5");
generateForm('task13', ['Start of range:' => 'start', 'End of range:' => 'end'], 'Execute');
if (isset($_POST['task13'])) {
    $start = (int)$_POST['start'];
    $end = (int)$_POST['end'];
    $sum = array_sum(array_filter(range($start, $end), fn($n) => $n % 5 === 0));
    echo "Sum of numbers divisible by 5 in range [$start, $end]: $sum";
}

// Task 14
call_user_func(taskHeader, 14, "Product of array elements at even indices");
generateForm('task14', ['Array size:' => 'size'], 'Execute');
if (isset($_POST['task14'])) {
    $size = (int)$_POST['size'];
    $array = generateArray($size, -50, 50);
    $product = calculateArrayProduct($array, fn($v, $i) => $v > 0 && $i % 2 === 0);
    echo "<strong>Array:</strong> " . implode(", ", $array) . "<br>";
    echo "Product of elements at even indices: $product";
}

// Task 15
call_user_func(taskHeader, 15, "Swap min and max values in array");
generateForm('task15', ['Array size:' => 'size'], 'Execute');
if (isset($_POST['task15'])) {
    $size = (int)$_POST['size'];
    $array = generateArray($size, -100, 100);
    echo "<strong>Array before swap:</strong> " . implode(", ", $array) . "<br>";
    $minIndex = array_search(min($array), $array);
    $maxIndex = array_search(max($array), $array);
    [$array[$minIndex], $array[$maxIndex]] = [$array[$maxIndex], $array[$minIndex]];
    echo "<strong>Array after swap:</strong> " . implode(", ", $array);
}

// Task 16
call_user_func(taskHeader, 16, "Sum of Series");
generateForm('task16', ['Enter x:' => 'x', 'Enter epsilon:' => 'epsilon', 'Enter max iterations n:' => 'n'], 'Calculate');
if (isset($_POST['task16'])) {
    $x = (float)$_POST['x'];
    $epsilon = (float)$_POST['epsilon'];
    $nMax = (int)$_POST['n'];
    $sum = calculateSeriesSum($x, $epsilon, $nMax);
    echo "<strong>Sum of series:</strong> $sum";
}

// Task 17
call_user_func(taskHeader, 17, "Sum of Series (Alternative Method)");
generateForm('task17', ['Enter x:' => 'x', 'Enter epsilon:' => 'epsilon', 'Enter max iterations n:' => 'n'], 'Calculate');
if (isset($_POST['task17'])) {
    $x = (float)$_POST['x'];
    $epsilon = (float)$_POST['epsilon'];
    $nMax = (int)$_POST['n'];
    $sum = calculateAlternativeSeriesSum($x, $epsilon, $nMax);
    echo "<strong>Sum of series (alternative):</strong> $sum";
}
?>
