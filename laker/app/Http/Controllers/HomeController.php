<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index(Request $request)
    {
        $this->setMethod('users.get');
        $this->setParams([
            'user_ids' => mt_rand(1, 1000),
            'fields' => 'photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, lists, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, wall_comments, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message, can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me',
        ]);

        $userData = $this->searchUser();
        $userData = $this->userValidate($userData);

        if ($userData === false) {
            $request->session()->push('message', 'Данный пользователь ище существует либо удален');
            return redirect()->route('index');
        }

        $userAll = $this->getUserAll();

        return view('index', ['userData' => $userData, 'userAll' => $userAll]);
    }
}
