<?php

// Registrar configs
function maristela_config()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('img-post', 370, 200);
  add_image_size('img-post-wide', 700);
  add_image_size('img-depoimento', 150, 150);
}
add_action('after_setup_theme', 'maristela_config');


function maristela_style_and_scripts()
{
  wp_enqueue_style(
    'mm-critical',
    get_template_directory_uri() . '/css/critical.css',
    array(),
    '1.0',
    'all'
  );

  wp_enqueue_script(
    'jquery-slim',
    'https://code.jquery.com/jquery-3.6.1.slim.min.js',
    array(),
    '3.6.1',
    'true'
  );

  wp_enqueue_script(
    'bootstrap',
    'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js',
    array('jquery-slim'),
    '4.6.2',
    'true'
  );

  wp_enqueue_script(
    'owl-carousel',
    get_template_directory_uri() . '/js/owl.carousel.min.js',
    array('jquery'),
    '2.3.4',
    'true'
  );

  wp_enqueue_script(
    'jquery-mask-min',
    get_template_directory_uri() . '/js/jquery.mask.min.js',
    array('jquery'),
    '1.14.16',
    'true'
  );

  wp_enqueue_script(
    'mm-scripts',
    get_template_directory_uri() . '/js/scripts.min.js',
    array('jquery-slim', 'bootstrap', 'owl-carousel', 'jquery-mask-min'),
    '1.0',
    'true'
  );

  wp_enqueue_script(
    'fontawesome',
    'https://use.fontawesome.com/releases/v5.9.0/js/all.js',
    array(),
    '5.9.0',
    'true'
  );
}
// Register style sheet.
add_action('wp_enqueue_scripts', 'maristela_style_and_scripts');

// Registrar o Custom Navigation Walker
require_once get_template_directory() . '/wp_bootstrap_navwalker.php';

// Tamanho do resumo
function custom_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// Registrar o Menu
register_nav_menus(array(
  'principal' => __('Menu Principal', 'maristela'),
  'social' => __('Menu Social', 'maristela'),
));

// Registrar os Post Types
function meus_posts_type()
{
  // Depoimentos
  register_post_type(
    'depoimentos',
    array(
      'labels' => array(
        'name' => __('Depoimentos'),
        'singular_name' => __('Depoimento'),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-format-quote',
      'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
    )
  );

  // Serviços
  register_post_type(
    'servicos',
    array(
      'labels' => array(
        'name' => __('Serviços'),
        'singular_name' => __('Serviço'),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-admin-appearance',
      'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
      'taxonomies' => array('category'),
    )
  );

  // Empresas
  register_post_type(
    'empresas',
    array(
      'labels' => array(
        'name' => __('Empresas'),
        'singular_name' => __('Empresa'),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon' => 'dashicons-format-image',
      'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
      'taxonomies' => array('category'),
    )
  );
}
add_action('init', 'meus_posts_type');

// Remover o block-library/style.css
function wpassist_remove_block_library_css()
{
  wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'wpassist_remove_block_library_css');

// Disable the emoji's
function disable_emojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

  // Remove from TinyMCE
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

// Filter out the tinymce emoji plugin.
function disable_emojis_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

// send headers seo
function hot_set_headers_seo()
{
  header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
  header('X-Frame-Options: sameorigin');
  header('X-XSS-Protection: 1; mode=block');
  header('X-Content-Type-Options: nosniff');
  header('Referrer-Policy: same-origin');
  header("Cache-Control: no-cache, no-store, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: 0");
}
add_action('send_headers', 'hot_set_headers_seo');
