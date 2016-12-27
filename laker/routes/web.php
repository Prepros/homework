<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
////    $json = '{"error":{"error_code":113,"error_msg":"Invalid user id","request_params":[{"key":"oauth","value":"1"},{"key":"method","value":"users.get"},{"key":"user_ids","value":"9999999999"},{"key":"fields","value":"photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, lists, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, wall_comments, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message, can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me"},{"key":"v","value":"5.6"}]}}';
////    $json = '{"response":[{"id":7073049,"first_name":"Игорь","last_name":"Гасилов","sex":2,"nickname":"","domain":"igorgasilov","screen_name":"igorgasilov","city":49,"country":1,"photo_50":"http:\/\/vk.com\/images\/camera_50.png","photo_100":"http:\/\/vk.com\/images\/camera_100.png","photo_200":"http:\/\/vk.com\/images\/camera_200.png","photo_max":"http:\/\/vk.com\/images\/camera_200.png","photo_200_orig":"http:\/\/vk.com\/images\/camera_200.png","photo_400_orig":"http:\/\/vk.com\/images\/camera_400.png","photo_max_orig":"http:\/\/vk.com\/images\/camera_400.png","has_photo":0,"has_mobile":1,"is_friend":0,"friend_status":0,"online":0,"wall_comments":1,"can_post":0,"can_see_all_posts":0,"can_see_audio":0,"can_write_private_message":1,"can_send_friend_request":1,"mobile_phone":"","home_phone":"","skype":"uropexa_86","site":"","status":"","last_seen":{"time":1482777597,"platform":4},"verified":0,"followers_count":36,"blacklisted":0,"blacklisted_by_me":0,"is_favorite":0,"is_hidden_from_feed":0,"common_count":0}]}';
////    $result = json_decode($json);
////    if (!empty($result->error)) {
////        dd($result->error);
////    }
////    dd($result);
//
//    return view('index');
//});

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

Route::post('request', 'RequestController@index');
