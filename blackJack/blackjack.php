<?php

//function shufflePack (array $aDeck) : array {
//    //for each suit in a deck
//    foreach($aDeck as $aSuit => $suitCards){
//        //randomise the cards in a suit
////        shuffle($suitCards);
//        $aDeck[$aSuit] = $suitCards;
//    }
//
//    return $aDeck;
//}

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

function checkBust(array $aPlayer) : bool {
    return $aPlayer['score'] > 21;
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

function andTheWinnerIs(array $aPlayer, array $anotherPlayer) : string {
    $winningMessage = 'Player 1 Has: <br>';

    $winningMessage = $winningMessage . makeWinningMessage($aPlayer);

    $winningMessage = $winningMessage . '<br> <br>The House has: <br>';

    $winningMessage = $winningMessage . makeWinningMessage($anotherPlayer);

    $winningMessage = $winningMessage . '<br><br>';

    if ($aPlayer['score'] > $anotherPlayer['score'] and $aPlayer['score'] <= 21) {
        $winningMessage = $winningMessage . 'PLAYER WINS!!!!!';
    } elseif ($aPlayer['score'] < $anotherPlayer['score'] and $anotherPlayer['score'] <= 21) {
        $winningMessage = $winningMessage . "Sorry the house wins :-(";
    } elseif ($aPlayer['score'] == $anotherPlayer['score']) {
        $winningMessage = $winningMessage . 'It\' a draw...';
    } elseif ($aPlayer > 21){
        $winningMessage = $winningMessage . 'Sorry house wins. Player is bust.';
    } elseif ($anotherPlayer > 21){
        $winningMessage = $winningMessage . 'Player wins! House is bust.';
    } else {
        $winningMessage = $winningMessage . 'Unlucky both bust.';
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

    $player = [];

    $house = [];

    while(true) {
        //deal card -> player
        $player['cards'][] = dealCard($deck);
        //deal card -> player
        $player['cards'][]= dealCard($deck);
        //total player hand
        $player['score'] = totalHand($player);

        //check if player busts
        if(checkBust($player)){
            echo andTheWinnerIs($player, $house);
            break;
        }
        //deal card -> house
        $house['cards'][] = dealCard($deck);
        //deal card -> house
        $house['cards'][] = dealCard($deck);
        //total hand -> house
        $house['score'] = totalHand($house);

        //check if bust -> house
        if (checkBust($house)){
            echo andTheWinnerIs($player ,$house);
            break;
        }
        while($player['score'] <= 16 and $house['score'] <= 16){
            $player['cards'][] = dealCard($deck);
            $house['cards'][] = dealCard($deck);
            $player['score'] = totalHand($player);
            $house['score'] = totalHand($house);
        }
        echo andTheWinnerIs($player, $house);
//        //play again?
//        if (playAgain()) {
//            continue;
//        }
    break;
    }
}

playBlackjack();