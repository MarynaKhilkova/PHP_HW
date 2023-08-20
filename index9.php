<?php
// Домашнее задание Занятие 13
//1.	Создать класс, который реализовывает интерфейс с методом filter. метод фильтр должен принимать массив данных,
// класс должен фильтровать данные типу данных - пропускает только int, остальные записывает в файл.

interface DataFilterInterface {
    public function filter(array $data);
}

class DataFilter implements DataFilterInterface {
    public function filter(array $data) {
        $intValues = [];

        foreach ($data as $value) {
            if (is_int($value)) {
                $intValues[] = $value;
            } else {
                file_put_contents('non_int_values.txt', $value . PHP_EOL, FILE_APPEND);
            }
        }

        return $intValues;
    }
}


//2.	Создать класс Банкомат и реализовать методы внесения и выдачи денег.
class ATM {
    private $balance = 0;

    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
            return true;
        }
        return false;
    }

    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return true;
        }
        return false;
    }

    public function getBalance() {
        return $this->balance;
    }
}


// 3.	Реализовать класс Интернет провайдер. Реализовать три тарифа. Каждый тариф имеет основные характеристики:
// Количество трафика, стоимость сверх включенного трафика, скорость интернета на тарифе.
// Также доступны дополнительные услуги (трейты):
//○	активация услуги уменьшения скорости, если израсходован трафик, при безлимитном тарифе
//○	активация дополнительного пакета трафика (добавляем трафик к исходному)
trait SpeedReductionTrait {
    public function activateSpeedReduction() {
        return "Speed reduction service activated.";
    }
}

trait ExtraTrafficTrait {
    public function activateExtraTraffic($amount) {
        return "Extra {$amount} GB traffic added.";
    }
}

class InternetProvider {
    private $tariffs = [];

    public function addTariff($name, $traffic, $extraTrafficCost, $speed) {
        $this->tariffs[$name] = [
            'traffic' => $traffic,
            'extraTrafficCost' => $extraTrafficCost,
            'speed' => $speed,
        ];
    }

    public function getTariffs() {
        return $this->tariffs;
    }
}

class Tariff {
    use SpeedReductionTrait, ExtraTrafficTrait;

    private $name;
    private $traffic;
    private $extraTrafficCost;
    private $speed;

    public function __construct($name, $traffic, $extraTrafficCost, $speed) {
        $this->name = $name;
        $this->traffic = $traffic;
        $this->extraTrafficCost = $extraTrafficCost;
        $this->speed = $speed;
    }

    public function getName() {
        return $this->name;
    }

    public function getTraffic() {
        return $this->traffic;
    }

    public function getExtraTrafficCost() {
        return $this->extraTrafficCost;
    }

    public function getSpeed() {
        return $this->speed;
    }
}

$provider = new InternetProvider();
$provider->addTariff('Basic', 50, 0.1, 10);
$provider->addTariff('Premium', 100, 0.05, 50);
$provider->addTariff('Unlimited', -1, 0, 100);

$tariffs = $provider->getTariffs();
foreach ($tariffs as $tariffName => $tariffData) {
    echo "Tariff: {$tariffName}<br>";
    echo "Included Traffic: {$tariffData['traffic']} GB<br>";
    echo "Extra Traffic Cost: {$tariffData['extraTrafficCost']} per GB<br>";
    echo "Speed: {$tariffData['speed']} Mbps<br>";

    if ($tariffName === 'Unlimited') {
        $unlimitedTariff = new Tariff($tariffName, $tariffData['traffic'], $tariffData['extraTrafficCost'], $tariffData['speed']);
        echo $unlimitedTariff->activateSpeedReduction() . "<br>";
        echo $unlimitedTariff->activateExtraTraffic(20) . "<br>";
    }

    echo "<br>";
}

?>

