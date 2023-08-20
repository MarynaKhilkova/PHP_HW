
<!--Домашнее задание Занятие 9 -->
<!--Сделать форму-анкету с отправкой данных на сервер (можно использовать один файл). В форме запросить данные
пользователя - номер телефона, адрес, email, пол как radio. Произвести валидацию всех полей формы на клиенте
(если возможно) и на сервере усилиями php.-->
<?php
function clear_data($val){
    $val = trim($val);
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}

$pattern_name = '/[а-яёА-ЯЁ]+/u';
$pattern_number = '/[0-9]/';
$err = [
    "town" => "",
    "street" => "",
    "house" => "",
    "flat" => "",
    "email" => "",
    "phone" => ""
];
$flag = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $town = clear_data($_POST['town']);
    $street = clear_data($_POST['street']);
    $house = clear_data($_POST['house']);
    $flat = clear_data($_POST['flat']);
    $phone = clear_data($_POST['phone']);
    $email = clear_data($_POST['email']);

    if (!preg_match($pattern_name, $town)){
        $err['town'] = '<small class="text-danger">Здесь только русские буквы</small>';
        $flag = 1;
    }
    if (!mb_strlen($town) > 10 || empty($town)){
        $err['town'] = '<small class="text-danger">Здесь должно быть не больше 10 символов</small>';
        $flag = 1;
    }
    if (!preg_match($pattern_name, $street)){
        $err['street'] = '<small class="text-danger">Здесь только русские буквы</small>';
        $flag = 1;
    }
    if (!mb_strlen($street) > 10 || empty($street)){
        $err['street'] = '<small class="text-danger">Здесь должно быть не больше 10 символов</small>';
        $flag = 1;
    }
    if (!filter_var($house, FILTER_VALIDATE_INT) || strlen($house) > 5){
        $err['house'] = '<small class="text-danger">Здесь должно быть не больше 5 цифр</small>';
        $flag = 1;
    }
    if (empty($house)){
        $err['house'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (!filter_var($flat, FILTER_VALIDATE_INT) || strlen($flat) > 5){
        $err['flat'] = '<small class="text-danger">Здесь должно быть не больше 5 цифр</small>';
        $flag = 1;
    }
    if (empty($flat)){
        $err['flat'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (!str_starts_with($phone, "+")){
        $err['phone'] = '<small class="text-danger">Формат телефона не верный!</small>';
        $flag = 1;
    }
    if (empty($phone)){
        $err['phone'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err['email'] = '<small class="text-danger">Формат Email не верный!</small>';
        $flag = 1;
    }
    if (empty($email)){
        $err['email'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
<div>АНКЕТА</div>
<p><span class="error">* обязательные поля</span></p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <fieldset>
        <legend>Введите ваш адрес</legend>
        <input type="text" name="town" id="town" placeholder="Город" required>
        <span class="error">* <?= $err['town'] ?></span>
        <br><br>
        <input type="text" name="street" id="street" placeholder="Улица" required>
        <span class="error">* <?= $err['street'] ?></span>
        <br><br>
        <input type="number" name="house" id="house" placeholder="Дом" required>
        <span class="error">* <?= $err['house'] ?></span>
        <br><br>
        <input type="number" name="flat" id="flat" placeholder="Квартира" required>
        <span class="error">* <?= $err['flat'] ?></span>
        <br><br>
    </fieldset>
    <fieldset>
        <legend>Введите ваш email</legend>
        <input type="email" name="email" id="email" placeholder="example@email.com" required>
        <span class="error">* <?= $err['email'] ?></span>
    </fieldset>
    <fieldset>
        <legend>Введите ваш телефон</legend>
        <input type="tel" name="phone" id="phone" placeholder="+000(00)000-00-00" required>
        <span class="error">* <?= $err['phone'] ?></span>
    </fieldset>
    <fieldset>
        <legend>Выберите ваш пол</legend>
        <div>
            <input type="radio" name="male" id="male">
            <label for="male">Мужчина</label>
        </div>
        <div>
            <input type="radio" name="female" id="female">
            <label for="female">Женщина</label>
        </div>
    </fieldset>
    <button type="submit">Send information</button>
</form>
</body>
</html>
