    <?php
/* Environment: functions.php of a child theme whose parent is twentyseventeen */

//enqueue both the parent’s and the child’s stylesheets with ACTION
function childtheme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }
  add_action( 'wp_enqueue_scripts', 'childtheme_enqueue_styles' );//childtheme_enqueue_styles is HOOKED to wp_enqueue_scripts

//customizing the header from the functions.php file of a child theme, thanks to the twentyseventeen_custom_header_args FILTER. 
function my_custom_header_args($args){
    $args['default-image'] = get_theme_file_uri('/assets/images/header-image.jpg');
    return $args;
}
add_filter('twentyseventeen_custom_header_args', 'my_custom_header_args');

//*********Building a widget called mychildtheme widget**********
function mychildtheme_widget_init() {
	register_sidebar( array(
		'name'=> 'My new Widget Area',
		'id' => 'my_new_widget_area',
		'before_widget' => '<aside>',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init','mychildtheme_widget_init');


//*********Building a menu called mychildtheme menu**********
function mychildtheme_register_menu() {
    register_nav_menu('new-menu', __('My New Menu'));
}
add_action('init', 'mychildtheme_register_menu');

