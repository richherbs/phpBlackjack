<a href="index.php">
    home
</a>

<?php

/**
 * Multiplies a number by itself, adds number 2 and returns the result
 *
 * @param Int $aNumber takes in an integer
 * @param Int $aSecondNumber takes an integer this is optional
 *
 * @return Int returns the result of multiplying the argument by itself
 */
function multiply (Int $aNumber, Int $aSecondNumber = 0) : Int{
    return $aNumber * $aNumber + $aSecondNumber;
}

$aNumber = 74;
$anotherNumber = 100;

echo '<pre>';
echo multiply($aNumber, $anotherNumber);
echo '<pre>';