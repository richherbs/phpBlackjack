<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="get">
    <label for="fencePosts">Fence Posts: enter the number of fence posts</label>
    <input type="text" id="fencePosts" name="fencePosts">
    <label for="railings">Railings: enter the number of railings</label>
    <input type="text" id="railings" name="railings">
    <label for="lengthOfFence">Length of Fence: enter the required length of fence</label>
    <input type="text" id="lengthOfFence" name="lengthOfFence">
    <button type="submit">Calculate</button>
</form>
<a href="index.php">
    Home
</a>
<?php

$lengthOfFence = $_GET['lengthOfFence'];
$numPanels = 0;
$numRails = 0;

if(!empty($lengthOfFence)){
    echo $lengthOfFence * 1.7;
    echo $lengthOfFence * 0.85 - 1;
}
?>
</body>
</html>