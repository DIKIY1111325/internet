<<<<<<< HEAD
<?php
// Получаем введенные данные
$email = trim($_POST['email']);
$password = $_POST['password'];

// Загружаем данные пользователей
$jsonData = file_get_contents('users.json');
$data = json_decode($jsonData, true);

// Проверяем, существует ли пользователь
foreach ($data as $user) {
    if ($user['email'] === $email) {
        // Проверяем пароль
        if (password_verify($password, $user['password'])) {
            echo "Вход выполнен успешно!";
            // Здесь можно установить сессию или выполнить другие действия
        } else {
            echo "Неверный пароль.";
        }
        exit;
    }
}

=======
<?php
// Получаем введенные данные
$email = trim($_POST['email']);
$password = $_POST['password'];

// Загружаем данные пользователей
$jsonData = file_get_contents('users.json');
$data = json_decode($jsonData, true);

// Проверяем, существует ли пользователь
foreach ($data as $user) {
    if ($user['email'] === $email) {
        // Проверяем пароль
        if (password_verify($password, $user['password'])) {
            echo "Вход выполнен успешно!";
            // Здесь можно установить сессию или выполнить другие действия
        } else {
            echo "Неверный пароль.";
        }
        exit;
    }
}

>>>>>>> 9eed81a0469770e3249664f5e637017765c43302
echo "Пользователь с таким email не найден."; 