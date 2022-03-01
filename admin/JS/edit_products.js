

// tags modal box
let tag_modal = document.querySelector('.tag_modal');
let category_modal =  document.querySelector('.category_modal');
let gallery_modal = document.querySelector('.gallery_modal');
let gallery_container = document.querySelector('.gallery_container');

let des_modal = document.querySelector('.des_modal');
let sdes_modal = document.querySelector('.sdes_modal');

// open media button
let open_media  = document.querySelector('.add_img');





/// show products on page load
dbulk_show_products()





document.querySelector('.edit_products_table').addEventListener('click',function(e){
   /// handling pagination click
    if(e.target.classList.contains('page-num')){
            let pageNum =  e.target.getAttribute('data-page-num');
            dbulk_show_products(pageNum);
    }


        /// action after clicking on short description field

        if(e.target.classList.contains('td_short_desc_input')){

            let product_id = e.target.getAttribute('data-product-id');
    
            sdes_modal.style.display = 'block';
            
            jQuery(document).ready( function() {
    
                jQuery.ajax({
        
                    type : "POST",
                    url : ajaxurl,
                    data : {
                    action: "dbulk_show_sdes", 
                    product_id : product_id,
                    },          
                    
                                    
                    success: function(response){
                    
                        wp.editor.remove('seditorId')        
                        document.getElementById("seditorId").innerHTML = " ";
                        wp.editor.initialize('seditorId',{
                            tinymce: {
                            height : "50vh",
                            wpautop: true,
                            plugins : 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
                            toolbar1: 'bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv',
                            toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
                            },
                            quicktags: true,
                            mediaButtons: true,
                            
                            
                        });
                        /// set editor content
                        var activeEditor = tinyMCE.get('seditorId');
                        activeEditor.setContent(response.sdes);
                        sdes_modal.setAttribute('data-product-id',response.product_id);
                        /// get editor content
                        // var content = tinymce.activeEditor.getContent();            
            
                    }  
                
                
                })           
            })
    
        }



    /// action after clicking on description field

    if(e.target.classList.contains('td_des_input')){

        let product_id = e.target.getAttribute('data-product-id');

        des_modal.style.display = 'block';
        
        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_show_des", 
                product_id : product_id,
                },          
                
                                
                success: function(response){
                
                    wp.editor.remove('editorId')        
                    document.getElementById("editorId").innerHTML = " ";
                    wp.editor.initialize('editorId',{
                        tinymce: {
                        height : "50vh",
                        wpautop: true,
                        plugins : 'charmap colorpicker compat3x directionality fullscreen hr image lists media paste tabfocus textcolor wordpress wpautoresize wpdialogs wpeditimage wpemoji wpgallery wplink wptextpattern wpview',
                        toolbar1: 'bold italic underline strikethrough | bullist numlist | blockquote hr wp_more | alignleft aligncenter alignright | link unlink | fullscreen | wp_adv',
                        toolbar2: 'formatselect alignjustify forecolor | pastetext removeformat charmap | outdent indent | undo redo | wp_help'
                        },
                        quicktags: true,
                        mediaButtons: true,
                        
                        
                    });
                    /// set editor content
                    var activeEditor = tinyMCE.get('editorId');
                    activeEditor.setContent(response.des);
                    des_modal.setAttribute('data-product-id',response.product_id);
                    /// get editor content
                    // var content = tinymce.activeEditor.getContent();            
        
                }  
            
            
            })           
        })

    }

    // show tag modal  click on tags fields
    if(e.target.classList.contains('td_tag_input')){
                 tag_modal.style.display='block';
                 let product_id = e.target.getAttribute('data-product-id');

                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_show_tags", 
                        product_id : product_id,
                        },          
                        success: function(response){
                            tag_modal.querySelector('.tags_container').innerHTML = response;
            
                        }            
                    })           
                })
    }
    // show category modal after clicking category field
    if(e.target.classList.contains('td_category_input')){
        category_modal.style.display='block';
       let product_id = e.target.getAttribute('data-product-id')

        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_show_categories", 
                product_id : product_id,
                },          
                success: function(response){
                    category_modal.querySelector('.category_container').innerHTML = response;
    
                }            
            })           
        })
     }

     // show gallery modal after clicking gallery filed 
     if(e.target.classList.contains('td_gallery_input')){
         gallery_modal.style.display='block';
       let product_id = e.target.getAttribute('data-product-id')

        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_show_gallery", 
                product_id : product_id,
                },          
                success: function(response){
                    gallery_modal.querySelector('.gallery_container').innerHTML = response;
    
                }            
            })           
        })
     }   
     //// product img click handle
    // show media library after clicking on product img
     if(e.target.classList.contains('product_img')){

        let  product_id = e.target.getAttribute('data-product-id');
        var frame;
        if ( frame ) {
            frame.open();
            return;
          }
          
          // Create a new media frame
          frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
              text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
          });
      
          
          // When an image is selected in the media frame...
          frame.on( 'select', function() {
            
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
      
                        


            e.target.src = attachment.url;
            let img_id = attachment.id;
            
          jQuery(document).ready( function() {

            jQuery.ajax({
   
               type : "POST",
               url : ajaxurl,
               data : {
               action: "dbulk_save_productimg", 
               img_id : img_id,
               product_id: product_id
               } ,
                    
                         
            }) 

         })
      

 
          });
      
          // Finally, open the modal on click
          frame.open();

   

     }
      /// handling featured status on click of featured checkbox
     if(e.target.classList.contains('td_featured_input')){

        let  product_id = e.target.getAttribute('data-product-id');
        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_featured_action", 
                product_id : product_id,
                },          
                success: function(response){
                 
    
                }            
            })           
        })


     }


     
    


})



