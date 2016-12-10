<div class="sidebar">
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Теги</div>
        <div class="sidebar-item__content">
            <ul class="tags-list">
                <?php $args = array(
                    'smallest'                  => 0.9,
                    'largest'                   => 0.9,
                    'unit'                      => 'rem',
                    'number'                    => 45,
                    'format'                    => 'array',
                    'separator'                 => "\n",
                    'orderby'                   => 'name',
                    'order'                     => 'ASC',
                    'exclude'                   => null,
                    'include'                   => null,
                    'topic_count_text_callback' => '',
                    'link'                      => 'view',
                    'echo'                      => false,
                    'child_of'                  => null,
                );
                $tags = (wp_tag_cloud($args));
                ?>
                <?php foreach ($tags as $tag) : ?>
                    <?php $a = new SimpleXMLElement($tag); ?>
                    <li class="tags-list__item">
                        <a href="<?php echo $a['href']; ?>" class="tags-list__item__link">
                            <?php echo (string)$a; ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Категории</div>
        <div class="sidebar-item__content">
            <ul class="category-list">
                <?php wp_list_categories(); ?>
            </ul>
        </div>
    </div>
</div>