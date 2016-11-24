<?php
namespace app\core;
use Intervention\Image\ImageManagerStatic as Image;

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
            // Проверка каптчи
//            $this->trueCaptcha();

            // Валидация формы
            $result = $this->validate();
            if ($result !== true) {
                foreach ($result as $key => $value) {
                    $validate[$key] = $value[0];
                }
                $this->set($validate);
                $this->renderTwig('registry.twig', $this->params);
                exit;
            }

            // Получаем данные отправленые пользователем через регистрационную форму
            $login = $_POST['login'];
            $pass = $_POST['password'];
            $name = $_POST['name'];
            $age =  $_POST['age'];
            $about =  $_POST['about'];
            $ip = $_POST['ip'];
            // Проверям была ли отправлена картинка
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] != 4) {
                $photo = $_FILES['photo'];
                $photo['name'] = md5($photo['name']) . str_replace('image/','.',$photo['type']);
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
            $result = $this->model->registryUser($login, $pass, $name, $age, $about, $photo['name'], $ip);

            // Если регистрация прошла успешно
            if ($result) {
                // Получаем id зарегистрированного пользователя
                $id = $this->model->pdo->lastInsertId();
                $_SESSION['id'] = $id;

                // Проверяем расширение картинки
                if ($this->isImg($photo['type'])) {
                    // Зугружаем картинку
                    $result = move_uploaded_file($photo['tmp_name'], $this->config->path['upload'] . iconv("UTF-8", "cp1251", $photo['name']));

                    // Уменьшаем загружаемую картинку
                    if ($result) {
                        $img = Image::make($this->config->path['upload'].$photo['name']);
                        $img->resize(480, 480)->save($path_img, 100);
                    }
                }

                // Отправка письма о регистрации
                $this->sendMail($login);
                
                $_SESSION['message'] .= 'Регистрация прошла успешно';
                header("Location: {$this->web_root}signin");
                exit;
            } else {
                $_SESSION['message'] = 'Не удалось зарегистрировать пользователя';
                header("Location: {$this->web_root}registry");
                exit;
            }
        }

        $this->params['ip'] = $_SERVER['REMOTE_ADDR'];
        $this->renderTwig('registry.twig', $this->params);
    }

    // Отправка письма
    private function sendMail($user_name)
    {
        $this->mail->isSMTP();
//        $this->mail->setLanguage('ru', $this->config->getRoot(). 'vendor/phpmailer/phpmailer/language/phpmailer.lang-ru.php');
        $this->mail->CharSet = 'UTF-8';
//        $this->mail->SMTPDebug = 3;
        $this->mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = $this->config->mail['myAddress'];                 // SMTP username
        $this->mail->Password = $this->config->mail['myPass'];                           // SMTP password
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 465;

        //$this->mail->isMail();                                      // Авторизация через SMTP сервера для отправки почты
        
        $this->mail->setFrom($this->config->mail['myAddress'], 'Регистрационный робот');         // От кого почта приходит
        $this->mail->addAddress($this->config->mail['myAddress']);     // Кому почта отправляется

        $this->mail->Subject = 'Регистрация нового пользователя'; // Текст письма
        $this->mail->Body = 'Пользователь ' . $user_name . ' успешно зарегистрировался у нас в системе!';               // Тема письма

        // Отправка
        if($this->mail->send()) {
            $_SESSION['message'] = "Письмо о регистрации ушло на почту ";
        } else {
            $_SESSION['message'] = "Ошибка отправки письмо о регистрации " . $this->mail->ErrorInfo;
        }
    }

    private function validate()
    {
        $this->valitron->rule('required', ['login', 'password']);
        $this->valitron->rule('lengthMin', 'name', 5);
        $this->valitron->rule('lengthMin', 'about', 50);
        $this->valitron->rule('ip', 'ip');
        $this->valitron->rule('min', 'age', 10);
        $this->valitron->rule('max', 'age', 100);

        if ($this->valitron->validate()) {
            return true;
        } else {
            // Errors
            return $this->valitron->errors();
        }
    }
}
