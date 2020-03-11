<a href="index.php">
    Home
</a>
<?php

function printArray($anArray) {
    $preHTML = '<pre>';
    foreach ($anArray as $key=>$anElement){
        if(gettype($anElement) == 'array'){
            echo $preHTML;
            echo $key;
            echo $preHTML;
            printArray($anElement);
        } else {
            echo $preHTML;
            echo $anElement;
            echo $preHTML;
        }
    }
}



function printOdd($anArray){
    $preHTML = '<pre>';

    foreach ($anArray as $aNum){
        if ($aNum % 2 == 0){
            echo $preHTML;
            echo $aNum;
            echo $preHTML;
        } else {
            echo $preHTML;
            echo "$aNum is not even!";
            echo $preHTML;
        }
    }
}

$numArray = [1,2,3,4,5,6,7,8];

echo 'Array before alteration: <br/>';
printArray($numArray);

$numArray[] = 9;
echo 'Array after new append method alteration: <br/>';
printArray($numArray);

array_push($numArray, 10);
echo 'Array after old append method alteration: <br/>';
printArray($numArray);

shuffle($numArray);
echo 'Array after shuffling: <br/>';
printArray($numArray);

echo 'Odd values from the array: <br/>';
printOdd($numArray);

$monthsAndWeeks = ['January'=>[1,2,3,4], 'February'=>[1,2,3,4], 'March'=>[1,2,3,4], 'April'=>[1,2,3,4], 'May'=>[1,2,3,4]];

echo 'Printing a multi-dimensional array: ';
printArray($monthsAndWeeks);