<?php
// Создание файла users.json, если он не существует
$filePath = 'users.json';
if (!file_exists($filePath)) {
    file_put_contents($filePath, json_encode([])); // Создание пустого массива
}

// Обработка POST-запроса
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

    // Загружаем данные пользователей
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);

    // Проверка на ошибки при декодировании JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Ошибка при загрузке данных пользователей: " . json_last_error_msg();
        exit;
    }

    // Проверка на уникальность email
    foreach ($data as $user) {
        if ($user['email'] === $email) {
            echo "Пользователь с таким email уже существует.";
            exit;
        }
    }

    // Хеширование пароля
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Проверка на ошибки хеширования
    if ($hashedPassword === false) {
        echo "Ошибка при хешировании пароля.";
        exit;
    }

    // Добавление нового пользователя
    $data[] = [
        'full_name' => $fullName,
        'email' => $email,
        'password' => $hashedPassword // Хешированный пароль
    ];

    // Обработка ошибок при сохранении данных
    if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT)) === false) {
        echo "Ошибка при сохранении данных.";
        exit;
    }

    echo "Регистрация прошла успешно!";
}
?>