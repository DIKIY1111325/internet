<?php
$fullName = 'Имя Фамилия';
$email = 'email@example.com';
$hashedPassword = password_hash('пароль', PASSWORD_DEFAULT);

$data = [
    'fullName' => $fullName,
    'email' => $email,
    'password' => $hashedPassword
];

$filePath = 'path/to/your/file.json';

// Обработка ошибок при сохранении данных
if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT)) === false) {
    echo "Ошибка при сохранении данных.";
    exit;
}

echo "Регистрация прошла успешно!";
?>
