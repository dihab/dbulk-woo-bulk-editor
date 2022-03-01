
<?php

function dbulk_show_products_cb(){

    $_REQUEST['pageNum'] ? $pagenum = $_REQUEST['pageNum'] : '1';

    $page_number = $pagenum;
    $products_per_page = 10;
    
    $args = [
    
        'status' => array( 'draft', 'pending', 'private', 'publish','future' ),  
        'type' => array_merge( array_keys( wc_get_product_types() ) ),  
        'parent' => null,  
         'sku' => '',  
       'category' => array(),  
       'tag' => array(),   
        //'offset' => 3, 
        'limit' =>  $products_per_page, 
        'page' => $page_number,  
        'include' => array(),  
        'exclude' => array(),  
        'orderby' => 'date',  
        'order' => 'DESC',  
        'return' => 'objects',  
        'paginate' => true,
        'shipping_class' => array(), 
    
    ]; 
    
    $wc_products = wc_get_products( $args );
    $products = $wc_products->products;
    $pages =  $wc_products->max_num_pages;
    wp_localize_script('dbulk_edit_products-script', 'myAjax', array( 'pages' => $pages));
    /// Get all product type
    $product_types = wc_get_product_types();
    // print_r( $product_types);
    
    //$product_statuses = get_post_statuses();
    $product_statuses = array( 'draft'=>'draft','pending'=> 'pending', 'private'=>'private','publish'=> 'publish','future'=>'future' );

      
    echo "<ul class='pagination_dbulk'>";
    for( $i=1;$i<=$pages;$i++){
        if($page_number==$i){
            echo "<li class='page-num page_now' data-page-num={$i} >{$i}</li>";
        }else{
            echo "<li class='page-num' data-page-num={$i} >{$i}</li>";
        }
        
    }
    echo "</ul>"; 

     ?>
    <tr class="heading_row">
        <th class="col_head_id col-head w5"><?php esc_html_e('ID','dbulk'); ?></th>
        <th class="col_head_img col-head w7"><?php esc_html_e('IMAGE','dbulk'); ?></th>
        <th class="col_head_sku col-head w7"><?php esc_html_e('SKU','dbulk'); ?></th>
        <th class="col_head_title col-head w15"><?php esc_html_e('TITLE','dbulk'); ?></th>
        <th class="col_head_type col-head w5"><?php esc_html_e('TYPE','dbulk'); ?></th>
        <th class="col_head_short_desc col-head w7"><?php esc_html_e('SHORT__DESC','dbulk'); ?></th>
        <th class="col_head_description col-head w7"><?php esc_html_e('DESCRIPTION','dbulk'); ?></th>
        <th class="col_head_tag col-head w7"><?php esc_html_e('TAGS','dbulk'); ?></th>
        <th class="col_head_category col-head w7"><?php esc_html_e('CATEGORY','dbulk'); ?></th>
        <th class="col_head_publish_date col-head w7"><?php esc_html_e('PUBLISH DATE','dbulk'); ?></th>
        <th class="col_head_status col-head w5"><?php esc_html_e('STATUS','dbulk'); ?></th>
        <th class="col_head_galley col-head w5"><?php esc_html_e('GALLERY','dbulk'); ?></th>
        <!-- <th class="col_head_url col-head w7"><?php //esc_html_e('PRODUCT__URL','dbulk'); ?></th> -->
        <th class="col_head_featured col-head w5"><?php esc_html_e('FEATURED','dbulk'); ?></th>
        <th class="col_head_reg_price col-head w5"><?php esc_html_e('REGULAR_PRICE','dbulk'); ?></th>
        <th class="col_head_sale_price col-head w5"><?php esc_html_e('SALE_PRICE','dbulk'); ?></th>
        <th class="col_head_sale_form col-head w5"><?php esc_html_e('SALE FORM','dbulk'); ?></th>
        <th class="col_head_sale_to col-head w5"><?php esc_html_e('SALE TO','dbulk'); ?></th>
        <th class="col_head_stock col-head w5"><?php esc_html_e('TOTAL_STOCK','dbulk'); ?></th>
    </tr>
    <?php

    foreach($products as $product){
     ?>
        <tr>
            <td class="td_id center">
                <?php esc_html_e($product->get_id(),'dbulk'); ?>
            </td>

            <td class="td_img">
                <img class="product_img" data-product-id="<?php echo $product->get_id(); ?>" data-img-id="<?php echo $product->get_image_id(); ?>" src="<?php echo wp_get_attachment_image_url($product->get_image_id()); ?>" alt="">
            </td>

            <td class="td_sku">
                <input class = "td_sku_input" type="text" name="" id="" value="<?php echo $product->get_sku(); ?>" data-product-id="<?php echo $product->get_id(); ?>">
            </td>

            <td class="td_title">
                <input class='td_title_input'  data-product-id="<?php echo $product->get_id(); ?>"
                 type="text" name="" id="" value="<?php echo $product->get_name(); ?>">
            </td>

            <td class="td_type">
                <select data-product-id="<?php echo $product->get_id(); ?>" name="<?php echo "product_type_of_id=".$product->get_id() ?>" id="" class="td_type_input">
                    <?php 
                        foreach($product_types as $value=>$type){
                            ?>
                            <option value="<?php esc_attr_e($value, 'dbulk' )?>" <?php echo $value ==$product->get_type()?'selected':" " ?> >
                            <?php esc_html_e($type,"dbulk")  ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
            </td>

            <td class="td_short_desc ">
                <span class="center td_short_desc_input" data-product-id="<?php echo $product->get_id(); ?>">
                    <?php esc_html_e('short desc','dbulk'); ?>
                </span>
            </td>

            <td class="td_desc" >
                <span class="center td_des_input" data-product-id="<?php echo $product->get_id(); ?>">
                    <?php esc_html_e('description','dbulk'); ?>
                </span>
            </td>

            <td class="td_tag" >
                <span class="center td_tag_input" data-product-id="<?php echo $product->get_id(); ?>">
                    <?php esc_html_e('TAGS','dbulk'); ?>
                </span>
            </td>

            <td class="td_category">
                <span class="center td_category_input"  data-product-id="<?php echo $product->get_id(); ?>" >
                    <?php esc_html_e('Category','dbulk'); ?>
                </span>
            </td>

            <td class="td_publish_date">
                <span class="center">
                <input class="td_publish_date_input" data-product-id="<?php echo $product->get_id(); ?>"
                 type="date" name="" id=""
                 value="<?php echo date( 'Y-m-d', strtotime( $product->get_date_created() )) ?>"
                 >
                </span>
            </td>

            <td class="td_status">
                <select name="" id="" class='td_status_input'  data-product-id="<?php echo $product->get_id(); ?>">
                    <?php
                        foreach($product_statuses as $value=>$status)                      
                        {
                            ?>
                            <option value="<?php echo $value; ?>" 
                                <?php echo $product->get_status()==$value?'selected':" "; ?> >
                                <?php _e($status,'dbilk'); ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
            </td>

            <td class="td_gallery">
                <span class="center td_gallery_input" data-product-id="<?php echo $product->get_id(); ?>">
                    <?php esc_html_e('GALLERY','dbulk'); ?>
                </span>
            </td>

            <!-- <td class="td_url">
                <span class="center">
                    <input type="url" name="" id="" value="<?php //echo esc_url_raw(get_permalink( $product->get_id() )) ?>">
                 </span>
            </td> -->

            <td class="td_featured">
                <span class="center">
                <input class="td_featured_input" data-product-id="<?php echo $product->get_id(); ?>"
                type="checkbox" name="" id="" <?php echo $product->get_featured()==1?'checked':""; ?>>
                </span>
            </td>

            <td class="td_regular_price">
                <span class="center">
                    <input class="td_regular_price_input" data-product-id="<?php echo $product->get_id(); ?>"
                    type="number" name="" id="" value="<?php echo $product->get_regular_price() ?>">
                </span>
            </td>

            <td class="td_sale_price">
                <span class="center">
                <input class="td_sale_price_input" data-product-id="<?php echo $product->get_id(); ?>"
                type="number" name="" id="" 
                value="<?php echo $product->get_sale_price() ?>" 
                >
                </span>
            </td>

            <td class="td_sale_from">
                <span class="center">
                <input data-product-id="<?php echo $product->get_id(); ?>" class="td_sale_from_input" type="date" name="" id="" value="<?php 
               if(date( 'Y-m-d', strtotime($product->get_date_on_sale_from()))=='1970-01-01'){
                   echo ' ';
               }else{
                echo date( 'Y-m-d', strtotime($product->get_date_on_sale_from()));
               }
                
                ?>">
                
                </span>
            </td>

            <td class="td_sale_to">
                <span class="center">
                    <input data-product-id="<?php echo $product->get_id(); ?>" class="td_sale_to_input" type="date" name="" id="" value="<?php 
                        if(date( 'Y-m-d', strtotime($product->get_date_on_sale_to()))=='1970-01-01'){
                            echo ' ';
                        }else{
                            echo date( 'Y-m-d', strtotime($product->get_date_on_sale_to()));
                        }
                     ?>">
                </span>
            </td>

            <td class="td_stock_amount">
                <span class="center">
                    <input class="td_stock_amount_input" data-product-id="<?php echo $product->get_id(); ?>"
                     type="number" name="" id="" value="<?php echo $product->get_stock_quantity(); ?>">
                </span>
            </td>
            
        </tr>
     
     <?php



    }





exit();

}

add_action('wp_ajax_dbulk_show_products', 'dbulk_show_products_cb');