<?php


function dbulk_save_gallery_cb(){
     $product_id = $_REQUEST['product_id'];
     $img_ids = $_REQUEST['img_ids'];
     print_r($img_ids);
     $product = wc_get_product( $product_id);
     $product->set_gallery_image_ids($img_ids);
     $product->save();  
     exit();
}

add_action('wp_ajax_dbulk_save_gallery', 'dbulk_save_gallery_cb');


function dbulk_save_productimg_cb(){
    $product_id = $_REQUEST['product_id'];
    $img_id = $_REQUEST['img_id'];
    $product = wc_get_product( $product_id);
    $product->set_image_id($img_id);
    $product->save();  
    exit();
}

add_action('wp_ajax_dbulk_save_productimg', 'dbulk_save_productimg_cb');





?>