<?php

//Chamar a tag title
function maristela_title_tag() {
	add_theme_support('title-tag');
}
add_action('after_setup_theme', 'maristela_title_tag');

// Prevenir o erro na tag title em versões antigas
if (!function_exists('wp_render_title_tag')) {
	function maristela_render_title() {
		?>
		<title><?php wp_title('|', true, 'right'); ?></title>
		<?php
	}
	add_action('wp_head', 'maristela_render_title');
}

// Registrar o Custom Navigation Walker
require_once get_template_directory() . '/wp_bootstrap_navwalker.php';

// Tamanho do resumo
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Registrar o Menu
register_nav_menus( array(
	'principal' => __('Menu Principal', 'maristela'),
	'social' => __('Menu Social', 'maristela'),
));

// Registrar os Post Types
function meus_posts_type(){
	// Depoimentos
	register_post_type('depoimentos',
		array(
			'labels' 					=> array(
				'name' 					=> __('Depoimentos'),
				'singular_name' => __('Depoimento'),
			),
			'public' 					=> true,
			'has_archive' 		=> false,
			'menu_icon'				=> 'dashicons-format-quote',
			'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes'),
		)
	);

	// Serviços
	register_post_type('servicos',
		array(
			'labels' 					=> array(
				'name' 					=> __('Serviços'),
				'singular_name' => __('Serviço'),
			),
			'public' 					=> true,
			'has_archive' 		=> false,
			'menu_icon'				=> 'dashicons-admin-appearance',
			'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes'),
			'taxonomies'      => array( 'category' ),
		)
	);
}
add_action('init', 'meus_posts_type');

// Ativer thumbnail
add_theme_support('post-thumbnails');
add_image_size( 'img-post', 370, 200 ); // 300 pixels wide (and unlimited height)
add_image_size( 'img-post-wide', 700 ); 
add_image_size( 'img-depoimento', 150, 150 ); 

?>