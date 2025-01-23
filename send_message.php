<?php

$botToken = "7916625696:AAEW0Pi5t4X0hBCRD-x4S6AQ8hgwxPP188o";
$chatId = "-1002255910020";

// Сообщение, которое вы хотите отправить
$message = "Привет! Это автопостинг сообщения.";

// Функция для отправки сообщения в Telegram
function sendMessage($chatId, $message, $botToken) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Отправляем сообщение
$response = sendMessage($chatId, $message, $botToken);

// Выводим ответ от Telegram API (для отладки)
echo "Response: " . $response;

?>

//$url = "https://api.telegram.org/bot$botToken/getUpdates";
   $response = file_get_contents($url);
   echo $response;