<?php

/* Plugin Name: Remove Hook */

add_action('wp_head', 'remove');
function remove() {
    remove_action('my_hook', 'writing_some_text');
}