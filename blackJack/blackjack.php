<?php

function dealCard(array &$aDeck) {
    //pick a random suit
    $aSuit = array_rand($aDeck);

    //pick a random card from the suit choose its name
    $aCardKey = array_rand($aDeck[$aSuit]);
    //find the card value using the cardName
    $aCardValue = $aDeck[$aSuit][$aCardKey];

    return ['suit' => $aSuit,'value' => $aCardValue, 'name' => $aCardKey];
}

function totalHand (array $aPlayer) : int {
    $aPlayersTotalScore = 0;

    //get value of all cards in hand
    foreach ($aPlayer['cards'] as $aCardInTheHand) {
        $aPlayersTotalScore += $aCardInTheHand['value'];
    }

    //incorporate that an ace may be 1 or 11 if ace causes bust
    if(in_array('Ace', $aPlayer['cards']) and $aPlayer['score'] > 21){
        $aPlayersTotalScore -= 10;
    }

    return $aPlayersTotalScore;
}

function shouldIKeepPlaying(array $aPlayer) : bool {
    return $aPlayer['score'] <= 16;
}

function makeWinningMessage (array $aPlayer) : string {
    $winningMessage = '';

    foreach ($aPlayer['cards']as $aCard){
        if(is_array($aCard)){
            $winningMessage = $winningMessage . ' ' . $aCard['name'] . ' of ' . $aCard['suit'] . '<br>';
        } else {
            $winningMessage = $winningMessage . ' ' . $aCard['name'] . ' of ' . $aCard['suit'] . '<br>';
        }
    }

    $winningMessage = $winningMessage . '<br><br>' . 'Score is: ' . $aPlayer['score'] . '<br>';


    return $winningMessage;
}

function aceInHand($aPlayer){
    $playersHand = $aPlayer['cards'];
    $aceInHand = false;
    foreach ($playersHand as $cardInHand){
        if($cardInHand['name'] == 'Ace' and count($playersHand) <= 2){
            $aceInHand = true;
        }

    }
    return $aceInHand;
}

function royalInHand ($aPlayer){
    $playersHand = $aPlayer['cards'];
    $royalInHand = false;
    foreach ($playersHand as $cardInHand){
        if($cardInHand['name'] == 'King' or $cardInHand['name'] == 'Queen' or $cardInHand['name'] == 'Jack') $royalInHand = true;
    }

    return $royalInHand;
}

function andTheWinnerIs(array $somePlayers) : string
{
    $winningMessage = '';

    foreach ($somePlayers as $eachPlayer){
        $playerScore = $eachPlayer['score'];
        $playerName = $eachPlayer['name'];
        $lineBreak = '<br>'

        $winningMessage .= "$playerName has: $lineBreak";
        $winningMessage .= makeWinningMessage($eachPlayer);
        $winningMessage .= $lineBreak . $lineBreak;
    }

    //create logic for game win states with up to 7 players...
    if($playerScore > 21 and $houseScore > 21){
        $winningMessage .= 'Both bust...';
    } elseif ($houseScore > 21){
        $winningMessage .= 'Player Wins!!!!';
    } elseif ($playerScore > 21){
        $winningMessage .= 'House wins :-(';
    } elseif (aceInHand($aPlayer) and royalInHand($aPlayer) and aceInHand($anotherPlayer) and royalInHand($anotherPlayer)){
        $winningMessage .= 'Both got BLACKJACK WOOOOAHHHH!!!';
    } elseif (aceInHand($aPlayer) and royalInHand($aPlayer)){
        $winningMessage .= 'Player got BLACKJACK!!! Player wins!!!!!';
    } elseif (aceInHand($anotherPlayer) and royalInHand($anotherPlayer)){
        $winningMessage .= 'House got BLACKJACK! House wins!!!! :-(';
    } elseif ($playerScore == $houseScore){
        $winningMessage .= "It\'s a draw";
    } elseif ($playerScore > $houseScore){
        $winningMessage .= 'Player wins!!!!! Well done.';
    } else {
        $winningMessage .= 'Sadly the house wins :-(';
    }

    return $winningMessage;
}

function playBlackjack () {
    $deck = [
        'hearts' => [2 => 2, 3 => 3, 4 => 4, 5 =>5, 6 =>6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,'Jack' => 10 ,'Queen' => 10,'King' =>10,'Ace' =>11],
        'diamonds' => [2 => 2, 3 => 3, 4 => 4, 5 =>5, 6 =>6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,'Jack' => 10 ,'Queen' => 10,'King' =>10,'Ace' =>11],
        'clubs' => [2 => 2, 3 => 3, 4 => 4, 5 =>5, 6 =>6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,'Jack' => 10 ,'Queen' => 10,'King' =>10,'Ace' =>11],
        'spades' => [2 => 2, 3 => 3, 4 => 4, 5 =>5, 6 =>6, 7 => 7, 8 => 8, 9 => 9, 10 => 10,'Jack' => 10 ,'Queen' => 10,'King' =>10,'Ace' =>11],
    ];

    $players = ['player 1' =>['keepPlaying' => true, 'name' => 'Player 1'],
        'player 2' => ['keepPlaying' => true, 'name' => 'player 2'],
        'house' => ['keepPlaying' => true, 'name' => 'house'] ];


    while(true) {

        foreach ($players as $eachPlayer){
            //deal card -> player
            $eachPlayer['cards'][] = dealCard($deck);
            //deal card -> player
            $eachPlayer['cards'][]= dealCard($deck);
            //total player hand
            $eachPlayer['score'] = totalHand($eachPlayer);
            //check if hand over 16 and stop
            shouldIKeepPlaying($eachPlayer);

            while($eachPlayer['keepPlaying']){
                //deal a card
                $eachPlayer['cards'][]= dealCard($deck);
                //total player hand
                $eachPlayer['score'] = totalHand($eachPlayer);
                shouldIKeepPlaying($eachPlayer);
            }
        }

        echo andTheWinnerIs($players);
//        //play again?
//        if (playAgain()) {
//            continue;
//        }
    break;
    }
}

playBlackjack();