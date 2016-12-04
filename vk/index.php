<?php
//https://oauth.vk.com/authorize?client_id=5759868&display=popup&redirect_uri=blank.html&scope=notify,friends,photos,offline,wall&response_type=token&v=5.60

// 1) Шаг - присваеваем необходимые значения полученные из ссылки выше
// --------------------------------------------------------
$token = 'bb20fec0917121a5d7681e96daa3562f39d570e497ed944263ff4cacb4bbf86037dea6ccfa8e22689c876';
$user_id = Ваш_или_не_ваш_id; // У пользователя должна быть активна стена для записи
$message = 'Текст сообщения';
$img['name'] = 'unnamed2.png';
$img['tmp_name'] = __DIR__ . DIRECTORY_SEPARATOR . $img['name'];
$img['type'] = mime_content_type($img['tmp_name']);
// ---------------------------------------------------------

// 2) Шаг - получаем адрес сервера для загрузки картинки
// --------------------------------------------------------
$method = 'photos.getWallUploadServer';
$params = array(
    'access_token' => $token,
    'v' => 5.60
);
$url = "https://api.vk.com/method/{$method}?";

$data = file_get_contents($url . http_build_query($params));
$data = json_decode($data, true);
$data = $data['response'];
// -----------------------------------------------------------

// 3) Шаг - передаем необходимую картинку по полученому адресу сервера
// --------------------------------------------------------
$ch = curl_init();
$cfile = curl_file_create($img['tmp_name'], $img['type'], $img['name']);
curl_setopt($ch, CURLOPT_URL, $data['upload_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array('photo' => $cfile));
$answer = curl_exec($ch);
curl_close($ch);

$data = json_decode($answer, true);
// ----------------------------------------------------------------------

// 4) Шаг - сохраняем картинку на сервере VK
// --------------------------------------------------------
$method = 'photos.saveWallPhoto';
$params = array(
    'user_id' => 864279,
    'photo' => stripslashes($data['photo']),
    'server' => $data['server'],
    'hash' => $data['hash'],
    'access_token' => $token,
    'v' => 5.60
);
$url = "https://api.vk.com/method/{$method}?";

$data = file_get_contents($url . http_build_query($params));
$data = json_decode($data, true);
$data = $data['response'][0];
// ----------------------------------------------------------------------

// 5) Шаг - постим картинку на стену
// --------------------------------------------------------
$method = 'wall.post';
$params = array(
    'owner_id' => $user_id,//$data['owner_id']
    'message' => urldecode($message),
    'attachments' => 'photo' . $data['owner_id'] . '_' . $data['id'],
    'hash' => $data['hash'],
    'access_token' => $token,
    'v' => 5.60
);
$url = "https://api.vk.com/method/{$method}?";

try {
    $data = file_get_contents($url . http_build_query($params));
    $data = json_decode($data, true);
    echo 'Картинка успешно добавлена, она по счету - ' . $data['response']['post_id'];
} catch (Exception $e) {
    throw new Exception('Ошибка добавления картинки на стену VK');
    echo $e->getMessage();
}
// ----------------------------------------------------------------------

echo "<pre>";
print_r($data); exit;