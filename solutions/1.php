<?php


/**
 * Вычисляет факториал
 */
function calculateFactorial($number): float|int
{
    if ($number < 0) {
        return 0; // Возвращаем 0 для отрицательных чисел
    } else if ($number == 0) {
        return 1;
    } else {
        return $number * calculateFactorial($number - 1);
    }
}

/**
 * Проверяет, является ли число простым
 */
function isPrime($num): bool
{
    if ($num <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}


echo "Введите число: ";
$number = readline();
echo "Факториал $number это: " . calculateFactorial($number) . "\n";

if (isPrime($number)) {
    echo "$number - это простое число." . "\n";
} else {
    echo "$number - это не простое число." . "\n";
}