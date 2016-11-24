<?php
namespace app\core;

class Controller
{
    protected $model; // Для подключения к БД
    protected $config; // Для работы с конфигами
    protected $func; // Для работы с функциями
    protected $root; // Путь до корневой папки
    protected $web_root; // Путь до корневой ссылки сайта
    protected $mail; // Для отправки email сообщений
    protected $twig; // Шаблонизатор

    // Задаем параметры передаваемые в страницу по умолчанию
    protected $params = array(
        'title' => 'Домашняя работа №5',
        'desc' => 'Описание домашней работы #5'
    );

    // Отрабатывается сразу же после создания объекта данного класса
    public function __construct()
    {
        $this->model = Model::getInstance(); // Подключаемся к БД
        $this->config = new Config(); // Подключаемся к классу с конфигами
        $this->func = new Functions(); // Подключаемся к классу с функциями
        $this->mail = new \PHPMailer();

        $loader = new \Twig_Loader_Filesystem($this->config->path['template'].'twig');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false
        ));
        $this->twig->addGlobal('session', $_SESSION);

        $this->root = $this->config->getRoot();
        $this->web_root = $this->config->getWebRoot();
    }

    // Загружает нужную модель для работы с БД
    protected function loadModel($name)
    {
        // Получаем пространство имени подключенной модели
        $model_namespace =  $this->config->getNameSpace($name, 'core');
        // Создаем объект подключенной модели
        if (class_exists($model_namespace)) {
            $this->model = new $model_namespace;
            return true;
        }
        return false;
    }

    // Устанавливаем параметры, передаваемые в запрашиваемую страницу
    protected function set($params = array())
    {
        // Объединияем переданные параметры с параметрами по умолчанию
        if (!empty($params)) {
            $this->params = array_merge($this->params, $params);
        }
        return $this->params;
    }

    // Отрисовка запрашиваемой страницы через Twig
    protected function renderTwig($filename, $data = null)
    {
        // Задаем пути
        $data['template'] = $this->web_root . $this->config->path['template'];
        $data['webroot'] = $this->web_root;

        // Выводим страницу
        echo $this->twig->render($filename, $data);

        // Удаляем уведомление
        unset($_SESSION['message']);
    }

    // Отрисовка запрашиваемой страницы
    protected function render($filename)
    {
        // Если параметры передаваемые в страницу являются массивом
        // То делаем их переменными
        if (is_array($this->params)) {
            $params = $this->params;
            extract($params);
        } else {
            $params = $this->params;
        }

        // Получаем путь до шаблона сайта
        // template/default
        $template = $this->config->path['template'];

        $web = $this->web_root;
        $upload = $this->config->path['upload'];

        // Получаем путь до папки с шаблоном
        // /mvc/template/default
        $path = $this->web_root . $template;

        // Формируем имя запрашиваемой страницы
        // К примеру signin.php
        $content = $filename . '.php';

        // Выводим страницу
        require_once $this->root . $template . 'layout.php';

        // Удаляем уведомление
        unset($_SESSION['message']);
    }

    // Проверка был ли Post запрос
    protected function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }

    // Проверяет зарегистрирован ли пользователь на сайте
    protected function isLogin()
    {
        if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
            $_SESSION['message'] = 'Для начала авторизируйтесь!';
            header("Location: {$this->web_root}signin");
            exit;
        }
    }

    // Проверка расширения картинки
    protected function isImg($img_type)
    {
        // Проверяем расширение картинки
        if (preg_match('/(.jpeg|.jpg|.png|.gif)/', $img_type)) {
            return true;
        }
        return false;
    }

    // Переделывает массив $_FILES в более удобный вид
    protected function files($files)
    {
        $result = array();
        foreach ($files as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                $result[$key2][$key1] = $value2;
            }
        }
        return $result;
    }

    // Проверка каптчи
    protected function trueCaptcha()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $recaptcha = $_POST['g-recaptcha-response'];

        $recaptcha_object = new \ReCaptcha\ReCaptcha($this->config->reCaptcha['secret']);
        $resp = $recaptcha_object->verify($recaptcha, $ip);

        if ($resp->isSuccess()) {
            $_SESSION['message'] .= "Рекаптча пройдена";
        } else {
            $error = $resp->getErrorCodes();
            $_SESSION['message'] = 'Не удалось зарегистрировать пользователя - ' . $error[0];
            header("Location: {$this->web_root}registry");
            exit;
        }
    }
}