<?php
/*
Plugin Name: Акции
Description: Добавляет раздел для постов акций
Author: Ерофеев Сергей
*/

// Изменяем название стандартного типа Записи на Новости
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Новости';
    $submenu['edit.php'][5][0] = 'Новости';
    $submenu['edit.php'][10][0] = 'Добавить новость';
    $submenu['edit.php'][15][0] = 'Категории';
    $submenu['edit.php'][16][0] = 'Теги';
    $submenu['edit.php?post_type=discount'][15][0] = 'Категории';
}
function revcon_change_post_object() {
    $obj = get_post_type_object( 'post' );
    $obj->menu_icon = 'dashicons-format-aside';
    $labels = &$obj->labels;
    $labels->name = 'Новости';
    $labels->singular_name = 'Новости';
    $labels->add_new = 'Добавить новости';
    $labels->add_new_item = 'Добавить новость';
    $labels->edit_item = 'Редактировать новость';
    $labels->new_item = 'Новости';
    $labels->view_item = 'Посмотреть новости';
    $labels->search_items = 'Искать новости';
    $labels->not_found = 'Новости не найдены';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'Все новости';
    $labels->menu_name = 'Новости';
    $labels->name_admin_bar = 'Новости';
}
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );



// Изменяем порядка пунктов меню в админке
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;

    return array(
        'index.php', // Консоль
        'edit.php', // Записи Новости
        'edit.php?post_type=discount', // Акции
        'edit.php?post_type=page', // Страницы

//        'upload.php', // Медиафайлы
//        'edit-comments.php', // Комментарии
//
//        'themes.php', // Внешний вид
//        'plugins.php', // Плагины
//        'tools.php', // Инструменты
//        'options-general.php', // Параметры
//        'users.php', // Пользователи
//        'link-manager.php', // Ссылки
    );
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');



// Добавляем разделите у пунктов меню в админке
//function add_admin_menu_separator( $position ) {
//    global $menu;
//    $menu[ $position ] = array(
//        0	=>	'',
//        1	=>	'read',
//        2	=>	'separator' . $position,
//        3	=>	'',
//        4	=>	'wp-menu-separator'
//    );
//}
//add_action( 'admin_init', 'add_admin_menu_separator' );
//function set_admin_menu_separator() {
//    do_action( 'admin_init', 3 );
//} // end set_admin_menu_separator
//add_action( 'admin_menu', 'set_admin_menu_separator' );



// Добавляет новый раздел Акции
function discounts()
{
    $labels = array(
        'name'                  => _x( 'Акции', 'Post Type General Name', 'discounts' ),
        'singular_name'         => _x( 'Акция   ', 'Post Type Singular Name', 'discounts' ),
        'menu_name'             => __( 'Акции', 'discounts' ),
        'name_admin_bar'        => __( 'Акции', 'discounts' ),
        'archives'              => __( 'Архив акция', 'discounts' ),
        'parent_item_colon'     => __( 'Родительская акция', 'discounts' ),
        'all_items'             => __( 'Все акции', 'discounts' ),
        'add_new_item'          => __( 'Добавить акцию', 'discounts' ),
        'add_new'               => __( 'Добавить акцию', 'discounts' ),
        'new_item'              => __( 'Новая акция', 'discounts' ),
        'edit_item'             => __( 'Редактировать акцию', 'discounts' ),
        'update_item'           => __( 'Обновить акцию', 'discounts' ),
        'view_item'             => __( 'Просмотреть акцию', 'discounts' ),
        'search_items'          => __( 'Поиск акции', 'discounts' ),
        'not_found'             => __( 'Не найдено', 'discounts' ),
        'not_found_in_trash'    => __( 'Не найдено', 'discounts' ),
        'featured_image'        => __( 'Изображение акции', 'discounts' ),
        'set_featured_image'    => __( 'Установить изображение акции', 'discounts' ),
        'remove_featured_image' => __( 'Удалить изображение', 'discounts' ),
        'use_featured_image'    => __( 'Использовать изображение', 'discounts' ),
        'insert_into_item'      => __( 'Вставить в', 'discounts' ),
        'uploaded_to_this_item' => __( 'Загрузить к', 'discounts' ),
        'items_list'            => __( 'Список', 'discounts' ),
        'items_list_navigation' => __( 'Items list navigation', 'discounts' ),
        'filter_items_list'     => __( 'Filter items list', 'discounts' ),
    );
    $args = array(
        'label'                 => __( 'discount', 'discounts' ),
        'description'           => __( 'Discounts', 'discounts' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', ),
        'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-tickets'
    );
    register_post_type( 'discount', $args );
}
add_action('init', 'discounts', 0);
