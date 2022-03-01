<?php


function dbulk_save_categories_cb(){
     $product_id = $_REQUEST['product_id'];
     $selected_categories = $_REQUEST['selected_categories'];
    // print_r($selected_categories);
     $product = wc_get_product( $product_id);
     $product->set_category_ids($selected_categories);
      $product->save();
   
    exit();
}

add_action('wp_ajax_dbulk_save_categories', 'dbulk_save_categories_cb');



?>