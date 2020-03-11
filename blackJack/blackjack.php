<?php

function shufflePack (array $aDeck) : array {
    //for each suit in a deck
    foreach($aDeck as $aSuit => $suitCards){
        //randomise the cards in a suit
        shuffle($suitCards);
        $aDeck[$aSuit] = $suitCards;
    }

    return $aDeck;
}

function dealCard(array &$aDeck) {
    //pick a random suit
    $aSuit = array_rand($aDeck);
    //pick a random card from the suit
    $aCard = [$aSuit, array_pop($aDeck[$aSuit])];

    return $aCard;
}

function totalHand (array $aPlayer) : int {
    $aPlayersTotalScore = 0;
    //get value of all cards in hand
    foreach ($aPlayer['cards'] as $cardInHand) {
        if(is_int($cardInHand[1])){
            $aPlayersTotalScore += $cardInHand[1];
        } elseif ($cardInHand[1] == 'Ace') {
            $aPlayersTotalScore += 11;
        } else {
            $aPlayersTotalScore += 10;
        }
    }
    return $aPlayersTotalScore;
}

function checkBust(array $aPlayer) : bool {
    return $aPlayer[2] > 21;
}

function makeWinningMessage (array $aPlayer) : string {
    $winningMessage = '';

    foreach ($aPlayer['cards']as $aCard){
        if(is_array($aCard)){
            $winningMessage = $winningMessage . ' ' . $aCard[1] . ' of ' . $aCard[0] . '<br>';
        } else {
            $winningMessage = $winningMessage . ' ' . $aCard[1] . ' of ' . $aCard[0] . '<br>';
        }
    }


    return $winningMessage;
}

function andTheWinnerIs(array $aPlayer, array $anotherPlayer) : string {
    $winningMessage = 'Player 1 Has: <br>';

    $winningMessage = $winningMessage . makeWinningMessage($aPlayer);

    $winningMessage = $winningMessage . '<br> <br>The House has: <br>';

    $winningMessage = $winningMessage . makeWinningMessage($anotherPlayer);

    $winningMessage = $winningMessage . '<br><br>';

    if ($aPlayer[2] > $anotherPlayer[2] and $aPlayer[2] <= 21) {
        $winningMessage = $winningMessage . 'PLAYER WINS!!!!!';
    } elseif ($aPlayer[2] < $anotherPlayer[2] and $anotherPlayer[2] <= 21) {
        $winningMessage = $winningMessage . "Sorry the house wins :-(";
    } elseif ($aPlayer[2] == $anotherPlayer[2]) {
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
        'hearts' => [2,3,4,5,6,7,8,9,10,'Jack','Queen','King','Ace'],
        'diamonds' => [2,3,4,5,6,7,8,9,10,'Jack','Queen','King','Ace'],
        'clubs' => [2,3,4,5,6,7,8,9,10,'Jack','Queen','King','Ace'],
        'spades' => [2,3,4,5,6,7,8,9,10,'Jack','Queen','King','Ace'],
    ];

    $player = [];

    $house = [];

    while(true) {
        //shuffle pack
        $deck = shufflePack($deck);
        //deal card -> player
        $player['cards'][] = dealCard($deck);
        //deal card -> player
        $player['cards'][]= dealCard($deck);
        //total player hand
        $player[2] = totalHand($player);
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
        $house[2] = totalHand($house);

        //check if bust -> house
        if (checkBust($house)){
            echo andTheWinnerIs($player ,$house);
            break;
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