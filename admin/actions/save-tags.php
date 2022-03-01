
<?php


function dbulk_save_tags_cb(){
     $product_id = $_REQUEST['product_id'];
     $selected_tags = $_REQUEST['selected_tags'];
    // print_r($selected_tags);
     $product = wc_get_product( $product_id);
     $product->set_tag_ids($selected_tags);

     $product->save();  
     exit();
}

add_action('wp_ajax_dbulk_save_tags', 'dbulk_save_tags_cb');




?>