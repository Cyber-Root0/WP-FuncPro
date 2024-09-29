<?php
/**
 * Plugin Name: WP FUNCPRO
 * Plugin URI: https://azuriom.com.br
 * Description: WP FuncPro - Plugin de Gerenciamento de Funções do WordPress
 * Author: Bruno Alves
 * Author URI: https://azuriom.com.br
 * Version: 1.1.0
 * License: GPLv2 or later
 *
 * @package wp-funcpro
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
require_once(__DIR__.'/vendor/autoload.php');
use WP\FuncPro\Load;
add_action( 'plugins_loaded', array(Load::class, 'getInstance' ) );


