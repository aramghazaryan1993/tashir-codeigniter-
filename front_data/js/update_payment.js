$(document).ready(function(){

     $("#sub_update_product").click(function(){
              
     var update_product_name = $("#update_product_name").val();
     var update_product_id   = $("#update_product_id").val();

         $("#get_upd_product_name").val(update_product_name);
         $(".get_upd_product_id").val(update_product_id);
            
      });


     $("#get_upd_product_name").keyup(function(){
       // replace get_upd_product_name and update_product_name value
       $("#update_product_name").val($(this).val());
     });




     $("#sub_update_project").click(function(){
              
     var update_project_name = $("#update_project_name").val();
     var update_product_id   = $("#update_product_id").val();

         $("#get_upd_project_name").val(update_project_name);
         $(".get_upd_product_id").val(update_product_id);
            
             // $.ajax({
             //    url: 'get.php',
             //    type: 'post',
             //    data: {chk:inp},               
             //    success:function(d){
             //        alert(d);
             //                       }
             //      });    
     
    });

     $("#get_upd_project_name").keyup(function(){
      // replace get_upd_project_name and update_project_name value
         $("#update_project_name").val($(this).val());
     });





     $("#sub_update_supplier").click(function(){
              
     var update_supplier_name = $("#update_supplier_name").val();
     var update_product_id   = $("#update_product_id").val();

         $("#get_upd_supplier_name").val(update_supplier_name);
         $(".get_upd_product_id").val(update_product_id);
            
             // $.ajax({
             //    url: 'get.php',
             //    type: 'post',
             //    data: {chk:inp},               
             //    success:function(d){
             //        alert(d);
             //                       }
             //      });    
     
    });

     $("#get_upd_supplier_name").keyup(function(){
      // replace get_upd_supplier_name and update_supplier_name value
      $("#update_supplier_name").val($(this).val());
     })




     // get payment by id
$("#myTable").on("click",'tbody tr .update_save',function(){
         var payment_id = $(this).attr('id');
          
             $.ajax({
               url:  base_url+'index.php/PaymentController/GetPaymentByID',
               type: 'post',
               dataType: 'json',
               data:{payment_id:payment_id},
               success:function(d){
                  $('#get_product_id').val(d[0].product_id); 
                  $('#get_project_id').val(d[0].project_id); 
                  $('#get_supplier_id').val(d[0].supplier_id); 
                  $('#add_product_name').val(d[0].productName); 
                  $('#payment_description').val(d[0].description); 
                  $('#add_project_name').val(d[0].projectName); 
                  $('#add_supplier_name').val(d[0].supplierName); 
                  $('#price').val(d[0].price); 
                  $('#quantity').val(d[0].quantity); 
                  $('#date').val(FormatDate(new Date(d[0].registration_date))); 
                  $(".update_payment").attr('id',payment_id);

                  $('#add_payment').hide();
                  $('.update_payment').show();
               }
                
          }); 
      
     });


     // get payment by id
$("#show_product_table").on("click",'tbody tr .update_save',function(){
            var $row = jQuery(this).closest('tr');
            var $columns = $row.find('td');
   
            var id = $columns[0].innerHTML;
            var name =$columns[1].innerHTML;
            var description=$columns[2].innerHTML;
            var registrationDate =$columns[3].innerHTML;
            registrationDate = registrationDate.split("/").reverse().join("-");
          
             $.ajax({
               url:  base_url+'index.php/ProductController/UpdateProduct',
               type: 'post',
               data:{id:id,name:name,description:description,registrationDate:registrationDate},
               success:function(d){
                alert ("Փոփոխությունը կատարված է։");
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    ShowProducts();
                  }
               }
                
          }); 
      
     });

$("#show_project_table").on("click",'tbody tr .update_save',function(){
            var $row = jQuery(this).closest('tr');
            var $columns = $row.find('td');
   
            var id = $columns[0].innerHTML;
            var name =$columns[1].innerHTML;
            var description=$columns[2].innerHTML;
            var registrationDate =$columns[3].innerHTML;
            registrationDate = registrationDate.split("/").reverse().join("-")
          
             $.ajax({
               url:  base_url+'index.php/ProjectController/UpdateProject',
               type: 'post',
               data:{id:id,name:name,description:description,registrationDate:registrationDate},
               success:function(d){
                alert ("Փոփոխությունը կատարված է։");
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    ShowProjects();
                  }
               }
                
          }); 
      
     });

