<?php get_header(); ?>
<div class="main-content">
    <div class="content-wrapper">
        <div class="content">
            <!-- Вывод записей в цикле -->
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                <h1 class="title-page"><?php the_title(); ?></h1>

                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('article-image', array('class'=>'alignleft'));?>
                <?php else:?>
                    <img class="alignleft" width="380" height="300" src="https://otvet.imgsmail.ru/download/689367f58323fc96e83911b5bc5f5902_i-15.jpg" alt="">
                <?php endif; ?>

                <?php the_content(); ?>

            <?php endwhile; else:?>
                <span>Нет ни одной записи</span>
            <?php endif; ?>
            <span class="nav-previous"></span>
            <span class="nav-next"></span>

            <div class="page-navigation">
                <div class="page-navigation-wrap"><?php previous_post_link('<i class="icon icon-angle-double-left"></i> %link'); ?></div>
                <div class="page-navigation-wrap"><?php next_post_link('%link <i class="icon icon-angle-double-right"></i>'); ?></div>
            </div>
        </div>
        <!-- sidebar-->
        <?php get_template_part('inc/sidebar'); ?>
    </div>
</div>
<?php get_footer(); ?>

