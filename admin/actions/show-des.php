
<?php


function dbulk_show_des_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);
     $des = $product->get_description();

    
    $return = array(
        'product_id'  => $product_id,
        'des'       => $des
    );
    wp_send_json($return);
    
     
}

add_action('wp_ajax_dbulk_show_des', 'dbulk_show_des_cb');

function dbulk_save_des_cb(){
    $product_id = $_REQUEST['product_id'];
   $description= $_REQUEST['description'];
    $product = wc_get_product( $product_id);
    $product->set_description($description);
    $product->save();
    exit();
}

add_action('wp_ajax_dbulk_save_des', 'dbulk_save_des_cb');








function dbulk_show_sdes_cb(){
    $product_id = $_REQUEST['product_id'];
    $product = wc_get_product( $product_id);
    $sdes = $product->get_short_description();

   
   $return = array(
       'product_id'  => $product_id,
       'sdes'       => $sdes
   );
   wp_send_json($return);
   
    
}
add_action('wp_ajax_dbulk_show_sdes', 'dbulk_show_sdes_cb');

function dbulk_save_sdes_cb(){
    $product_id = $_REQUEST['product_id'];
   echo $sdescription= $_REQUEST['sdescription'];
    $product = wc_get_product( $product_id);
    $product->set_short_description($sdescription);
    $product->save();
    exit();
}

add_action('wp_ajax_dbulk_save_sdes', 'dbulk_save_sdes_cb');





?>