<?php
/**
 * @since             1.0.0
 * @package           Rock_Convert
 *
 * @wordpress-plugin
 * Plugin Name:       Rock Convert
 * Plugin URI:        https://convert.rockcontent.com/
 * Description:       Publique banners no seu blog de maneira rápida e efetiva, e converta visitantes em subscribers, leads ou clientes sem precisar entender código.
 * Version:           2.8
 * Author:            Stage
 * Author URI:        https://stage.rockcontent.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rock-convert
 * Domain Path:       /languages/
 */

namespace Rock_Convert;

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}

define(__NAMESPACE__ . '\NS', __NAMESPACE__ . '\\');

define(NS . 'PLUGIN_NAME', 'rock-convert');

define(NS . 'PLUGIN_VERSION', '2.8');

define(NS . 'PLUGIN_NAME_DIR', plugin_dir_path(__FILE__));

define(NS . 'PLUGIN_NAME_URL', plugin_dir_url(__FILE__));

define(NS . 'PLUGIN_BASENAME', plugin_basename(__FILE__));

define(NS . 'PLUGIN_TEXT_DOMAIN', 'rock-convert');

define(NS . 'FPDF_FONTPATH', plugin_dir_path(__FILE__) . 'inc/libraries/pdf/font/');

define('ROCK_CONVERT_HELP_CENTER_URL', 'https://ajuda.rockstage.io/categorias/plugin-de-conversao/');
define('ROCK_CONVERT_SUGGEST_FEATURE_URL', 'https://stage.rockcontent.com/plugin-de-conversao/sugerir/');
define('ROCK_CONVERT_REPORT_ERROR_URL', 'https://help.rockcontent.com/pt-br/como-entrar-em-contato-com-o-suporte/');
define('ROCK_CONVERT_BUY_PREMIUM_URL', 'https://stage.rockcontent.com/plugin-de-conversao/premium/');

require_once(PLUGIN_NAME_DIR . 'inc/libraries/autoloader.php');
require PLUGIN_NAME_DIR . 'vendor/autoload.php';

register_activation_hook(__FILE__,
    array(NS . 'Inc\Core\Activator', 'activate'));
register_deactivation_hook(__FILE__,
    array(NS . 'Inc\Core\Deactivator', 'deactivate'));


class Rock_Convert
{

    static $init;

    /**
     * Loads the plugin
     *
     * @access    public
     */
    public static function init()
    {
        if (null == self::$init) {
            self::$init = new Inc\Core\Init();
            self::$init->run();
        }

        return self::$init;
    }

}

function rock_convert_init()
{
    return Rock_Convert::init();
}

$min_php = '5.6.0';

// Check the minimum required PHP version and run the plugin.
if (version_compare(PHP_VERSION, $min_php, '>=')) {
    rock_convert_init();
}
