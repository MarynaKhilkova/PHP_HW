<?php
//Домашнее задание Занятие 11
//1.	Добавить в класс конструктор, устанавливающий значение свойства в значение переданного в конструктор аргумента.
//Создать экземпляр класса, используя этот конструктор.

class MyClass {
    private $value;

    public function __construct($initialValue) {
        $this->value = $initialValue;
    }

    public function getValue() {
        return $this->value;
    }
}

$instance = new MyClass(42);
echo $instance->getValue(); // Выведет: 42
echo "<br>";

//2.	Вычислить факториал числа (используем классы и методы)

class MyCalculator {
    public static function factorial($n) {
        if ($n <= 1) {
            return 1;
        } else {
            return $n * self::factorial($n - 1);
        }
    }
}

$number = 5;
$result = MyCalculator::factorial($number);
echo "Факториал числа $number: $result"; // Выведет: Факториал числа 5: 120
echo "<br>";

//3.	Создать класс MyCalculator и написать приложение аналогично калькулятору
//(ввод чисел и знака с клавиатуры, использовать основные арифметич операции +-*/)

class MyCalculator2 {
    public static function calculate($num1, $operator, $num2) {
        switch ($operator) {
            case '+':
                return $num1 + $num2;
            case '-':
                return $num1 - $num2;
            case '*':
                return $num1 * $num2;
            case '/':
                if ($num2 != 0) {
                    return $num1 / $num2;
                } else {
                    return "Ошибка: деление на ноль";
                }
            default:
                return "Ошибка: недопустимая операция";
        }
    }
}


$num1 = 10;
$num2 = 5;
$operator = '*';
$result = MyCalculator2::calculate($num1, $operator, $num2);
echo "Результат: $result"; // Выведет: Результат: 50

echo "<br>";

//4.	Создать объект типа Bird, задать параметры по умолчанию используя свойства, добавить методы меняющие характеристики
//(свойства) через специальные созданные методы (canFly, changeSpeed и пр)

class Bird {
    private $canFly = true;
    private $speed = 0;

    public function canFly() {
        return $this->canFly;
    }

    public function changeSpeed($newSpeed) {
        $this->speed = $newSpeed;
    }

    public function getSpeed() {
        return $this->speed;
    }
}

$bird = new Bird();
echo "Может ли птица летать? " . ($bird->canFly() ? "Да" : "Нет"); // Выведет: Может ли птица летать? Да

$bird->changeSpeed(30);
echo "Скорость птицы: " . $bird->getSpeed() . " км/ч"; // Выведет: Скорость птицы: 30 км/ч