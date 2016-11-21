<?php
namespace app\core;

class ProfileController extends Controller
{

    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Страница авторизированного пользователя:'
    );

    // Отработка главной странице
    public function actionIndex()
    {
        $this->isLogin();
        $this->loadModel('ProfileModel');
        $profile = $this->model->getProfile($_SESSION['id']);
//        print_r($profile); exit;
        $profile['ava'] = $this->web_root . $this->config->path['upload'] . $profile['ava'];
        $this->set($profile);
        $this->render('profile');
    }

    public function actionAddphoto()
    {
        $this->isLogin();
        $this->params['desc'] = 'Страница добавления фото:';

        if ($this->isPost()) {
            $id = $_SESSION['id'];
            $photo = $this->files($_FILES['photo']);

            foreach ($photo as $val) {
                if ($this->isImg($val['type'])) {
                    $this->loadModel('ProfileModel');
                    $result = $this->model->insertPhoto($val['name'], $id);
                    if ($result) {
                        move_uploaded_file($val['tmp_name'], $this->config->path['upload'] . iconv("UTF-8", "cp1251", $val['name']));
                        $_SESSION['message'] = 'Файлы умпешно добавлены';
                    }
                } else {
                    $_SESSION['message'] = 'Не балуй такие файлы запрещены :)';
                }
            }
        }
        $this->render('addphoto');
    }

    public function actionPhotos()
    {
        $this->isLogin();
        $this->params['desc'] = 'Страница всех загруженых пользователем картинок:';
        $id = $_SESSION['id'];

        $this->loadModel('ProfileModel');
        $result = $this->model->getAllPhoto($id);

        foreach ($result as $key => $val) {
            foreach ($val as $k => $v) {
                $photo['photo'][$key] = $v;
            }
        }
        $this->set($photo);
        $this->render('photos');
    }

    public function actionExit()
    {
        unset($_SESSION['id']);
        header("Location: {$this->web_root}signin");
        exit;
    }
}