$("#show_supplier_table").on("click",'tbody tr .update_save',function(){
            var $row = jQuery(this).closest('tr');
            var $columns = $row.find('td');
   
            var id = $columns[0].innerHTML;
            var name =$columns[1].innerHTML;
            var description=$columns[2].innerHTML;
            var registrationDate =$columns[3].innerHTML;
            registrationDate = registrationDate.split("/").reverse().join("-")
          
             $.ajax({
               url:  base_url+'index.php/SupplierController/UpdateSupplier',
               type: 'post',
               data:{id:id,name:name,description:description,registrationDate:registrationDate},
               success:function(d){
                alert ("Փոփոխությունը կատարված է։");
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    ShowSuppliers();
                  }
               }
                
          }); 
      
     });

               //  Update  Payments

         $(".update_payment").on('click',function(){
             var payment_id          = $(this).attr('id');
             var get_product_id      = $('#get_product_id').val(); 
             var get_project_id      = $('#get_project_id').val();
             var get_supplier_id     = $('#get_supplier_id').val();
             var payment_description = $('#payment_description').val();
             var price               = $('#price').val();
             var quantity            = $('#quantity').val();
             var date                = $('#date').val();
             //alert(date);

             $.ajax({
                   url:  base_url+'index.php/PaymentController/UpdatePayment',
                   type: 'post',
                   data:{payment_id:payment_id,get_product_id:get_product_id,get_project_id:get_project_id,get_supplier_id:get_supplier_id,payment_description:payment_description,price:price,quantity:quantity,date:date},
                   success:function(d){
                       if(!Number.isInteger(parseInt(d)))
                          {
                            alert (d);
                          }
                          else
                          {
                            $('#payment').modal('toggle');
                            ShowPayments();
                          }
                   }
             });
         });


       


       //  show  product
       $("#show_product").click(function(){
         //$.LoadingOverlay("show");
         //$("body").load(base_url+'index.php/ProductController/ShowProducts');
         window.location.replace(base_url+'index.php/ProductController/Index');
       });

       //  show  project
       $("#show_project").click(function(){
         //$.LoadingOverlay("show");
         //$("body").load(base_url+'index.php/ProjectController/ShowProjects');
         window.location.replace(base_url+'index.php/ProjectController/Index');
       });

       // show  supplier
       $("#show_supplier").click(function(){
         //$.LoadingOverlay("show");
         //$("body").load(base_url+'index.php/SupplierController/ShowSuppliers');
          window.location.replace(base_url+'index.php/SupplierController/Index');
       });

         // home paige
        $("#home").click(function(){
          //$.LoadingOverlay("show");
          //$("body").load(base_url+'index.php/PaymentController/Index');
         window.location.replace(base_url+'index.php/PaymentController/Index');
       });

         // signup paige
        $("#signup").click(function(){
          //$.LoadingOverlay("show");
         //$("body").load(base_url+'index.php/Admin/signup');
         window.location.replace(base_url+'index.php/AdminController/signup');
       });



        // user_id
        $(".users").click(function(){
         var user_id = $(this).attr('id');
         window.location.replace(base_url+'index.php/ShowUsersController/show_user_data/'+user_id);
          //$.LoadingOverlay("show");
          //$("body").load(base_url+'index.php/ShowUsers/index/'+user_id);
       });        

        



});