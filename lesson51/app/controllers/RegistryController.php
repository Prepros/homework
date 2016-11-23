<?php
namespace app\core;

use ReCaptcha\ReCaptcha;

class RegistryController extends Controller
{
    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Страница регистрации'
    );

    // Отработка главной странице
    public function actionIndex()
    {
        // Если был отправлен POST запрос
        if ($this->isPost()) {
            // Получаем данные отправленые пользователем через регистрационную форму
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $name = $_POST['name'];
            $age =  $_POST['age'];
            $about =  $_POST['about'];

            // Проверка каптчи
            $this->trueCaptcha();

            // Проверям была ли отправлена картинка
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] != 4) {
                $photo = $_FILES['photo'];
            }

            // Загружаем нужную модель
            $this->loadModel('RegistryModel');
            
            // Проверяем существет ли такой пользователь
            if ($this->model->issetUser($login)) {
                $_SESSION['message'] .= 'Данный пользователь уже существует, попробуйте еще раз.';
                header("Location: {$this->web_root}registry");
                exit;
            }

            // Вызываем метод добавления нового пользователя
            $result = $this->model->registryUser($login, $pass, $name, $age, $about, $photo['name']);

            // Если регистрация прошла успешно
            if ($result) {
                // Получаем id зарегистрированного пользователя
                $id = $this->model->pdo->lastInsertId();

                // Проверяем расширение картинки
                if ($this->isImg($photo['type'])) {
                    // Зугружаем картинку
                    move_uploaded_file($photo['tmp_name'], $this->config->path['upload'] . iconv("UTF-8", "cp1251", $photo['name']));
                }

                // Отправка письма о регистрации
                $this->sendMail($this->config->mail['myAddress'], $this->config->mail['myName'], $login);
                
                $_SESSION['message'] .= 'Регистрация прошла успешно';
                header("Location: {$this->web_root}signin");
                exit;
            } else {
                $_SESSION['message'] = 'Не удалось зарегистрировать пользователя';
                header("Location: {$this->web_root}registry");
                exit;
            }
        }

        $this->set($category);
        $this->render('registry');
    }
    
    private function sendMail($my_email, $my_name, $user_name)
    {
        $this->mail->isMail();                                      // Авторизация через SMTP сервера для отправки почты
        
        $this->mail->setFrom($my_email, $my_name);         // От кого почта приходит
        $this->mail->addAddress($my_email);     // Кому почта отправляется

        $this->mail->Subject = 'Регистрация нового пользователя'; // Текст письма
        $this->mail->Body = 'Пользователь ' . $user_name . ' успешно зарегистрировался у нас в системе!';               // Тема письма

        // Отправка
        if($this->mail->send()) {
            $_SESSION['message'] = "Письмо о регистрации ушло на почту<br>";
        } else {
            $_SESSION['message'] = 'Ошибка отправки письмо о регистрации';
        }
    }
}
