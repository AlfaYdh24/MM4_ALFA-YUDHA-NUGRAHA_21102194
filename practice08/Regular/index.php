<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Example 1: Basic pattern matching
$pattern = '/hello/';
$string = 'Hello, World!';

if (preg_match($pattern, $string)) {
    echo "Pattern found in the string.<br>";
} else {
    echo "Pattern not found in the string.<br>";
}

// Example 2: Extracting matches
$pattern = '/^(\w+)\s(\w+)$/';
$string = 'John Doe';

if (preg_match($pattern, $string, $matches)) {
    echo "First Name: " . $matches[1] . "<br>";
    echo "Last Name: " . $matches[2] . "<br>";
} else {
    echo "Pattern did not match the expected format.<br>";
}

// Example 3: Replacement using regex
$pattern = '/\d{4}/';
$string = 'The year is 2022.';

$replacement = '2023';
$newString = preg_replace($pattern, $replacement, $string);

echo "Original String: $string <br>";
echo "New String: $newString <br>";
?>

</body>
</html>
