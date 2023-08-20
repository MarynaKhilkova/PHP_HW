
<!--1.	Создать класс Банкомат и реализовать методы внесения и выдачи денег. Выполнить используя статику-->
<?php
class ATM {
    private static $balance = 0;

    public static function deposit($amount) {
        if ($amount > 0) {
            self::$balance += $amount;
            return true;
        }
        return false;
    }

    public static function withdraw($amount) {
        if ($amount > 0 && $amount <= self::$balance) {
            self::$balance -= $amount;
            return true;
        }
        return false;
    }

    public static function getBalance() {
        return self::$balance;
    }
}

// Пример использования класса ATM
ATM::deposit(100); // Внесение 100 долларов
ATM::withdraw(50); // Выдача 50 долларов
echo "ATM Balance: " . ATM::getBalance() . " dollars<br>"; // Остаток на балансе
?>

<!--2.	Создать класс и метод, который преобразовывает введенную с инпута строку в строку для URL -->

<?php

class UrlConverter {
    public static function convertToUrlString($input) {
        return urlencode($input);
    }
}

// Пример использования класса UrlConverter
if (isset($_POST['input_text'])) {
    $inputText = $_POST['input_text'];
    $urlString = UrlConverter::convertToUrlString($inputText);
    echo "Input Text: {$inputText}<br>";
    echo "URL String: {$urlString}";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>URL String Converter</title>
</head>
<body>
    <form method="POST">
        <label>Input Text:</label>
        <input type="text" name="input_text">
        <input type="submit" value="Convert">
    </form>
</body>
</html>

<!--3.	Создать класс и метод (хелпер), который работает с cookie - записывает и вычисляет куки-->
<?php

class CookieHelper {
    public static function setCookie($name, $value, $expiration) {
        setcookie($name, $value, time() + $expiration);
    }

    public static function getCookie($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public static function deleteCookie($name) {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, time() - 3600); // Установка срока действия в прошлое время
        }
    }
}

// Пример использования класса CookieHelper
if (isset($_POST['set_cookie'])) {
    $cookieName = $_POST['cookie_name'];
    $cookieValue = $_POST['cookie_value'];
    $cookieExpiration = $_POST['cookie_expiration'];

    CookieHelper::setCookie($cookieName, $cookieValue, $cookieExpiration);
}

if (isset($_POST['get_cookie'])) {
    $cookieName = $_POST['cookie_name'];
    $cookieValue = CookieHelper::getCookie($cookieName);
}

if (isset($_POST['delete_cookie'])) {
    $cookieName = $_POST['cookie_name'];
    CookieHelper::deleteCookie($cookieName);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Helper</title>
</head>
<body>
<h1>Set Cookie</h1>
<form method="POST">
    <label>Cookie Name:</label>
    <input type="text" name="cookie_name"><br>
    <label>Cookie Value:</label>
    <input type="text" name="cookie_value"><br>
    <label>Cookie Expiration (in seconds):</label>
    <input type="text" name="cookie_expiration"><br>
    <input type="submit" name="set_cookie" value="Set Cookie">
</form>

<h1>Get Cookie</h1>
<form method="POST">
    <label>Cookie Name:</label>
    <input type="text" name="cookie_name"><br>
    <input type="submit" name="get_cookie" value="Get Cookie">
</form>

<h1>Delete Cookie</h1>
<form method="POST">
    <label>Cookie Name:</label>
    <input type="text" name="cookie_name"><br>
    <input type="submit" name="delete_cookie" value="Delete Cookie">
</form>

<?php
if (isset($cookieValue)) {
    echo "<p>Cookie Value: {$cookieValue}</p>";
}
?>
</body>
</html>



<!--4.	Создать класс для работы с кэшем. Необходим хранить в кеше данные формы и дублировать кэш в файл.
Реализовать возможность получения кэша посредством использования $_GET параметров - каждый кэш хранить
под уникальным идентификатором. -->

<?php

class CacheManager {
    public static function storeCache($cacheId, $data) {
        $cacheFilePath = "cache/{$cacheId}.txt";
        file_put_contents($cacheFilePath, serialize($data));
    }

    public static function retrieveCache($cacheId) {
        $cacheFilePath = "cache/{$cacheId}.txt";
        if (file_exists($cacheFilePath)) {
            return unserialize(file_get_contents($cacheFilePath));
        }
        return null;
    }
}

// Пример использования класса CacheManager
if (isset($_POST['store_cache'])) {
    $cacheId = uniqid(); // Создаем уникальный идентификатор для кэша
    $formData = $_POST['form_data'];

    CacheManager::storeCache($cacheId, $formData);
}

if (isset($_GET['cache_id'])) {
    $cacheId = $_GET['cache_id'];
    $retrievedData = CacheManager::retrieveCache($cacheId);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cache Manager</title>
</head>
<body>
<h1>Store Cache</h1>
<form method="POST">
    <label>Form Data:</label>
    <input type="text" name="form_data"><br>
    <input type="submit" name="store_cache" value="Store Cache">
</form>

<h1>Retrieve Cache</h1>
<form method="GET">
    <label>Cache ID:</label>
    <input type="text" name="cache_id"><br>
    <input type="submit" value="Retrieve Cache">
</form>

<?php
if (isset($retrievedData)) {
    echo "<h2>Retrieved Cache Data:</h2>";
    print_r($retrievedData);
}
?>
</body>
</html>






