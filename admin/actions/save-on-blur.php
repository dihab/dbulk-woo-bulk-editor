<?php


//// action for save title
function dbulk_save_title_cb(){
     $product_id = $_REQUEST['product_id'];
     $product_title = $_REQUEST['product_title'];
     $product = wc_get_product( $product_id);
     $product->set_name($product_title);
     $product->save();
     exit();
}
add_action('wp_ajax_dbulk_save_title', 'dbulk_save_title_cb');

//// action for save sku
function dbulk_save_sku_cb(){
     $product_id = $_REQUEST['product_id'];
     $product_sku = $_REQUEST['product_sku'];
     $product = wc_get_product( $product_id);
     $product->set_sku($product_sku);
     $product->save();
     exit();
}
add_action('wp_ajax_dbulk_save_sku', 'dbulk_save_sku_cb');

/// save product type
function dbulk_save_type_cb(){
     $product_id = $_REQUEST['product_id'];
     $product_type = $_REQUEST['product_type'];

     if($product_type=='simple'){
          $product = new WC_Product_Simple($product_id);
     }elseif( $product_type=='grouped'){
          $product = new WC_Product_Grouped($product_id);
     }elseif($product_type=='external'){
          $product = new WC_Product_External($product_id);
     }elseif($product_type=='variable'){
          $product = new WC_Product_Variable($product_id);
     }else{
          echo "fail to find type";
     }
     $product->save();
     exit();
}
add_action('wp_ajax_dbulk_save_type', 'dbulk_save_type_cb');

/// save product status
function dbulk_save_status_cb(){
     $product_id = $_REQUEST['product_id'];
     $product_status = $_REQUEST['product_status'];

     

      if($product_status=='publish'){


          
 
          // This is a format that date_create() will accept
          $utc_timestamp_converted = date( 'Y-m-d H:i:s', time() );
          
          $output_format = 'Y-m-d H:i:s';
          
          // Now we can use our timestamp with get_date_from_gmt()
          $local_timestamp = get_date_from_gmt( $utc_timestamp_converted , $output_format );
          $arg = array(
               'ID' =>$product_id,
               'post_status'   => $product_status,
               'edit_date'     => true,
               'post_date_gmt' => $local_timestamp,


           );
           wp_update_post( $arg );

      }else{

          $arg = array(
               'ID' =>$product_id,
               'post_status'   => $product_status,
               'edit_date'     => true,
           );
           wp_update_post( $arg );

      }


    
  
     exit();
}
add_action('wp_ajax_dbulk_save_status', 'dbulk_save_status_cb');


/// action for save date
function dbulk_save_product_publish_date_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);
     $product_publish_date = $_REQUEST['product_publish_date'];

     if($product_publish_date){
          /// convert normal date to unixtimstamp
          $d = DateTime::createFromFormat('Y-m-d', $product_publish_date );
          $unictimestamp =  $d->getTimestamp();
          /// unix timestamp to ISO8601
          $ISO8601_date = date_format(date_timestamp_set(new DateTime(), $unictimestamp), 'c');
          // set date
          $product->set_date_created($ISO8601_date);
          
          // echo $product->get_date_created(  );
          $product->save();
     }
    

     exit();
}
add_action('wp_ajax_dbulk_save_product_publish_date', 'dbulk_save_product_publish_date_cb');




/// action for save sale from date
function dbulk_save_product_sale_from_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);
     $product_sale_from = $_REQUEST['product_sale_from'];
    
     if($product_sale_from){
          /// convert normal date to unixtimstamp
          $d = DateTime::createFromFormat('Y-m-d', $product_sale_from);
          $unictimestamp =  $d->getTimestamp();
          /// unix timestamp to ISO8601
          $ISO8601_date = date_format(date_timestamp_set(new DateTime(), $unictimestamp), 'c');
          // set date
          $product->set_date_on_sale_from($ISO8601_date);
               
          // echo $product->get_date_created(  );
          $product->save();
     }

     exit();
}
add_action('wp_ajax_dbulk_save_product_sale_from', 'dbulk_save_product_sale_from_cb');


/// action for save sale to date
function dbulk_save_product_sale_to_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);
     $product_sale_to = $_REQUEST['product_sale_to'];
    
     if($product_sale_to){
          /// convert normal date to unixtimstamp
          $d = DateTime::createFromFormat('Y-m-d', $product_sale_to);
          $unictimestamp =  $d->getTimestamp();
          /// unix timestamp to ISO8601
        echo  $ISO8601_date = date_format(date_timestamp_set(new DateTime(), $unictimestamp), 'c');
          // set date
          $product->set_date_on_sale_to($ISO8601_date);
               
          // echo $product->get_date_created(  );
          $product->save();
     }

     exit();
}
add_action('wp_ajax_dbulk_save_product_sale_to', 'dbulk_save_product_sale_to_cb');





//// action for save as featured or change from featured
function dbulk_featured_actione_cb(){
     $product_id = $_REQUEST['product_id'];

     $product = wc_get_product( $product_id);

     if($product->get_featured()==1){
          $product->set_featured(0);
          $product->save();
     }else{
          $product->set_featured(1);
          $product->save();
     }
    
   
     
     exit();
}
add_action('wp_ajax_dbulk_featured_action', 'dbulk_featured_actione_cb');



//// action for save as reg price
function dbulk_save_reg_price_cb(){
     $product_id = $_REQUEST['product_id'];
     $reg_price = $_REQUEST['reg_price'];

     $product = wc_get_product( $product_id);
     $product->set_regular_price($reg_price);
     $product->save();
     exit();
}
add_action('wp_ajax_dbulk_save_reg_price', 'dbulk_save_reg_price_cb');




//// action for save as sale price
function dbulk_save_sale_price_cb(){
     $product_id = $_REQUEST['product_id'];
     $sale_price = $_REQUEST['sale_price'];

     $product = wc_get_product( $product_id);
     $product->set_sale_price($sale_price);
     $product->save();
     exit();
}
add_action('wp_ajax_dbulk_save_sale_price', 'dbulk_save_sale_price_cb');



//// action for save stock amount
function dbulk_save_stock_amount_cb(){
     global $woocommerce;
     $product_id = $_REQUEST['product_id'];
     $stock = floatval($_REQUEST['stock']);
     // $product->set_stock_quantity($stock);
     // $product->save();


      $product = wc_get_product( $product_id);
      $product->set_manage_stock(true);
      wc_update_product_stock( $product, $stock);

     //  if($product->get_stock_status()=='instock' && $product->get_stock_status()==null){

     //  }else{
     //      $product->set_manage_stock(true);
     //      $product->set_stock_status('instock');
     //      wc_update_product_stock( $product, $stock,'set',true);
     //  }


      

    
    
     exit();
}
add_action('wp_ajax_dbulk_save_stock_amount', 'dbulk_save_stock_amount_cb');




?>