<?php


function dbulk_show_tags_cb(){
     $product_id = $_REQUEST['product_id'];
     $product = wc_get_product( $product_id);

     // here $tags array contain tags of clicked product 
    $tags = $product->get_tag_ids();
    if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){

        foreach ( $tags as $tag ) {
            $tag_obj = get_term($tag);
            $tags_array[ $tag_obj ->id] = $tag_obj ->name;
        }

    }


    $terms = get_terms( 'product_tag' );
    // here $term_array contain all tags of all products 
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
                <input class="dbulk_tags" <?php echo in_array($id, $tags)?"checked":" "; ?> type="checkbox" name="<?php echo $id; ?>" id="<?php echo $id; ?>" data-tag-value="<?php echo $id;  ?>" data-product-id="<?php echo $product->get_id(); ?>">

                <label for="<?php echo $id; ?>"><?php echo $term;  ?></label>
                <div>
             <?php

        }
      
    }else{
        echo "no tags found";
    }
     exit();
}
add_action('wp_ajax_dbulk_show_tags', 'dbulk_show_tags_cb');

?>