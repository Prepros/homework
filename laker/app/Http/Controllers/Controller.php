<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $myID = 397660210;
    private $access_token = '9a48af28af02a9419eb3d63c5f54408c0bfa6494eedcebe68d4f9d5c627dd4d31d6509548ffd9a3b8acf4';

    private $method = '';
    private $params = [];

    protected function setMethod($method)
    {
        if (is_string($method)) {
            $this->method = "https://api.vk.com/method/{$method}?";
            return true;
        }
        return false;
    }

    protected function setParams($array)
    {
        if (is_array($array)) {
            $params = [
                'access_token' => $this->access_token,
                'v' => 5.60,
            ];
            $this->params = array_merge($array, $params);
            return true;
        }
        return false;
    }

    protected function userUpdate($id, $lakerStatus)
    {
        $result = User::where('id', $id)->update([
            'liker' => $lakerStatus
        ]);
        return $result;
    }

    protected function userValidate($userData)
    {

        if (!empty($userData->deactivated) || empty($userData->id) || $userData->first_name == 'DELETED' || isset($userData->exception)) {
            Session::push('message', 'Данный пользователь ище существует либо удален');
            return redirect()->route('index');
        }

        if (empty($userData->first_name)) {
            $userData->first_name = 'Имя не указано';
        }

        if (empty($userData->last_name)) {
            $userData->last_name = 'Фамилия не указана';
        }

        if (empty($userData->screen_name)) {
            $userData->screen_name = 'Короткого имени нет';
        }

        if (empty($userData->photo_max_orig)) {
            $userData->photo_max_orig = 'http://batona.net/uploads/posts/2016-12/1482737958_01.jpg';
        }

        if (empty($userData->photo_200)) {
            $userData->photo_200 = 'https://pbs.twimg.com/profile_images/552571488708984834/H7jVSpJ5.png';
        }

        if (empty($userData->status)) {
            $userData->status = 'Нет статуса';
        }

        if (empty($userData->university_name)) {
            $userData->university_name = 'Университет не указан';
        }

        if (empty($userData->quotes)) {
            $userData->quotes = '';
        }

        return $userData;
    }

    protected function addUser($userData, $lakerStatus)
    {
        $user = new User;
        $user->id = $userData->id;
        $user->first_name = $userData->first_name;
        $user->last_name = $userData->last_name;
        switch ($userData->sex) {
            case 1:
                $user->sex = 'Женский';
                break;
            case 2:
                $user->sex = 'Мужской';
                break;
        }
        $user->screen_name = $userData->screen_name;
        $user->photo_max_orig = $userData->photo_max_orig;
        $user->photo_200 = $userData->photo_200;
        $user->status = $userData->status;
        $user->university_name = $userData->university_name;
        $user->quotes = $userData->quotes;
        $user->liker = $lakerStatus;

        $result = $user->save();

        return $result;
    }

    protected function userIsset($id)
    {
        if (empty(User::find($id))) {
            return false;
        }
        return true;
    }

    protected function searchUser()
    {
        $userDataJson = file_get_contents($this->method . http_build_query($this->params));
        $userDataObj = json_decode($userDataJson);

        if (!empty($userDataObj->error)) {
            $request->session()->push('message', 'Ошибка в запросе к ВК');
            return redirect()->route('index');
        }

        $userData = $userDataObj->response[0];

        // Если пользователь не найден добавляем в БД
        if ($this->userIsset($userData->id) === false) {
            return $this->userValidate($userData);
        }

        // Если пользователь найден вытаскиваем его данные с БД
        $userData = User::where('id', $userData->id)->first();
        return $userData;
    }

    protected function getUserAll()
    {
        $userAll = User::paginate(10);
        return $userAll;
    }
}
