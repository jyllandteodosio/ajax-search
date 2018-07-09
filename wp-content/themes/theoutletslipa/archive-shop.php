<?php

add_action( 'genesis_before_content_sidebar_wrap', 'add_archivebanner' );
function add_archivebanner() {
    get_template_part('template/archive', 'banner');
}

genesis();