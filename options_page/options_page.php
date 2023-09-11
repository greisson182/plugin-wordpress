<?php
/**
 * @package Options Page
 * @version 1.0.0
 */
/*
Plugin Name: Options Page
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Terceiro Plugin
Author: Greisson Silva
Version: 1.0.0
Author URI: http://bootweb.com.br
*/

add_action('admin_menu', 'options_add_menu');

function options_add_menu() {
  add_menu_page(
    'Página de Opções',
    'Opções de Plugin',
    'manage_options',
    'options_page',
    'options_page_layout'
  );
}

function  options_page_layout(){
  require_once(plugin_dir_path(__FILE__) . '/admin/admin.php');
}