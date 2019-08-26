<?php
/*
Plugin Name: Wpshout Register Ecolo Tips
Plugin URI:
Description: Register a Custom Post Type
Version: 1.0
Author: Fanny
Author URI: https:creativeontheroad.com
Licence: none
*/

function wpshout_register_ecolo_tips(){
    $args = array(
        'public' => true,
        'menu_position' => 20,
        'label' => 'Ecolo Tips'
    );
    register_post_type('ecolo_tips', $args);
}
add_action('init','wpshout_register_ecolo_tips');