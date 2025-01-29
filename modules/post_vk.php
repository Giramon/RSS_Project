<?php

$groupId = "229123818";
$message = 'Привет, мир! Это мой первый пост через API ВК.';
$accessTokenPeople= "vk1.a._ceYVMNlA9OWSbcq6i1fGHYgTPvXkE1crhLyVmsDUfSL93F0_MuBcM70Xw0pwS6Lw663SQnqKKuVFeylchAEPvzsSAFxblAVTcVumxDsshiVl0c2VSPTsn80d4F14EuMG_MPpxu25_5mETP7LYhSxCGYE46cuncpnTVhzZjQ0mtqik7CF3Hi6khpHZaFnagx9dMKMWtmthbUIArreMP7ig";
$link = 'https://www.iqmac.ru/img/iPad2018/karandash/3/4.jpg';


$upload_url_response = file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?access_token={$accessTokenPeople}&v=5.131");
$upload_url_response = json_decode($upload_url_response, true);
$upload_url = $upload_url_response['response']['upload_url'];

// добавить сюда потом автоматизацию пути из БД и сохранение картинок
$image_path = 'img_create/logo.jpg';
$file = new CURLFile($image_path);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $upload_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => $file]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$upload_response = curl_exec($ch);
curl_close($ch);

$upload_response = json_decode($upload_response, true);

$save_response = file_get_contents("https://api.vk.com/method/photos.saveWallPhoto?access_token={$accessTokenPeople}&v=5.131&user_id={$groupId}&server={$upload_response['server']}&photo={$upload_response['photo']}&hash={$upload_response['hash']}");
$save_response = json_decode($save_response, true);

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

$post_response = file_get_contents('https://api.vk.com/method/wall.post?' . http_build_query($params));
$post_response = json_decode($post_response, true);

if (isset($post_response['response'])) {
    echo "Пост успешно создан! ID поста: " . $post_response['response']['post_id'];
} else {
    echo "Ошибка при создании поста: " . json_encode($post_response);
}
?>