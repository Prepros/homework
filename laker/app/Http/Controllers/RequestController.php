<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index(Request $request)
    {
        $lakerStatus = $request->bool;

        $userIsset = $this->userIsset($request->id);

        if ($userIsset === true) {
            if ($this->userUpdate($request->id, $lakerStatus)) {
                $request->session()->flash('message', 'Лайк пользователя успешно изменен');
            } else {
                $request->session()->flash('message', 'Ошибка изменения пользователя');
            }
        }
        else {
            $userData = $this->userValidate($request);
            $this->addUser($userData, $lakerStatus);
            $request->session()->flash('message', 'Пользователь успешно добавлен в БД');
        }

        return redirect()->route('index');
    }
}
