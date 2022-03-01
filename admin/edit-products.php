<?php




function dbulk_edit_products_page_html(){

?>

<section class="dbulk_edit_products_page">

    <div class="edit_products_table_container">      
        <table class="edit_products_table">
           
            <!--start php loop of products using ajax call -->               
        </table>               
    </div>
    <div class="modals">
        <!-- Tag modal -->
        <div class="tag_modal modal">  
            <h2>TAgs</h2>        
             <div class="tags_container modal_inner_container">
                
             </div>
            <button class="tag_modal_save_close dbtn">SAVE & CLOSE</button>
            <button class="dcancel dbtn">CANCEL</button>
        </div>
        <!-- Category Modal -->
        <div class="category_modal modal">  
            <h2>Categories</h2>        
             <div class="category_container modal_inner_container">
                
             </div>
            <button class="category_modal_save_close dbtn">SAVE & CLOSE</button>
            <button class="dcancel dbtn">CANCEL</button>
        </div>
        <div class="gallery_modal modal">
                <h2>Gallery</h2>
                 <div class="gallery_container modal_inner_container">
                
                 </div>
                 <button class="add_img dbtn">ADD NEW</button>
                <button class="gallery_modal_save_close dbtn">SAVE & CLOSE</button>
                <button class="dcancel dbtn">CANCEL</button>
        </div>
        <div class="des_modal modal">
                 <!-- <h2>DESCRIPTION</h2> -->
                 <div class="des_container modal_inner_container">
                 <textarea name="" id="editorId" class="editorId">

                 </textarea>
                 </div>
                 <button class="des_modal_save_close dbtn">SAVE & CLOSE</button>
                 <button class="dcancel dbtn">CANCEL</button>
        </div>
        <div class="sdes_modal modal">
                 <!-- <h2>DESCRIPTION</h2> -->
                 <div class="sdes_container modal_inner_container">
                 <textarea name="" id="seditorId" class="seditorId">

                 </textarea>
                 </div>
                 <button class="sdes_modal_save_close dbtn">SAVE & CLOSE</button>
                 <button class="dcancel dbtn">CANCEL</button>
        </div>
    </div>

    

    
        
    
</section>


<?php
}

?>