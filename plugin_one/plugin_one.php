<?php
/**
 * @package Plugin_One
 * @version 1.0.0
 */
/*
Plugin Name: Plugin One
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Primeiro Plugin
Author: Greisson Silva
Version: 1.0.0
Author URI: http://bootweb.com.br
*/

function pr($data) {
  echo '<pre>';
  print_r($data);
  echo '</pre>';
}

define('PONE_REQUIRED_VERSION', '4.0');
define('PONE_URL', plugins_url('', __FILE__ ));
define('PONE_DIR', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, 'pone_activate');

function pone_activate() {
  global $wp_version;

  if (version_compare($wp_version, PONE_REQUIRED_VERSION, '<')) {
    wp_die('Este plugin requer no mínimo a versão ' . PONE_REQUIRED_VERSION . ' do Wordpress.');
  }
}

register_deactivation_hook(__FILE__, 'pone_deactivate');

function pone_deactivate() {

}

require_once(PONE_DIR . 'admin.php');

// gatilho ao salvar um posts
//add_action('save_post', 'pone_save_post');
function pone_save_post() {
  wp_die('Matando salve_post');
}
/*
// sequencia de prioridade
add_action('init', 'pone_action_1', 5);
add_action('init', 'pone_action_2', 6);
add_action('init', 'pone_action_3', 3);

function pone_action_1() {
  var_dump("Action 1");
}

function pone_action_2() {
  var_dump("Action 2");
}

function pone_action_3() {
  var_dump("Action 3");
}*/

//add_filter('the_content', 'pone_alter_the_content');

// concatena conteúdo ao site.
function pone_alter_the_content($content) {
    return $content . '<br/> <p>Bootweb Todos os Direitos Reservados.<p/>';
}

add_filter('the_title', 'pone_custom_title');

// concatena conteúdo ao titulo do post.
function pone_custom_title($title) {
  return $title . ' | Bootweb';
}

// adciona evento em function theme
add_action('after_setup_theme', 'pone_load_plugin');
function pone_load_plugin() {
  require_once(PONE_DIR . 'admin_extensible.php');
}

