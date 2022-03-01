<?php


function dbulk_show_gallery_cb(){
     $product_id = $_REQUEST['product_id'];
   
    // print_r($selected_categories);
     $product = wc_get_product( $product_id);
     $img_ids =  $product->get_gallery_image_ids();
     $product->save();
     //print_r($img_ids);

     if(!empty($img_ids)){
        foreach($img_ids as $img_id){
            ?>
             <input class="data_product_id_hidden" type="hidden" name="" value="<?php echo $product_id; ?>">
            <div class="gallery_img_container">
            <span class="del_img">&#10062;</span>
            <img class="gimg" data-img-id="<?php echo $img_id; ?>" data-product-id="<?php echo $product_id; ?>" style="width: 50px; height:50px; object-fit:cover;" src="<?php echo wp_get_attachment_url($img_id); ?>" alt="">
            </div>
           
            <?php
        }

     }else{
         ?>
        <input class="data_product_id_hidden" type="hidden" name="" value="<?php echo $product_id; ?>">
        <?php
     }

    
     
     exit();
}

add_action('wp_ajax_dbulk_show_gallery', 'dbulk_show_gallery_cb');



?>