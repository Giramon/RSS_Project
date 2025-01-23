<?php

// All
$message = "Привет! Это автопостинг сообщения.";
$imagePath = "img/UtcNPjnOTDA.jpg";

// TG
$botToken = "7916625696:AAEW0Pi5t4X0hBCRD-x4S6AQ8hgwxPP188o";
$chatId = "-1002255910020";

// TG
function sendPhotoWithCaption($chatId, $photoPath, $caption, $botToken) {
    $url = "https://api.telegram.org/bot$botToken/sendPhoto";

    // Используем CURL для отправки файла
    $postFields = [
        'chat_id' => $chatId,
        'photo' => new CURLFile(realpath($photoPath)),
        'caption' => $caption,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Отправляем изображение с текстом
$responsePhoto = sendPhotoWithCaption($chatId, $imagePath, $message, $botToken);
echo "Response from sendPhotoWithCaption: " . $responsePhoto . "\n";

?>