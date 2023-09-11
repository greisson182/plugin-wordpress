<?php
/**
 * @package Plugin_One
 * @version 1.0.0
 */
/*
Plugin Name: Custom Posts
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Segundo Plugin
Author: Greisson Silva
Version: 1.0.0
Author URI: http://bootweb.com.br
*/

add_action('init', 'my_custom_post_product');

function my_custom_post_product() {
  $labels = [
    'name' => 'Produtos',
    'singular_name' => 'Produto',
    'add_new' => 'Adicionar Novo',
    'add_new_item' => 'Adicionar Novo Produto',
    'edit_item' => 'Editar Produto',
    'new_item' => 'Novo Produto',
    'all_items' => 'Todos Produtos',
    'view_item' => 'Visualizar Produtos',
    'search_items' => 'Procurar Produto',
    'not_found' => 'Nenhum Produto encontrado',
    'not_found_in_trash' => 'Nenhum Produto encontrado na lixeira',
    'parent_item_colon' => '',
    'Menu_name' => 'Produtos',
  ];

  $args = [
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_position' => 90,
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt','comments']
  ];

  register_post_type('product', $args);
}

add_filter('post_updated_messages', 'my_updated_messages');

function my_updated_messages($messages) {
  global $post_ID;

  $messages['product'] = [
    0 => '',
    1 => 'Produto Atualizado. <a href="'.esc_url(get_permalink($post_ID)).'" target="_blank" >Visualizar</a>',
    4 => 'Produto Atualizado.',
    6 => 'Produto Publicado. <a href="'.esc_url(get_permalink($post_ID)).'" target="_blank" >Visualizar</a>',
    7 => 'Produto Salvo.',
  ];

  return $messages;
}

add_action('contextual_help', 'my_contextual_help', 10, 3);

function my_contextual_help($contextual_help, $screen_id, $screen) {
  if ('product' == $screen->id) {
    $contextual_help = '<h2>Produtos</h2>
    <p>Texto para auxílio. Este texto deverá ajudar o usuário.</p>';
  } else if ('edit-product' == $screen->id) {
    $contextual_help = '<h2>Produtos</h2>
    <p>Texto para auxílio. Este texto deverá ajudar o usuário.</p>';
  }

  return $contextual_help;
}

add_action('add_meta_boxes', 'product_price_box');

function product_price_box() {
  add_meta_box('product_price_box', 'Preço do Produto', 'product_price_box_content','product','side','low');
}

function product_price_box_content() {
    wp_nonce_field('product_metabox_form_save', 'product_price_box_content_nonce');
  // por padrão retora array, com o true habilidado retorna unico valor
  $price = get_post_meta(get_the_ID(), '_product_price', true);
  ?>
  <label for="product_price"></label>
  <input type="text" id="product_price" name="_product_price" placeholder="Insira o valor" value="<?=esc_attr($price)?>">
  <?php
}

add_action('save_post', 'product_price_box_save');

function product_price_box_save($post_id) {
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
  return;

  if ('product' != get_post_type() || !current_user_can('edit_post', $post_id))
  return;

  check_admin_referer('product_metabox_form_save', 'product_price_box_content_nonce');

  $product_price = sanitize_text_field($_POST['_product_price']);
  
  update_post_meta($post_id, '_product_price', $product_price);

}

add_action('init', 'my_taxonomies_product');

function my_taxonomies_product() {
  $labels = [
    'name' => 'Categorias de Produtos',
    'singular_name' => 'Categoria de Produto',
    'search_items' => 'Procurar por categorias de produto',
    'all_items' => 'Todos as categorias de produtos',
    'parent_item' => 'Categoria de Produto Pai',
    'parent_item_colon' => 'Categoria de Produto Pai',
    'edit_item' => 'Editar Categoria de Produto',
    'update_item' => 'Atualizar Categoria de Produto',
    'add_new_item' => 'Adicionar Categoria de Produto',
    'new_item_name' => 'Nova Categoria de Produto',
    'Menu_name' => 'Categorias de Produto',
  ];

  $args = [
    'labels' => $labels,
    'hierarchical' => true,
  ];

  register_taxonomy('product_category', 'product', $args);
}