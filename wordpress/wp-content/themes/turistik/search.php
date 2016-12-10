<?php get_header(); ?>
<?php
$data = query_posts(array(
    's' => $_REQUEST['s']
));
?>
<div class="main-content">
    <div class="content-wrapper">
        <div class="content">
            <p class="title-page">Страница поиска</p>
            <p class="">Найдено записей <?php echo count($data); ?></p>
            <!-- Вывод записей в цикле -->
            <?php if (have_posts()) : while (have_posts()): the_post(); ?>
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
            <?php
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </div>
        <!-- sidebar-->
        <?php get_template_part('inc/sidebar'); ?>
    </div>
</div>
<?php get_footer(); ?>

