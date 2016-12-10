<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wordpress');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^^Wi,owPNI$Q:AtL~hF]m~oWY4Cj_q&C6F*Plo! {k(.gLyqZwq:M-wOfJ^Uj.)k');
define('SECURE_AUTH_KEY',  'PRdm:d3aY|||5~nY$BLMZOp39KNWJTeQ@el@-4:,tip<xyntVqx*2Z2B_(^!{{Y)');
define('LOGGED_IN_KEY',    '?%/3[iv-zLQM08*EkVMVu^6l,~<S8V]A[a]<, `33%Z|hNxC>8 [ Y#uFPd#a>*0');
define('NONCE_KEY',        'Y!9eJpJUy!~5B9Bs.|aIu<8m{8DIP<@OKVQ_x:0Pql{JOmCgo0+nO`S;;_qh?cWS');
define('AUTH_SALT',        '30XcNfcU}N|P_hRBaK<<M#i,_GmO8F<h2wm2!)8#=a.(JqNEOUVu{rd$9dub0)Mp');
define('SECURE_AUTH_SALT', '<0}5fQ([[u*;t4yi@_O!&#rGA9 u0dkMPo}UlW:)I3_>+,%G =2&Dt`&D7=s/H!O');
define('LOGGED_IN_SALT',   'Y4)2wMAEz?e03CrYrd=EfyZR-[Cir-j Uh> t5Y[4FNcUvTS_y}N6`2a==ke>4fp');
define('NONCE_SALT',       '0PiK)e~U7AWrOjGycLz^IKQpjWlLy=FCBep?HG`,s5g-xWsb}F1BYKq=w^8-yl.L');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
