<?php

namespace BrainGames\Games;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function getRandomNumber($start, $end) {
    return rand($start, $end);
};

function playBrainEven()
{
    $START = 1;
    $END = 100;

    $getRandomNumber = function () use ($START, $END) {
        return rand($START, $END);
    };

    $isEven = function($number)
    {
        return $number % 2 === 0 ? 'yes' : 'no';
    };

    \BrainGames\Engine\startEngine(
        'Answer "yes" if the number is even, otherwise answer "no".',
        $isEven,
        $getRandomNumber
    );
};

function playBrainCalc()
{
    $operators = ['+', '-', '*'];

    $generateValue = function () use ($operators)
    {
        $a = getRandomNumber(1, 10);
        $b = getRandomNumber(1, 10);
        $search_index = getRandomNumber(0, 2);
        $operator = $operators[$search_index];
        return "{$a} {$operator} {$b}";
    };

    $calculate = function($value)
    {
        $result = eval('return '.$value.';');
        return (string) $result;
    };

    \BrainGames\Engine\startEngine(
        'What is the result of the expression?',
        $calculate,
        $generateValue
    );
};

function playGreatestCommonDivisor()
{
    $generateValue = function ()
    {
        $a = getRandomNumber(1, 100);
        $b = getRandomNumber(1, 100);
        return "{$a} {$b}";
    };

    $calculate = function($value)
    {
        $result = explode(' ', $value);
        [$a , $b] = $result;
        return (string) gmp_gcd($a, $b);
    };

    \BrainGames\Engine\startEngine(
        'Find the greatest common divisor of given numbers.',
        $calculate,
        $generateValue
    );
};