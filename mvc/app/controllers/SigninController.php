<?php
namespace app\core;

class SigninController extends Controller
{
    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Страница авторизации'
    );

    // Отработка главной странице
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

            $this->loadModel('User');
            $result = $this->model->select('id')
                ->where('login', $login)
                ->where('password', $password)
                ->get()
                ->toArray();

            if ($result !== null) {
                $_SESSION['id'] = $result['id'];
                header("Location: {$this->web_root}profile");
                exit;
            } else {
                $_SESSION['message'] = 'Неверный логин или пароль';
            }
        }

        $this->set($category);
        $this->renderTwig('signin.twig', $this->params);
    }
}
