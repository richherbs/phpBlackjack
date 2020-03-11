<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heads and Tales Game</title>
</head>
<body>
    <a href="index.php">
        Home
    </a>
    <form name="guessForm" method="get">
        <select id="guess" name="guess">
            <option value="heads">HEADS</option>
            <option value="tales">TALES</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php
    if(!empty($_GET['guess'])){
        $myRandomNum = rand(1, 2);
        $guess = strtolower($_GET['guess']);

        $convertRandNum = ($myRandomNum % 2 == 0) ? 'heads':'tales';

        if(strcmp($guess, $convertRandNum)){
            echo "You guessed $guess: YOU WIN!";
        } else {
            echo "You guessed $guess: YOU LOSER! LOSER...";
        }
    }
    ?>
</body>
</html>