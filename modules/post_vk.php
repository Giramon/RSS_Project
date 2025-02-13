<?php

$groupId = "-";
$accessTokenPeople= "-";

// upload in VK imgg
$upload_url_response = file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?access_token={$accessTokenPeople}&v=5.131");
$upload_url_response = json_decode($upload_url_response, true);
$upload_url = $upload_url_response['response']['upload_url'];

// добавить сюда потом автоматизацию пути из БД и сохранение картинок
// params
$image_path = 'img/UtcNPjnOTDA.jpg';
$file = new CURLFile($image_path);
$message = 'Привет, мир! Это мой первый пост через API ВК.';
$link = 'https://www.iqmac.ru/img/iPad2018/karandash/3/4.jpg';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $upload_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $file]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$upload_response = curl_exec($ch);
curl_close($ch);
$upload_response = json_decode($upload_response, true);

// save in VK img
$save_response = file_get_contents("https://api.vk.com/method/photos.saveWallPhoto?access_token={$accessTokenPeople}&v=5.131&user_id={$groupId}&server={$upload_response['server']}&photo={$upload_response['photo']}&hash={$upload_response['hash']}");
$save_response = json_decode($save_response, true);

// params img
$photo_id = $save_response['response'][0]['id'];
$owner_id = $save_response['response'][0]['owner_id'];

$params = array(
	'v'            => '5.131',
	'access_token' => $accessTokenPeople,
	'owner_id'     => '-' . $groupId, 
	'from_group'   => '1', 
	'message'      => $message . "\n" . $link,
	'attachments'  => 'photo' . $owner_id . '_' . $photo_id
);

// post in public VK
$post_response = file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params));
$post_response = json_decode($post_response, true);

if (isset($post_response['response'])) {
    echo "Пост успешно создан! ID поста: " . $post_response['response']['post_id'];
} else {
    echo "Ошибка при создании поста: " . json_encode($post_response);
}
?>
