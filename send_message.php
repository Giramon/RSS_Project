<?php
/*
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


// VK token

$accessToken = "vk1.a.Pm9vsH6RcgrNkPwr_qL1O861z_K3C4q6iqUR2oRtXJ9Cg-0gqbcNt-jIEAI9uh_XHuS00JhLRtcc8EyxkfJK49ifxjJtnEyXcBLZf7bwWsQJqDrtTvfqxZ6bxtKS44UCnQs41z95IgTyAyOSyDI1zn-QK7ffnKEywuKGF0l7ylLcD2kQ_UAG_e2hK_0pOqI37cRanJUawZWVCjMBZwbaxA";
$groupId = "229123818";
$imagePath = "img/UtcNPjnOTDA.jpg";
$message = 'Привет, мир! Это мой первый пост через API ВК.';

$url = 'https://api.vk.com/method/wall.post';

$params = [
    'owner_id' => '-' . $groupId,
    'message' => $message,
    'access_token' => $accessToken,
    'v' => '5.131' // Версия API
];

$queryString = http_build_query($params);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . '?' . $queryString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response, true);
if (isset($data['response'])) {
    echo "Пост успешно создан с ID: " . $data['response']['post_id'];
} else {
    echo "Ошибка: " . ($data['error']['error_msg'] ?? 'Неизвестная ошибка');
}
?>