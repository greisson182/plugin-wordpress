<?php
/**
 * @package Simples-WP-E-commerce
 * @version 1.0
 */
/*
Plugin Name: Simples WP E-commerce
Description: Plugin simples e vele para criação de pequenas lojas virtuais em qualquer site ou blog.
Author: Greisson Silva
Version: 1.0
Author URI: http://bootweb.com.br
*/

function pr($data) {
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

define('SWPE_PREFIX','swpe_');
define('SWPE_VERSION','1.0.0');
define('SWPE_DIR', plugin_dir_path(__FILE__));
define('SWPE_URL', plugins_url('', __FILE__));

register_activation_hook(__FILE__, 'swpe_install');

function swpe_install() {
  global $wp_version;

  if (version_compare($wp_version, '3.8', '<')) {
    wp_die('Este plugin requer no mínimo a versão 3.8 do Wordpress');

    add_option('swpe_plugin_version', SWPE_VERSION);
  }
}

add_action('after_setup_theme', 'swpe_init_plugin');

function swpe_init_plugin() {
  require_once(SWPE_DIR . 'includes/init.php');

  if (is_admin()) {
    require_once(SWPE_DIR . 'admin/admin.php');
  } else {
    require_once(SWPE_DIR . 'front/front.php');
  }
}