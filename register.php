<?php
// Создание файла users.json, если он не существует
$filePath = 'users.json';
if (!file_exists($filePath)) {
    file_put_contents($filePath, json_encode([])); // Создание пустого массива
}

// Остальной код...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['full-name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Неверный формат email.";
        exit;
    }

    // Проверка на пустые поля
    if (empty($fullName) || empty($email) || empty($password)) {
        echo "Все поля должны быть заполнены.";
        exit;
    }

    // Путь к файлу для хранения данных пользователей
    $data = json_decode(file_get_contents($filePath), true);

    // Проверка на уникальность email
    foreach ($data as $user) {
        if ($user['email'] === $email) {
            echo "Пользователь с таким email уже существует.";
            exit;
        }
    }

    // Добавление нового пользователя
    $data[] = [
        'full_name' => $fullName,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Хеширование пароля
    ];

    // Обработка ошибок при сохранении данных
    if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT)) === false) {
        echo "Ошибка при сохранении данных.";
        exit;
    }

    echo "Регистрация прошла успешно!";
}
?> 