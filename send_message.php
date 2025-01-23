<?php

// All
$message = "Привет! Это автопостинг сообщения.";
$imagePath = "img/UtcNPjnOTDA.jpg";

// TG
$botToken = "7916625696:AAEW0Pi5t4X0hBCRD-x4S6AQ8hgwxPP188o";
$chatId = "-1002255910020";

// VK token
$botVKToken = "vk1.a.AfHWo91ogvC6i2HwrIQNgS8iDZ02H0Z-lpW6X-p-vc0BTDzz7pkGIsCbv67a7gfLgNWS94p2FEKHOKrMxI5vCnXg9Y4AWQxD8GplyG82XRde0pUQp8Q2vaRlr3x5RYL3En-P7mj8t09urSD5stnnoyMyb1BsP8FjVoJ1Sg9EknvNmf0QF-FEMpTUFcQKs0lCztTt-u-X202UVgb2iCnaTg";

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
echo "ebd5c58f"
?>