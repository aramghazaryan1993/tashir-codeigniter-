$(document).ready(function(){


          // Product script
      
     $("#sub_add_product").click(function(){ 
        var add_product_name = $("#add_product_name").val();
        $("#get_product_name").val(add_product_name);
      });

     $("#get_product_name").keyup(function(){
       // replace get_product_name and add_product_name value
       $("#add_product_name").val($(this).val());
      
     });

     // insert product
     $("#insert_product").click(function(){
          var get_product_name        = $("#get_product_name").val();
          var get_product_discripshen = $("#get_product_discripshen").val();
          var get_product_date        = $('#get_product_date').val();

          
             $.ajax({
               url:  base_url+'index.php/ProductController/SaveProduct',
               type: 'post',
               data:{get_product_name:get_product_name,get_product_discripshen:get_product_discripshen,get_product_date:get_product_date},
               success:function(d){
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    $('#get_product_id').val(JSON.parse(d)); 
                    $('#add_product').modal('toggle');
                    ShowProducts();
                  }
               }
                
          }); 
     });


       //  Project scriprt

     $("#sub_add_project").click(function(){
              
         var add_project_name = $("#add_project_name").val();
         $("#get_project_name").val(add_project_name);  
    });

     $("#get_project_name").keyup(function(){
      // replace get_project_name and add_project_name value
         $("#add_project_name").val($(this).val());
     });

     // insert  Project
     $("#insert_project").click(function(){
          var get_project_name        = $("#get_project_name").val();
          var get_project_discripshen = $("#get_project_discripshen").val();
          var get_project_date        = $('#get_project_date').val();

          
             $.ajax({
               url:  base_url+'index.php/ProjectController/SaveProject',
               type: 'post',
               data:{get_project_name:get_project_name,get_project_discripshen:get_project_discripshen,get_project_date:get_project_date},
               success:function(d){
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    $('#get_project_id').val(JSON.parse(d));  
                    $('#add_project').modal('toggle');
                    ShowProjects();
                  }

               }
                
          }); 
     });




         //  script supplier

     $("#sub_add_supplier").click(function(){          
        var add_supplier_name = $("#add_supplier_name").val();
        $("#get_supplier_name").val(add_supplier_name);
         
    });

     $("#get_supplier_name").keyup(function(){
      // replace get_supplier_name and add_supplier_name value
      $("#add_supplier_name").val($(this).val());
     });


     // insert  Project
     $("#insert_supplier").click(function(){
          var get_supplier_name        = $("#get_supplier_name").val();
          var get_supplier_discripshen = $("#get_supplier_discripshen").val();
          var get_supplier_date        = $('#get_supplier_date').val();

          
             $.ajax({
               url:  base_url+'index.php/SupplierController/SaveSupplier',
               type: 'post',
               data:{get_supplier_name:get_supplier_name,get_supplier_discripshen:get_supplier_discripshen,get_supplier_date:get_supplier_date},
               success:function(d){
                  
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    $('#get_supplier_id').val(JSON.parse(d));  
                    $('#add_supplier').modal('toggle');
                    ShowSuppliers();
                  }

               }
                
          }); 
     });



     //  script paymants

     $("#add_payment").click(function(){

         var get_product_id      = $("#get_product_id").val();
         var get_project_id      = $("#get_project_id").val();
         var get_supplier_id     = $("#get_supplier_id").val();
         var payment_description = $("#payment_description").val();
         var price               = $("#price").val();
         var quantity            = $("#quantity").val();
         var date                = $("#date").val();

        
         $.ajax({
               url:  base_url+'index.php/PaymentController/SavePayment',
               type: 'post',
               data:{get_product_id:get_product_id,get_project_id:get_project_id,get_supplier_id:get_supplier_id,payment_description:payment_description,price:price,quantity:quantity,date:date},
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

 
            
//  empty  value  Insert
 $('#insert').on('click',function () {
      $("#payment").find(':input').each(function() {
        switch(this.type) {
            case 'text':
            case 'number':
            case 'textarea':
            case 'date':
                $(this).val('');
                break;
        }
    });
      $("#date").val(FormatDate(new Date()));
      $('.update_payment').hide();
      $('#add_payment').show();

    });


});
