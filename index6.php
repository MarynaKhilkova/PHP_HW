<?php
//Домашнее задание Занятие 10

// 1.	Создать форму с логином и паролем. Сохранить логин в куки после отправки формы. Сохранить пароль в куки
// (по возможности используйте шифрование, например, md5 - https://www.php.net/manual/ru/function.md5.php).
// Хранить куки час.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = md5($_POST['password']); // Хешируем пароль с помощью MD5

    setcookie('saved_login', $login, time() + 3600); // Сохраняем логин в куки на 1 час
    setcookie('saved_password', $password, time() + 3600); // Сохраняем пароль в куки на 1 час
}

// 2.	Создать cookie, которая будет хранить количество посещений страницы.
$visitCount = isset($_COOKIE['visit_count']) ? $_COOKIE['visit_count'] : 0;
$visitCount++;
setcookie('visit_count', $visitCount, time() + 3600); // Сохраняем количество посещений в куки на 1 час

// 3.	Создайте в cookie  очередь из трех страниц сайта, которые посещены сами последними. (Для выполнения
// создайте файлы по типу page1.php, page2.php и тд переходите по ним используя <a href=””></a> -
// аналог навигации - меню)
function updatePageQueue($currentPage) {
    $pageQueue = isset($_COOKIE['page_queue']) ? json_decode($_COOKIE['page_queue']) : [];

    if (($key = array_search($currentPage, $pageQueue)) !== false) {
        unset($pageQueue[$key]);
    }

    array_push($pageQueue, $currentPage);

    if (count($pageQueue) > 3) {
        array_shift($pageQueue);
    }

    setcookie('page_queue', json_encode($pageQueue), time() + 3600); // Сохраняем очередь в куки на 1 час
}

$currentPage = basename($_SERVER['PHP_SELF']);
updatePageQueue($currentPage);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Combined Tasks</title>
</head>
<body>
<h1>Login Form</h1>
<form method="POST">
    <label>Login:</label>
    <input type="text" name="login"><br>
    <label>Password:</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>

<h1>Visit Counter</h1>
<p>This page has been visited <?= $visitCount ?> times.</p>

<h1>Page Navigation</h1>
<ul>
    <li><a href="combined_tasks.php">Combined Tasks</a></li>
    <li><a href="page1.php">Page 1</a></li>
    <li><a href="page2.php">Page 2</a></li>
    <li><a href="page3.php">Page 3</a></li>
</ul>
</body>
</html>

