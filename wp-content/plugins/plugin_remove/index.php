
<!-- När man skriver "plugin name" så skapas ett plugin bland wp plugins -->


<?php

/* Plugin Name: Remove Hook */

add_action('wp_head', 'remove');
function remove() {
    remove_action('my_hook', 'my_function');
}
