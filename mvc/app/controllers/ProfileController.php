<?php
namespace app\core;
use Intervention\Image\ImageManagerStatic as Image;

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
        // Проверяем зарегистрирован ли пользователь
        $this->isLogin();

        // Загружаем указанную модель для работы с БД
        $this->loadModel('ProfileModel');
        $profile = $this->model->getProfile($_SESSION['id']);

        if (!empty($profile['ava'])) {
            $profile['ava'] = $this->web_root . $this->config->path['upload'] . $profile['ava'];
        }

        $this->set($profile);
//        $this->render('profile');
        $this->renderTwig('profile.twig', $this->params);
    }

    // Страница добавления картинки
    public function actionAddphoto()
    {
        $this->isLogin();
        $this->params['desc'] = 'Страница добавления фото:';

        if ($this->isPost()) {
            $id = $_SESSION['id'];
            $photo = $this->files($_FILES['photo']);
           global $count;
            $count = 0;
            foreach ($photo as $val) {
                if ($this->isImg($val['type'])) {
                    $this->loadModel('ProfileModel');
                    $val['name'] = md5($val['name']) . str_replace('image/','.',$val['type']);

                    $result = $this->model->insertPhoto($val['name'], $id);
                    if ($result) {
                        $result = move_uploaded_file($val['tmp_name'], $this->config->path['upload'] . iconv("UTF-8", "cp1251", $val['name']));
                        // Уменьшаем загружаемую картинку
                        if ($result) {
                            $img = Image::make($this->config->path['upload'].$val['name']);
                            $img->resize(480, 480)->save($path_img, 100);
                        }
                        $_SESSION['message'] = 'Файлы успешно добавлены';
                    }
                } else {
                    $_SESSION['message'] = 'Не балуй такие файлы запрещены :)';
                }
            }
        }
//        $this->render('addphoto');
        $this->renderTwig('addphoto.twig', $this->params);
    }

    // Страница всех картинок загруженных пользователем
    public function actionPhotos()
    {
        $this->isLogin();
        $this->params['desc'] = 'Страница всех загруженых пользователем картинок:';
        $id = $_SESSION['id'];

        $this->loadModel('ProfileModel');
        $result = $this->model->getAllPhoto($id);

        foreach ($result as $key => $val) {
            foreach ($val as $k => $v) {
                $photo['photo'][$key] = $this->web_root . 'upload/' . $v;
            }
        }

        $this->set($photo);
        $this->renderTwig('photos.twig', $this->params);
//        $this->render('photos');
    }

    // Выход пользователя из системы
    public function actionExit()
    {
        unset($_SESSION['id']);
        header("Location: {$this->web_root}signin");
        exit;
    }
}