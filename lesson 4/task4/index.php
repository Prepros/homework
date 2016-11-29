<?php
//function recursion($array) {
//    if (is_array($array)) {
//        foreach ($array as $key => $val) {
//            if ($key == 'pageid' || $key == 'title') {
////                echo "$key = $val <br>";
//                $data[$key] = $val;
//                continue;
//            } else {
//                recursion($val);
//            }
//        }
//    }
//    return $data;
//}

// 1. инициализация
$ch = curl_init();

// 2. указываем параметры, включая url
curl_setopt($ch, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

// 3. получаем HTML в качестве результата
$output = curl_exec($ch);

// 4. закрываем соединение
curl_close($ch);

// 5. полученные данные распаковывем в массив
$data = json_decode($output, true);

// 6. ищем title и pageid
//print_r(recursion($data));

function title($val, $key) {
    if($key == 'title' || $key == 'pageid') {
        echo "$key = $val <br>";
    }
}

array_walk_recursive($data, 'title');