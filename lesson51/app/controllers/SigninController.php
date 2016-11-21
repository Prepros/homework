<?php
namespace app\core;

class SigninController extends Controller
{
    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Страница авторизации'
    );

    public function actionIndex($params)
    {
        // Если пользователь зарегистрировался, то не показывать ему эту страницу
        if (!empty($_SESSION['id'])) {
            header("Location: {$this->web_root}profile");
            exit;
        }

        if ($this->isPost()) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $this->loadModel('SigninModel');
            $result = $this->model->signinUser($login, $password);

            if ($result) {
                $_SESSION['id'] = $result['id'];
                header("Location: {$this->web_root}profile");
                exit;
            } else {
                $_SESSION['message'] = 'Неверный логин или пароль';
            }
        }

        $this->set($category);
        $this->render('signin');
    }
}
