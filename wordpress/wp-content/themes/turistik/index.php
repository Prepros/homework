<?php get_header(); ?>
<div class="main-content">
    <div class="content-wrapper">
        <div class="content">
            <h1 class="title-page">Последние новости и акции из мира туризма</h1>
            <div class="posts-list">
                <!-- post-mini-->
                <?php
                $args = array(
                    'post_type' => array('post', 'discount'),
                    'posts_per_page' => 3,
                    'paged' => get_query_var('paged')
                );
                $posts = query_posts($args);
                ?>
                <?php if (have_posts()) : while (have_posts()): the_post(); ?>
                    <div class="post-content__post-info">
                        <div class="post-date">
                            <?php the_date(); ?>
                        </div>
                    </div>
                    <div class="post-wrap">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('article-image', array('class'=>'post-thumbnail__image')); ?>
                            </div>
                        <?php else: ?>
                            <div class="post-thumbnail">
                                <img width="270" height="160" src="https://otvet.imgsmail.ru/download/689367f58323fc96e83911b5bc5f5902_i-15.jpg" alt="">
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <div class="post-content__post-text">
                                <div class="post-title">
                                    <?php the_title(); ?>
                                </div>
                                <p>
                                    <?php the_excerpt(); ?>
                                    <?php
                                    $post_type = get_post_type(get_the_ID());
                                    if ($post_type == 'discount') :
                                        if (get_field('salle')) :
                                        ?>
                                        Скидка: <?php the_field('salle');?>%
                                        <?php else : ?>
                                        Скидки нет
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="post-content__post-control"><a href="<?php the_permalink(); ?>" class="btn-read-post">Читать далее >></a></div>
                        </div>
                    </div>
                <?php endwhile; else: ?>
                    <p>Ни чего не найдено</p>
                <?php  endif; ?>
                <!-- post-mini_end-->
                <?php
                $args = array(
                    'show_all'     => false, // показаны все страницы участвующие в пагинации
                    'end_size'     => 1,     // количество страниц на концах
                    'mid_size'     => 1,     // количество страниц вокруг текущей
                    'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                    'prev_text'    => __('«'),
                    'next_text'    => __('»'),
                    'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                    'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                    'screen_reader_text' => __( ' ' ),
                );
                the_posts_pagination($args);
                wp_reset_query();
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <!-- sidebar-->
        <?php get_template_part('inc/sidebar'); ?>
    </div>
</div>
<?php get_footer(); ?>