<?php


function dbulk_show_categories_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);

     // here $categories array contain categories of clicked product 
    $categories = $product->get_category_ids();
    if ( ! empty( $categories ) && ! is_wp_error($categories ) ){

        foreach ( $categories as $category ) {
            $$category_obj = get_term($category);
            $category_array[ $category_obj ->id] = $category_obj ->name;
        }

    }


    $terms = get_terms( 'product_cat' );
    // here $term_array contain all categories of all products 
    $term_array = array();
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $term_array[$term->term_id] = $term->name;
        }
    }

    //print_r( $term_array);
  
    if($term_array){
        
        foreach($term_array as $id=> $term){
             ?>
                <div>
                <input class="dbulk_category" <?php echo in_array($id, $categories)?"checked":" "; ?> type="checkbox" name="<?php echo $id; ?>" id="<?php echo $id; ?>" data-category-value="<?php echo $id;  ?>" data-product-id="<?php echo $product->get_id(); ?>">

                <label for="<?php echo $id; ?>"><?php echo $term;  ?></label>
                <div>
             <?php

        }
      
    }else{
        echo "no category found";
    }
     exit();
}
add_action('wp_ajax_dbulk_show_categories', 'dbulk_show_categories_cb');

?>