/// get all cancel button and add event
let cancel_btns = document.querySelectorAll('.dcancel');
for(i=0;i<cancel_btns.length;i++){
    
    cancel_btns[i].addEventListener('click',(e)=>{
        // hide the parent elemet of the button that mean full modal
        e.target.parentNode.style.display='none'
    })
}

///  save tags btn action after clciking
let save_tags_btns = document.querySelectorAll('.tag_modal_save_close');
for(i=0;i<save_tags_btns.length;i++){
    
    save_tags_btns[i].addEventListener('click',(e)=>{

       let product_id = e.target.parentNode.querySelector('.dbulk_tags').getAttribute('data-product-id');

       let selected_tags_element = document.querySelectorAll('.dbulk_tags'); 
       
       let selected_tags = [];

        for (let i = 0; i < selected_tags_element.length; i++) {

           if(selected_tags_element[i].checked == true){
               selected_tags.push(selected_tags_element[i].getAttribute('data-tag-value'));
           }
            
        }
            
        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_save_tags", 
                selected_tags : selected_tags,
                product_id: product_id
                } ,
                success: function(response){
                    e.target.parentNode.style.display='none'; 
                }        
                          
            }) 

        })
        
       
    })
}




///action after clicking  save category btn 
let save_categories_btns = document.querySelectorAll('.category_modal_save_close');
for(i=0;i<save_categories_btns.length;i++){
    
    save_categories_btns[i].addEventListener('click',(e)=>{

       let product_id = e.target.parentNode.querySelector('.dbulk_category').getAttribute('data-product-id');

       let selected_category_element = document.querySelectorAll('.dbulk_category'); 
       
       let selected_categories = [];

        for (let i = 0; i < selected_category_element.length; i++) {

           if(selected_category_element[i].checked == true){
            selected_categories.push(selected_category_element[i].getAttribute('data-category-value'));
           }
            
        }
            
        jQuery(document).ready( function() {

            jQuery.ajax({
    
                type : "POST",
                url : ajaxurl,
                data : {
                action: "dbulk_save_categories", 
                selected_categories : selected_categories,
                product_id: product_id
                } ,
                success: function(response){
                    e.target.parentNode.style.display='none'; 
                }        
                          
            }) 

        })
        
       
    })
}


////actions after clicking add img button on gallery modal
open_media.addEventListener('click',function(e){

     
         var frame;
        // If the media frame already exists, reopen it.
        if ( frame ) {
            frame.open();
            return;
          }
          
          // Create a new media frame
          frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
              text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
          });
      
          
          // When an image is selected in the media frame...
          frame.on( 'select', function() {
            
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
      
            // Send the attachment URL to our custom image input field.
            //
            gallery_container.insertAdjacentHTML('beforeend',
            `<div class="gallery_img_container">
            <span class="del_img">&#10062;</span>
            <img class="gimg" data-img-id=`+attachment.id+` style="width: 50px; height:50px; object-fit:cover;" src="`+attachment.url+`" alt="">
            </div>`);
      

 
          });
      
          // Finally, open the modal on click
          frame.open();
        

})


/// handling delete img buton in gallery container
document.querySelector('.gallery_modal').addEventListener('click',function(e){
    if(e.target.classList.contains('del_img')){
        e.target.parentNode.remove();
    }
})

/// handling save gallery button action
document.querySelector('.gallery_modal_save_close').addEventListener('click',(e)=>{
   let product_id = e.target.parentNode.querySelector('.data_product_id_hidden').value;
  
   let imgs =  e.target.parentNode.querySelectorAll('.gimg');
   let img_ids = [];
   for(i=0;i<imgs.length;i++){
       let img_id = imgs[i].getAttribute('data-img-id');
       img_ids.push(img_id);
   }

   jQuery(document).ready( function() {

    jQuery.ajax({

        type : "POST",
        url : ajaxurl,
        data : {
        action: "dbulk_save_gallery", 
        img_ids : img_ids,
        product_id: product_id
        } ,
        success: function(response){
            e.target.parentNode.style.display='none'; 
        }        
                  
    }) 

})
    
})


