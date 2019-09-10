<?php
/**
 * These are quotes taken from http://www.quotationspage.com/random.php
 * To customize, simply put your own quotes, lines, phrases or whatever inside the array, surrounded by quotes and each quote separated by a comma.
 *
 * return array The array of quotes to base the poetry on.
 */
function get_quotes() {
    return [
        'Put yourself on view. This brings your talents to light.',
        'Life ought to be a struggle of desire toward adventures whose nobility will fertilize the soul.',
        'In a networked world, trust is the most important currency.',
        'The better part of valor is discretion, in the which better part I have saved my life.',
        'Those who believe in telekinetics, raise my hand',
        'In order for people to be happy, sometimes they have to take risks. It\'s true these risks can put them in danger of being hurt.',
        'Associate yourself with men of good quality if you esteem your own reputation, for \'tis better to be alone than in bad company.',
        'Marvelous Truth, confront us at every turn, in every guise.',
        'Language most shews a man: Speak, that I may see thee.',
        'What\'s on your mind, if you will allow the overstatement?',
        'Anger as soon as fed is dead—, \'Tis starving makes it fat.',
        'If they give you ruled paper, write the other way.',
        'I have learned not to worry about love; but to honor its coming with all my heart.',
        'Deeds% not stones, are the true monuments of the great.',
        'Never discourage anyone who continually makes progress, no matter how slow.',
        'In many cases, the more you try to compete, the less competitive you actually are.',
        'I phoned my dad to tell him I had stopped smoking. He called me a quitter.',
        'Be not the first by whom the new are tried, Nor yet the last to lay the old aside.',
        'Life is just one damned thing after another.',
        'Charge less, but charge. Otherwise, you will not be taken seriously, and you do your fellow artists no favours if you undercut the market.',
        'Eh! Je suis leur chef, il fallait bien les suivre. Ah well! I am their leader, I really ought to follow them.',
        'If computers get too powerful, we can organize them into a committee -- that will do them in.',
        'There is no connection between the political ideas of our educated class and the deep places of the imagination.',
        'The greatest giver of alms is cowardice.',
        'If more of us valued food and cheer and song above hoarded gold, it would be a merrier world.',
        'A human being can stand any amount of pain.',
        'What a beautiful morning.',
        'Great people talk about ideas, average people talk about things, and small people talk about wine.',
        'Out of thine own mouth will I judge thee.',
        'Once more unto the breach, dear friends, once more, Or close the wall up with our English dead! In peace there\'s nothing so becomes a man As modest stillness and humility;But when the blast of war blows in our ears, Then imitate the action of the tiger: Stiffen the sinews, summon up the blood.',
        'I don\'t believe in divorce. I believe in widowhood.',
        'Aristotle was famous for knowing everything. He taught that the brain exists merely to cool the blood and is not involved in the process of thinking. This is true only of certain persons.',
        'They wouldn\'t call it falling in love if you didn\'t get hurt sometimes, but you just pick yourself up and move on.',
        'Life being what it is, one dreams of revenge.',
        'The key to immortality is first to live a life worth remembering.',
        'Perhaps in time the so-called Dark Ages will be thought of as including our own.',
        'An appeaser is one who feeds a crocodile, hoping it will eat him last.',
        'I have plenty of common sense! I just choose to ignore it.'
    ];
}

function get_punctuation() {
    return ",—;:!?.";
}

function get_rando_line() {
    $quotes = get_quotes();
    shuffle( $quotes );

    return $quotes[ rand( 0, ( count( $quotes ) - 1 ) ) ];
}

function get_beginning() {
    $line      = get_rando_line();
    $sentences = explode( '.', $line );
    $parts     = explode( ',', $sentences[ rand( 0, ( count( $sentences ) - 1 ) ) ] );
    $beginning = $parts[ rand( 0, ( count( $parts ) - 1 ) ) ];

    if ( '' === $beginning ) {
        $beginning = get_beginning();
    }

    return str_replace( '%', ',', $beginning );
}

function maybe_get_middle() {    
    // Make longer lines less frequent.
    if ( in_array( rand( 0, 10 ), [ 2, 4, 6, 8 ], true ) ) {
        $line      = get_rando_line();
        $sentences = explode( '.', $line );
        shuffle( $sentences );
        
        $parts = explode( ',', $sentences[ rand( 0,  ( count( $sentences ) - 1  ) ) ] );
        shuffle( $parts );
        
        return str_replace( '.', '', strpbrk( $parts[ rand( 0, ( count( $parts ) - 1 ) ) ], get_punctuation() ) );
    }
    
    return '';
}

function maybe_get_end() {
    // Even longer lines should be even more infrequent. Also, Fibonacci FTW.
    if ( in_array( rand( 0, 20 ), [ 1, 2, 3, 5, 8, 13 ], true ) ) {
        $line      = get_rando_line();
        $sentences = explode( '.', $line );
        shuffle( $sentences );
        
        $parts = explode( ',', $sentences[ rand( 0, ( count( $sentences ) - 1 ) ) ] );
        $parts = array_reverse( $parts );
        
        return str_replace( '.', '', strpbrk( $parts[ rand( 0, ( count( $parts ) - 1 ) ) ], get_punctuation() ) );
    }
    
    return '';
}

function get_line() {
    return get_beginning() . maybe_get_middle() . maybe_get_end();
}

function generate_poem( $lines ) {
    $poem = [];
    
    while ( $lines > 0 ) {
        $poem[] = get_line() . '<br />';
        $lines--;
    }

    $poem = array_unique( $poem );
    echo strtolower( implode( "\n", $poem ) );
}
