<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function getUserName()
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
    return $name;
}

function showGameName(string $game_name)
{
    line($game_name);
}

function makeQuestion(mixed $question_value)
{
    line("Question: %s", $question_value);
}

function getAnswer()
{
    $user_answer = prompt('Your answer');
    return $user_answer;
}

function getExpectedValue(callable $callback, mixed $value)
{
    $expected_value = $callback($value);
    return $expected_value;
}

function isCorrect(mixed $expected_value, string $user_answer)
{
    return $expected_value === $user_answer;
}

function congratulateUser(string $name)
{
    return line("Congratulations, %s!", $name);
}

function endGame(string $user_answer, mixed $expected_value, string $name)
{
    return line("%s is wrong answer ;(. Correct answer was %s. 
    Let's try again, %s!", $user_answer, $expected_value, $name);
}

function startEngine(string $game_name, callable $callback, callable $generateValue)
{
    $max_count = 3;
    $count = 0;
    $name = getUserName();
    showGameName($game_name);
    while ($count < $max_count) {
        $value = $generateValue();
        makeQuestion($value);
        $user_answer = getAnswer();
        $expected_value = getExpectedValue($callback, $value);
        if (isCorrect($expected_value, $user_answer)) {
            line("Correct!");
            $count += 1;
        } else {
            endGame($user_answer, $expected_value, $name);
            break;
        }
    }
    congratulateUser($name);
}
