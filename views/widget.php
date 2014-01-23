<?php
$args = array(
    'menu'    			=> $instance['menu'],
    'depth'             => 2,
    'container'         => false,
    'menu_class'        => '',
    'fallback_cb'       => '',
    'items_wrap'        => '<div id="%1$s" class="panel-group">%3$s</div>',
    'walker'            => new Bootstrap_Collapse_Nav_Walker()
);

wp_nav_menu( $args );