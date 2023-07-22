<?php
//Домашние задание 22.07.2023
//1. Удалить пробелы из исходной строки “Я люблю PHP”
$text = 'Я люблю PHP';
function full_trim($text)
{
    return trim(preg_replace('/\s+/', '', $text));
} // убираем пробелы в исходной строке
print(full_trim($text)); // выводим результат
echo "<br/>";

//2.	Заменить “PHP” на другую строку
$search  = 'PHP';
$replace = 'изучать программирование';
$subject = 'Я люблю PHP';
echo str_replace($search, $replace, $subject); // выводим результат замены
echo "<br/>";

//3.	Найти содержит ли строка подстроку
$string = 'Я люблю PHP';
function strContains1($text) {
    $needle = 'PHP';
    if (str_contains($text, $needle)) {
        return "Строка '$needle' найдена в проверяемой строке";
    } else {
        return "'$needle' не найдена в проверяемой строке";
    }
} // ищем подстроку PHP в строке
$functionResult = strContains1($string);
echo $functionResult; // выводим результат
echo "<br/>";

function strContains2($text) {
    $needle = 'JS';
    if (str_contains($text, $needle)) {
        return "Строка '$needle' найдена в проверяемой строке";
    } else {
        return "'$needle' не найдена в проверяемой строке";
    }
} // ищем подстроку JS в строке
$functionResult = strContains2($string);
echo $functionResult; // выводим результат
echo "<br/>";

//4.	Удалить второе слово из исходной строки
$str = 'Я люблю PHP';
$word = 'люблю';
function deleteWord($word, $str) {
    $withoutWord = str_replace($word, "", $str);
    return preg_replace('/\s+/',  ' ', $withoutWord);
} // удаляем второе слово исходной строки и лищний пробел
echo deleteWord($word, $str); // выводим результат
echo "<br/>";


