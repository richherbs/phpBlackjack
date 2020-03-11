<?php

function shufflePack (array $aDeck) : array {
    //for each suit in a deck
    foreach($aDeck as $aSuit){
        //randomise the cards in a suit
        shuffle($aDeck[$aSuit]);
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
    foreach ($aPlayer as $cardInHand) {
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
    return $aPlayer[2] <= 21;
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
        $player[] = dealCard($deck);
        //deal card -> player
        $player[] = dealCard($deck);
        //deal card -> house
        $house[] = dealCard($deck);
        //deal card -> house
        $player[] = dealCard($deck);
        //total hand -> player
        $player[2] = totalHand($player);
        //total hand -> house
        $house[2] = totalHand($house);
        //check if bust -> player
        if(checkBust($player)){

        }
        //check if bust -> house
        checkBust($house);
        //declare winner
        andTheWinnerIs();
        //play again?
        if (playAgain()) {
            continue;
        }
    break;
    }
}

playBlackjack();