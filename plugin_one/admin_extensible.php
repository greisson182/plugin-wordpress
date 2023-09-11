<?php

add_action('admin_menu', 'pone_register_menus_ex');

function pone_register_menus_ex() {
  add_options_page('Plugin One Ex','Hello Word! Ex', 'manage_options', 'pone_hello_page_ex','pone_render_page_ex');
}

function pone_render_page_ex() {
  $title = "My Bitly Ex";
  $title = apply_filters('pone_title_page', $title);
  ?>
  <div class="wrap">
    <h2><?=$title?></h2>
    <p class="description">Seja bem vindo ao My Bitlly.</p>
    <?= PONE_URL . '/style.css'?>
  </div>
  <?php
}
?>