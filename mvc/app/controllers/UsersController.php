<?php
namespace app\core;

class UsersController extends Controller
{
    // Отработка главной странице
    public function actionIndex()
    {
        $this->isLogin();

        $this->loadModel('User');
        $result = $this->model->all()->toArray();

        // Определяем совершенолетие
        foreach ($result as $key => $val) {
            $users['users'][$key] = $val;
            
            if ($val['age'] < 18) {
                $users['users'][$key]['dopusk'] = 'Не совершенолетний';
            } else {
                $users['users'][$key]['dopusk'] = 'Совершенолетний';
            }
        }

        $this->set($users);
        $this->renderTwig('users.twig', $this->params);
    }
}