/// handling save description btn button action
document.querySelector('.des_modal_save_close').addEventListener('click',(e)=>{
    let product_id = e.target.parentNode.getAttribute('data-product-id');
   
    let description = tinymce.activeEditor.getContent(); 
    console.log(description)
    jQuery(document).ready( function() {
 
     jQuery.ajax({
 
         type : "POST",
         url : ajaxurl,
         data : {
         action: "dbulk_save_des", 
         description : description,
         product_id: product_id
         } ,
         success: function(response){
             e.target.parentNode.style.display='none'; 
         }        
                   
     }) 
 
 })
     
 })
 

/// handling save short description btn button action
document.querySelector('.sdes_modal_save_close').addEventListener('click',(e)=>{
    let product_id = e.target.parentNode.getAttribute('data-product-id');
   
    let sdescription = tinymce.activeEditor.getContent(); 
    //console.log(sdescription)
    jQuery(document).ready( function() {
 
     jQuery.ajax({
 
         type : "POST",
         url : ajaxurl,
         data : {
         action: "dbulk_save_sdes", 
         sdescription : sdescription,
         product_id: product_id
         } ,
         success: function(response){
             e.target.parentNode.style.display='none'; 
         }        
                   
     }) 
 
 })
     
 })
 


/////// blur actions ///////
document.querySelector('.edit_products_table').addEventListener('blur',function(e){
   
             //// actions for save title
            if(e.target.classList.contains('td_title_input')){
                
                let product_id = e.target.getAttribute('data-product-id');
                let product_title = e.target.value;
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_title", 
                        product_title :product_title,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
                
            }
            //// actions for save sku
            if(e.target.classList.contains('td_sku_input')){

                let product_id = e.target.getAttribute('data-product-id');
                let product_sku = e.target.value;
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_sku", 
                        product_sku :product_sku,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }

            ////  actions for save type
            if(e.target.classList.contains('td_type_input')){

                let product_id = e.target.getAttribute('data-product-id');
                let product_type = e.target.value;
                //console.log(product_type)
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_type", 
                        product_type :product_type,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }
             ////  actions for save status
             if(e.target.classList.contains('td_status_input')){

                let product_id = e.target.getAttribute('data-product-id');
                let product_status = e.target.value;
                console.log(product_status)
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_status", 
                        product_status :product_status,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }           
            //// actions for save date
            if(e.target.classList.contains('td_publish_date_input')){

                let product_id = e.target.getAttribute('data-product-id');
                //let product_publish_date = e.target.getAttribute('data-date-value');
                let product_publish_date = e.target.value;
               // console.log(product_publish_date)
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_product_publish_date", 
                        product_publish_date :product_publish_date,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }   
            
            //// action for save td_sale_form_input
            if(e.target.classList.contains('td_sale_from_input')){

                let product_id = e.target.getAttribute('data-product-id');
                let product_sale_from = e.target.value;
                // console.log( product_sale_from)
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_product_sale_from", 
                        product_sale_from :product_sale_from,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }    
            
            //// action for save td_sale_to_input
            if(e.target.classList.contains('td_sale_to_input')){

                let product_id = e.target.getAttribute('data-product-id');
                let product_sale_to = e.target.value;
                 console.log( product_sale_to)
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_product_sale_to", 
                        product_sale_to : product_sale_to,
                        product_id: product_id
                        } ,
                        success: function(response){
                            
                        }        
                                
                    }) 

                })
            
            }  
            
            ///  handling regular price 
            if(e.target.classList.contains('td_regular_price_input')){

                let  product_id = e.target.getAttribute('data-product-id');
                let  reg_price = e.target.value;
            
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_reg_price", 
                        product_id : product_id,
                        reg_price: reg_price
                        },          
                        success: function(response){
                        
            
                        }            
                    })           
                })


            }

            ///  handling sale price 
            if(e.target.classList.contains('td_sale_price_input')){

                let  product_id = e.target.getAttribute('data-product-id');
                let  sale_price = e.target.value;
                
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_sale_price", 
                        product_id : product_id,
                        sale_price: sale_price
                        },          
                        success: function(response){
                        
            
                        }            
                    })           
                })


            }

            ///  handling stock  amount 
            if(e.target.classList.contains('td_stock_amount_input')){

                let  product_id = e.target.getAttribute('data-product-id');
                let  stock = e.target.value;
                
                jQuery(document).ready( function() {

                    jQuery.ajax({
            
                        type : "POST",
                        url : ajaxurl,
                        data : {
                        action: "dbulk_save_stock_amount", 
                        product_id : product_id,
                        stock: stock
                        },          
                        success: function(response){
                        
            
                        }            
                    })           
                })


            }


},true)



////// main function for showing products with condition
function dbulk_show_products(pageNum=1){
    jQuery(document).ready( function() {

        jQuery.ajax({

            type : "POST",
            url : ajaxurl,
            data : {
            action: "dbulk_show_products", 
            pageNum : pageNum,
            },          
            success: function(response){
                document.querySelector('.edit_products_table').innerHTML = " ";
                document.querySelector('.edit_products_table').insertAdjacentHTML('beforeend',response)

            }

        }) 
  

})
}