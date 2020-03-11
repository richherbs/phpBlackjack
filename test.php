<a href="index.php">
    Home
</a>
<?php

$myRandomNum = rand(1, 2);

echo ($myRandomNum % 2 == 0) ? 'Heads!' : 'Tales';

if($myRandomNum % 2 == 0){
    echo 'Heads!';
} else {
    echo 'Tales!';
}

