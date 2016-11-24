<?php
namespace app\core;

class UsersController extends Controller
{
    // Отработка главной странице
    public function actionIndex()
    {
        $this->isLogin();

        $this->loadModel('UsersModel');
        $users = $this->model->getUsersAll();

        // Определяем совершенолетие
        foreach ($users as $key => $val) {
            foreach ($val as $k => $v) {
                if ($v['age'] < 18) {
                    $users[$key][$k]['dopusk'] = 'Не совершенолетний';
                } else {
                    $users[$key][$k]['dopusk'] = 'Совершенолетний';
                }
            }
        }
        
        $this->set($users);
        $this->renderTwig('users.twig', $this->params);
//        $this->render('users');
    }
}