<?php
// Добавляем ACF Опции
if (function_exists('acf_add_options_page')) {
    acf_add_options_page('Опции');
}

// Разрешаем добавлять svg картинки
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

// Регистрация меню
register_nav_menus(array(
    'top'    => 'Меню в шапке',    //Название месторасположения меню в шаблоне
    'bottom' => 'Меню в подвеле'      //Название другого месторасположения меню в шаблоне
));
class MenuWalker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 3, $args = array(), $current_object_id = 0)
    {
        if ($item->object_id == get_the_ID()) {
            $active = "main-nav__link_active";
        } else {
            $active = "";
        }
        $output .= '<li class="nav-list__nav-item">
                        <a href="' . $item->url . '" class="nav-list__nav-item__nav-link '.$active.'">
       ' . $item->title . '</a>
        </li>';
    }
}
//add_theme_support('menus'); // Поддержка произвольных меню в WordPress

// Добавляем поддержку картинок для постов и страниц
add_theme_support('post-thumbnails');
// Размер картинки поста по умолчанию
set_post_thumbnail_size(825, 510, true);
// Добавляем новый размер картинок
add_image_size('article-image', 380, 300, true);


// Добавляем класс для ссылок пагинации на Страницах
add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');
function post_link_attributes($output) {
    $code = 'class="page-navigation__next-page"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}



// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    */

    return '
	<div class="pagenavi-post-wrap %1$s" role="navigation">
		%3$s
	</div>    
	';
}
