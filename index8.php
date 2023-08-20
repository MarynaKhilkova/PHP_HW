<?php
//Домашнее задание Занятие 12
// 1.	Создать форму для регистрации (учета) пользователей: форма может содержать любые данные, данные необходимо
// записывать в файл
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Регистрация пользователей
    if (isset($_POST["name"]) && isset($_POST["email"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $userData = "$name, $email\n";
        file_put_contents("users.txt", $userData, FILE_APPEND);
    }
    // 2.	Создать файл, заполнить его случайными числами от 0 до 10, написать функцию которая будет принимать
    // пользовательское значение с формы, посчитать сколько раз встречается введенное пользователем число в файле
    if (isset($_POST["userNumber"])) {
        function countNumberOccurrences($filename, $userNumber) {
            $contents = file_get_contents($filename);
            $numbers = explode(",", $contents);
            $count = 0;
            foreach ($numbers as $number) {
                if ((int)trim($number) === (int)$userNumber) {
                    $count++;
                }
            }
            return $count;
        }

        $userNumber = $_POST["userNumber"];
        $count = countNumberOccurrences("numbers.txt", $userNumber);
        $numberCountMessage = "Число $userNumber встречается $count раз(а) в файле.";
    }
    // 3.	Получить структуру текущего каталога, посчитать количество папок и файлов в данном каталоге
    function countFoldersAndFiles($dir) {
        $folderCount = 0;
        $fileCount = 0;

        $contents = scandir($dir);
        foreach ($contents as $item) {
            if ($item == "." || $item == "..") continue;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($fullPath)) {
                $folderCount++;
            } else {
                $fileCount++;
            }
        }

        return ["folders" => $folderCount, "files" => $fileCount];
    }

    $currentDir = getcwd();
    $countInfo = countFoldersAndFiles($currentDir);

    // 4.	Написать функцию транслит используя строку ввода. Пользователь вводит текст на русском языке и при нажатии
    // на кнопку отправить, ему показывается строка - транслит (например, привет - privet). Правила транслита не важны
    function transliterate($input) {
        // Ваш массив для транслитерации
        $translitTable = array(/* ... ваш массив транслитерации ... */);
        return strtr($input, $translitTable);
    }

    if (isset($_POST["russianText"])) {
        $russianText = $_POST["russianText"];
        $transliteratedText = transliterate($russianText);
        $transliterationMessage = "Текст на транслите: $transliteratedText";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Множество функций</title>
</head>
<body>
<!-- Форма регистрации пользователей -->
<form method="post" action="">
    <label>Имя: <input type="text" name="name"></label><br>
    <label>Email: <input type="text" name="email"></label><br>
    <input type="submit" value="Зарегистрироваться">
</form>

<!-- Форма подсчета числа в файле -->
<form method="post" action="">
    <label>Введите число: <input type="text" name="userNumber"></label><br>
    <input type="submit" value="Посчитать">
</form>

<!-- Форма подсчета папок и файлов -->
<p>Количество папок: <?php echo $countInfo["folders"]; ?></p>
<p>Количество файлов: <?php echo $countInfo["files"]; ?></p>

<!-- Форма транслитерации -->
<form method="post" action="">
    <label>Введите текст на русском языке: <input type="text" name="russianText"></label><br>
    <input type="submit" value="Транслитерировать">
</form>

<!-- Вывод результатов -->
<?php
if (isset($numberCountMessage)) {
    echo "<p>$numberCountMessage</p>";
}
if (isset($transliterationMessage)) {
    echo "<p>$transliterationMessage</p>";
}
?>
</body>
</html>
