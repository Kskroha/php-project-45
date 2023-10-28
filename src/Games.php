<?php

namespace BrainGames\Games;

use BrainGames\Engine;

function getRandomNumber($start, $end)
{
    return rand($start, $end);
}

function playBrainEven()
{
    $START = 1;
    $END = 100;

    $getRandomNumber = function () use ($START, $END) {
        return rand($START, $END);
    };

    $isEven = function ($number) {
        return $number % 2 === 0 ? 'yes' : 'no';
    };

    \BrainGames\Engine\startEngine(
        'Answer "yes" if the number is even, otherwise answer "no".',
        $isEven,
        $getRandomNumber
    );
}

function playBrainCalc()
{
    $operators = ['+', '-', '*'];

    $generateValue = function () use ($operators) {
        $a = getRandomNumber(1, 10);
        $b = getRandomNumber(1, 10);
        $search_index = getRandomNumber(0, 2);
        $operator = $operators[$search_index];
        return "{$a} {$operator} {$b}";
    };

    $calculate = function ($value) {
        $result = eval('return ' . $value . ';');
        return (string) $result;
    };

    \BrainGames\Engine\startEngine(
        'What is the result of the expression?',
        $calculate,
        $generateValue
    );
}

function playGreatestCommonDivisor()
{
    $generateValue = function () {
        $a = getRandomNumber(1, 100);
        $b = getRandomNumber(1, 100);
        return "{$a} {$b}";
    };

    $calculate = function ($value) {
        $values = explode(' ', $value);
        for ($x = $values[0], $i = 1; $i < count($values); $i++) {
            $y = $values[$i];
            while ($x && $y) {
                $x > $y ? $x %= $y : $y %= $x;
            }
            $x += $y;
        }
        return (string) $x;
    };

    \BrainGames\Engine\startEngine(
        'Find the greatest common divisor of given numbers.',
        $calculate,
        $generateValue
    );
}

function playArithmeticProgression()
{
    $generateValue = function () {
        $length = getRandomNumber(5, 9);
        $step = getRandomNumber(1, 10);
        $numbers = [];
        $add_number = $step;
        $numbers[0] = $add_number;

        for ($i = 0; $i < $length; $i++) {
            $add_number += $step;
            $numbers[] = $add_number;
        }

        $randomIndex = getRandomNumber(1, 9);
        $numbers[$randomIndex] = '..';
        return implode(' ', $numbers);
    };

    $calculate = function ($value) {
        $values = explode(' ', $value);
        $step = $values[1] - $values[0];
        $missing_index = array_search('..', $values);
        $search_value = $step;
        if ($missing_index !== 0) {
            $search_value = $values[$missing_index - 1] + $step;
        }
        return (string) $search_value;
    };

    \BrainGames\Engine\startEngine(
        'What number is missing in the progression?',
        $calculate,
        $generateValue
    );
}

function playBrainPrime()
{
    $generateValue = function () {
        $number = getRandomNumber(1, 100);
        return $number;
    };

    $isPrime = function ($value) {
        if ($value < 2) {
            return 'no';
        }
        for ($i = 2; $i < $value / 2; $i++) {
            if ($value % $i == 0) {
                return 'no';
            }
        }
        return 'yes';
    };

    \BrainGames\Engine\startEngine(
        'Answer "yes" if given number is prime. Otherwise answer "no".',
        $isPrime,
        $generateValue
    );
}
