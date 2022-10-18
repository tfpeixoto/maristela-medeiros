<?php

require_once(realpath(__DIR__ . '/Constant.php'));

if (!defined('ABSPATH')) exit;

use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Common\Type;

class MPG_Helper
{
    public static $urls_array;

    // Подключает .mo файл перевода из указанной папки.
    public static function mpg_set_language_folder_path()
    {
        load_plugin_textdomain('mpg', false, dirname(plugin_basename(__DIR__)) . '/lang/');
    }

    // Register additional (monthly) interval for cron because WP hasn't weekly period
    public static function mpg_cron_monthly($schedules)
    {
        $schedules['monthly'] = array(
            'interval' => 60 * 60 * 24 * 30,
            'display' => __('Monthly', 'mpg')
        );

        return $schedules;
    }

    // Register additional (monthly) interval for cron because WP hasn't monthly period
    public static function mpg_cron_weekly($schedules)
    {
        $schedules['weekly'] = array(
            'interval' => 60 * 60 * 24 * 7,
            'display' => __('Weekly', 'mpg')
        );

        return $schedules;
    }

    public static function mpg_activation_events()
    {
	    $is_ajax = isset( $_POST['isAjax'] ) ? (bool) $_POST['isAjax'] : false;
        try {

            if (is_multisite()) {

                // Если это мультисайт, то для каждого мультисайта создаем в БД
                foreach (get_sites() as $site) {

                    $blog_id = intval($site->blog_id);

                    // Если индекс = 1, значит это главный сайт. Его файлы ложим в корень, а для дочерних - в подпапки.
                    // Делаю так на случай того, если мультисйт переделают в обычный, чтобы остались работать пути для главного сайта
                    // (который станет единственным)

                    $blog_index = $blog_id === 1 ? '' : $blog_id;

                    $uploads_folder_path = MPG_UPLOADS_DIR . $blog_index;

                    if (!file_exists($uploads_folder_path)) {
                        mkdir($uploads_folder_path);
                    }


                    $cache_folder_path = MPG_CACHE_DIR . $blog_index;

                    if (!file_exists($cache_folder_path)) {
                        mkdir($cache_folder_path);
                    }

                    MPG_ProjectModel::mpg_create_database_tables($blog_index);
                }
            } else {
                if ( ! file_exists( WP_CONTENT_DIR . '/mpg-uploads' ) ) {
                    mkdir( WP_CONTENT_DIR . '/mpg-uploads' );
                }

                if ( ! file_exists( WP_CONTENT_DIR . '/mpg-cache' ) ) {
                    mkdir( WP_CONTENT_DIR . '/mpg-cache' );
                }

                MPG_ProjectModel::mpg_create_database_tables('');
            }

            if ($is_ajax) {
                echo json_encode(['success' =>  true]);
                wp_die();
            }
        } catch (Exception $e) {
            if ($is_ajax) {

                do_action( 'themeisle_log_event', MPG_NAME, $e->getMessage(), 'debug', __FILE__, __LINE__ );

                echo json_encode([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
                wp_die();
            }
        }
    }




    public static function mpg_send_analytics_data()
    {
      // nothing here.
    }

    // Remove cron task when user deactivate plugin
    public static function mpg_set_deactivation_option()
    {
        wp_clear_scheduled_hook('schedule_execution');
    }


    public static function mpg_admin_assets_enqueue($hook_suffix)
    {
        // echo $hook_suffix;

        // Include styles and scripts in MGP plugin pages only
        if (
            strpos($hook_suffix, 'toplevel_page_mpg-dataset-library') !== false ||
            strpos($hook_suffix, 'mpg_page_mpg-advanced-settings') !== false ||
            strpos($hook_suffix, 'mpg_page_mpg-search-setting') !== false ||
            ( strpos($hook_suffix, '_mpg-project-builder') !== false && ! empty( $_GET['action'] ) && in_array( $_GET['action'], array( 'edit_project', 'from_scratch' ), true ) )
        ) {

            wp_enqueue_script('mpg_listFilter',                 plugins_url('frontend/libs/jquery.listfilter.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_datatable_js',               plugins_url('frontend/libs/dataTables/jquery.dataTables.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_bootstrap_js',               plugins_url('frontend/libs/bootstrap/bootstrap.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_datetime_picker',            plugins_url('frontend/libs/datetimepicker/jquery.datetimepicker.full.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_select2_js',                 plugins_url('frontend/libs/select2/select2.full.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_toast_js',                   plugins_url('frontend/libs/toast/toast.js', __DIR__), array('jquery'));

            wp_enqueue_script('mpg_popper_1_js',                 plugins_url('frontend/libs/popper/popper.min.js', __DIR__), array('jquery'));

            wp_enqueue_script('mpg_tippy_2_js',                 plugins_url('frontend/libs/popper/tippy-bundle.umd.min.js', __DIR__), array('jquery'));
            wp_enqueue_script('mpg_main_js',                    plugins_url('frontend/js/app.js', __DIR__), array('jquery'));

            wp_localize_script('mpg_main_js', 'backendData', [
                'baseUrl'           => self::mpg_get_base_url(false),
                'lang_code'         => defined( 'ICL_LANGUAGE_CODE' ) && 'en' !== ICL_LANGUAGE_CODE ? sprintf( '/%s/', ICL_LANGUAGE_CODE ) : '',
                'datasetLibraryUrl' => admin_url('admin.php?page=mpg-dataset-library'),
                'projectPage'       => admin_url('admin.php?page=mpg-project-builder'),
                'mpgAdminPageUrl'   => admin_url(),
                'mpgUploadDir'      => MPG_CACHE_URL,
            ]);

            wp_enqueue_style('mpg_datatable',                   plugins_url('frontend/libs/dataTables/jquery.dataTables.min.css', __DIR__));
            wp_enqueue_style('mpg_bootstrap_css',               plugins_url('frontend/libs/bootstrap/bootstrap.min.css', __DIR__));
            wp_enqueue_style('mpg_datetimepicker_css',          plugins_url('frontend/libs/datetimepicker/jquery.datetimepicker.full.min.css', __DIR__));
            wp_enqueue_style('mpg_toast_css',                   plugins_url('frontend/libs/toast/toast.css', __DIR__));
            wp_enqueue_style('mpg_select2_css',                 plugins_url('frontend/libs/select2/select2.min.css',   __DIR__));

            wp_enqueue_style('mpg_font_awesome_css',            plugins_url('frontend/css/font-awesome.css',   __DIR__));

            wp_enqueue_style('mpg_main_css',                    plugins_url('frontend/css/style.css', __DIR__));
        }
    }

    public static function mpg_front_assets_enqueue()
    {

        if (is_search()) {
            wp_enqueue_script('mpg_searchpage', plugins_url('frontend/js/mpg-front-search.js', __DIR__),  array('jquery'));

            wp_localize_script('mpg_searchpage', 'backendData', [
                'ajaxurl'           => admin_url('admin-ajax.php'),
                'mpgUploadDir'      => MPG_CACHE_URL,
            ]);
        }
    }


    public static function mpg_add_type_attribute($tag, $handle, $src)
    {
        // if not your script, do nothing and return original $tag
        if ('mpg_js' !== $handle) {
            return $tag;
        }
        // change the script tag by adding type="module" and return it.
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        return $tag;
    }

    public static function mpg_get_site_url()
    {

        global $blog_id;

        if (is_multisite()) {
            $current_blog_details = get_blog_details(array('blog_id' => $blog_id));
            $blog_url = str_replace( $current_blog_details->path, '', trim( get_home_url( $blog_id, '/', 'relative' ) ) );
            $siteName = str_replace( self::mpg_get_domain(), '', $blog_url );
        } else {
            if ( function_exists( 'icl_get_home_url' ) ) {
                $siteName = str_replace(self::mpg_get_domain(), '', trim(icl_get_home_url(), '/'));
                $siteName = ltrim( rtrim( $siteName, '/' ), '/' );
            } else {
                $siteName = str_replace(self::mpg_get_domain(), '', trim(home_url('/', 'relative'), '/'));
            }
        }
        return trim($siteName);
    }

    // Return site URL
    public static function mpg_get_domain()
    {
        if (defined('WP_HOME')) {
            return WP_HOME;
        } else {
            return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        }
    }


    public static function mpg_get_base_url($for_main_site)
    {
        $blog_id = get_current_blog_id();

        if (is_multisite()) {
            $sites =  get_sites();

            $base_url = '';

            if ($for_main_site) {
                $base_url = self::mpg_get_domain() . $sites[0]->path;
            } else {

                $site = array_filter($sites, function ($site) use ($blog_id) {
                    return (int) $site->blog_id === $blog_id;
                });

                if (!function_exists('array_key_first')) {
                    function array_key_first(array $arr)
                    {
                        foreach ($arr as $key => $unused) {
                            return $key;
                        }
                        return NULL;
                    }
                }

                $index = array_key_first($site);
                $base_url = self::mpg_get_domain() . $site[$index]->path;
            }
        } else {
            $base_url = self::mpg_get_domain() . '/' . self::mpg_get_site_url();
        }

        if (substr($base_url, -1) === '/') {
            // Обрежем слеш в конце, если есть
            $base_url = substr($base_url, 0, -1);
        }
        if ( defined( 'ICL_LANGUAGE_CODE' ) && 'en' !== ICL_LANGUAGE_CODE ) {
            $base_url = $base_url . '/' . ICL_LANGUAGE_CODE;
            $base_url = rtrim( $base_url, '/' );
        }

        return $base_url;
    }

    // Return the path of URL
    public static function mpg_get_request_uri()
    {
        global $wp;
        $full_url_path = home_url($wp->request);
        $current_url = urldecode( str_ireplace( home_url(), '/', $full_url_path ) . '/' );
        $current_url = preg_replace( '/(\/+)/', '/', $current_url );
        return strtolower($current_url);
    }

    public static function mpg_get_extension_by_path($path)
    {

        $regexp = '/format=(xlsx|ods|csv)/s';

        preg_match_all($regexp, $path, $matches, PREG_SET_ORDER, 0);

        // Если это ссылка на Gooole Drive ( шареный документ, то ок), а если нет - то берем из конца строки,
        // то что после последней точки
        if ($matches) {
            return $matches[0][1];
        } else {

            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            // Если в расширении есть точка - обрезаем,
            return strpos($ext, '.') === 0 ? ltrim($ext, $ext[0]) : $ext;
        }
    }

    public static function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::array_flatten($value));
            } else {
                $result = array_merge($result, array($key => $value));
            }
        }
        return $result;
    }

    public static function mpg_header_code_container()
    {

        $code = '';

        echo $code;
    }

    public static function mpg_get_direct_csv_link($raw_link, $worksheet_id = null)
    {

        // false = substring was not found in target string
        if (strpos($raw_link, 'docs.google.com') !== false or strpos($raw_link, 'drive.google.com') !== false) {

            $documentId = str_replace([
                'https://docs.google.com/spreadsheets/d/',
                'https://drive.google.com/file/d/',
                '/view?usp=sharing',
                '/edit?usp=sharing'
            ], ['', '', '', ''], $raw_link);

            $final_url = 'https://docs.google.com/spreadsheets/d/' . $documentId . '/export?format=csv&id=' . $documentId;

            if ($worksheet_id) {
                $final_url .=  '&gid=' . $worksheet_id;
            }
            return $final_url;
        }

        return $raw_link;
    }

    public static function mpg_get_spout_reader_by_extension($ext)
    {

        if ($ext === 'csv') {
            $reader = ReaderFactory::createFromType(Type::CSV); // for CSV files
        } else if ($ext === 'xlsx') {
            $reader = ReaderFactory::createFromType(Type::XLSX); // for XLSX files
        } elseif ($ext === 'ods') {
            $reader = ReaderFactory::createFromType(Type::ODS); // for ODS files
        } else {
            throw new Exception(__('Unsupported file extension:' . ' ' . $ext, 'mpg'));
        }

        return $reader;
    }





    public static function mpg_get_dataset_array( stdClass $project = null )
    {
        $project_id         = isset( $project->id ) ? $project->id : 0;
        $dataset_path       = isset( $project->source_path ) ? $project->source_path : '';
        $periodicity        = isset( $project->schedule_periodicity ) ? $project->schedule_periodicity : null;
        $source_direct_link = isset( $project->original_file_url ) ? $project->original_file_url : '';
        $worksheet_id       = isset( $project->worksheet_id ) ? $project->worksheet_id : '';
        $space_replacer     = isset( $project->space_replacer ) ? $project->space_replacer : '';
        $url_structure      = isset( $project->url_structure ) ? $project->url_structure : '';
        $source_type        = isset( $project->source_type ) ? $project->source_type : '';

        global $mpg_dataset;
        if ( ! empty( $mpg_dataset[ $project_id ] ) ) {
            return $mpg_dataset[ $project_id ];
        }

        $expiration = 0;
        if ( null === $periodicity ) {
            $expiration = apply_filters( 'mpg_live_data_update_interval', MINUTE_IN_SECONDS * 15 );
        }

        $key_name = wp_hash( 'dataset_array_' . $project_id );
        $dataset_array = get_transient( 'dataset_array_' . $project_id );
        if ( false === $dataset_array ) {
            $dataset_array = get_transient( $key_name );
        }

        if ( false === strpos( $dataset_path, 'wp-content' ) ) {
            $dataset_path = MPG_UPLOADS_DIR . $dataset_path;
        }

        $dataset_array = array();
        if ( empty( $dataset_array ) && $expiration > 0 ) {
            if ( ! empty( $source_direct_link ) ) {
                if ( 'upload_file' === $source_type ) {
                    $source_direct_link = $dataset_path;
                }
                $direct_link = MPG_Helper::mpg_get_direct_csv_link( $source_direct_link, $worksheet_id );
                $ext = MPG_Helper::mpg_get_extension_by_path( $direct_link );
                $download_file = MPG_DatasetModel::download_file( $direct_link, $dataset_path );
                $urls_array = MPG_ProjectModel::mpg_generate_urls_from_dataset( $dataset_path, $url_structure, $space_replacer );
                $fields_array = array();
                self::$urls_array = $urls_array;
                $fields_array['urls_array'] = json_encode( $urls_array );
                MPG_ProjectModel::mpg_update_project_by_id( $project_id, $fields_array );
            }
        }

        if (!$dataset_array) {
            $dataset_array = [];
            $ext = MPG_Helper::mpg_get_extension_by_path($dataset_path);
            $reader = MPG_Helper::mpg_get_spout_reader_by_extension($ext);
            $reader->open($dataset_path);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $row = $row->toArray();
                    if ($row[0] !== NULL) {
                        $dataset_array[] = $row;
                    }
                }
            }
            set_transient( $key_name, $dataset_array, $expiration );
        }
        if ( ! doing_action( 'wp_ajax_mpg_get_search_results' ) ) {
            $mpg_dataset[ $project_id ] = $dataset_array;
        }
        return $dataset_array;
    }

    static function mpg_string_start_with($str, $needle)
    {
        return substr($str, 0, 1) === $needle;
    }


    static function mpg_string_end_with($str, $needle)
    {
        return substr($str, -1, 1) === $needle;
    }

    public static function mpg_prepare_post_excerpt($short_codes, $strings, $post_content)
    {
        $string = preg_replace('/\[.*?\]/m', '', $post_content);
        $string = str_replace(["\r", "\n"], ['', ''], $string);
        $string = strip_tags($string);
        $string = wp_trim_words($string, (int) get_option('mpg_search_settings')['mpg_ss_excerpt_length']);

        return preg_replace($short_codes, $strings, $string);
    }

    public static function mpg_unique_array_by_field_value($array, $field)
    {
        $unique_array = [];
        foreach ($array as $element) {
            $hash = $element[$field];
            $unique_array[$hash] = $element;
        }

        return array_values($unique_array);
    }
}
