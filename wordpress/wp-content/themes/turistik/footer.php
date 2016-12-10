<footer class="main-footer">
    <div class="content-footer">
        <div class="bottom-menu">
            <?php
            if (has_nav_menu('bottom')) {
                $args = array(
                    'container' => false,
                    'menu_class' => 'nav-list',
                    'theme_location' => 'bottom',
                    'walker' => new MenuWalker()
                );
                wp_nav_menu($args);
            } else {
                echo '<ul class="nav-list">';
                wp_list_pages( array('depth' => 1, 'title_li' => '' ));
                echo '</ul>';
            }
            ?>
        </div>
        <div class="copyright-wrap">
            <div class="copyright-text"><?php bloginfo('name'); ?><a href="#" class="copyright-text__link"> loftschool 2016</a></div>
        </div>
    </div>
</footer>
</div>
<!-- wrapper_end-->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>