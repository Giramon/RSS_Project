<?php


// сделать загрзуку всегоo ff
if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']); 
}


// bot
$botToken = "7916625696:AAEW0Pi5t4X0hBCRD-x4S6AQ8hgwxPP188o";
$chatId = "-1002255910020";


// params
$imagePath = "img/UtcNPjnOTDA.jpg";
$link = 'https://www.iqmac.ru/img/iPad2018/karandash/3/4.jpg';

function sendPhotoWithCaption($chatId, $photoPath, $caption, $botToken) {
    $url = "https://api.telegram.org/bot$botToken/sendPhoto";

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
if($message == null) {
    echo('Ошибка: Сообщение пустое');
    exit;
}
else {
    $responsePhoto = sendPhotoWithCaption($chatId, $imagePath, $message . "\n" . $link, $botToken);
    print($responsePhoto);
}


?>