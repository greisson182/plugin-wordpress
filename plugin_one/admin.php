<?php

add_action('admin_menu', 'pone_register_menus');

function pone_register_menus() {
  add_options_page('Plugin One','Hello Word!', 'manage_options', 'pone_hello_page','pone_render_page');
}

function pone_render_page() {
  ?>
  <div class="wrap">
    <h2>My Bitly</h2>
    <p class="description">Seja bem vindo ao My Bitlly.</p>

    <?php 
      $products = new WP_Query([
          'post_type' => 'product',
          'post_per_page' => -1,
          'tax_query' => [
            [
              'taxonomy' => 'product_category',
              'field' => 'slug',
              'terms' => 'celulares'
            ]
          ]
      ]);

      if ($products->have_posts() ) {
        while ($products->have_posts()) {

          pr($products->the_post());
          ?>
            <div style="">
              <h3><?=the_title()?></h3>
              <p><?=the_content()?></p>
            </div>
          <?php
        }
      }
    ?>
  </div>
  <?php
}
?>