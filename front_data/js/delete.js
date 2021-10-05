$(document).ready(function(){
	
    // delete  payments
       $("#myTable").on("click",'tbody tr .delete_payment',function(){
        if(confirm("Ցանկանում եք հեռացնել?"))
        {
            var delete_payment_id = $(this).attr('id');
            $(this).parent().remove();
            
            $.ajax({
                url:  base_url+'index.php/PaymentController/DeletePayment',
                type: 'post',
                data:{delete_payment_id:delete_payment_id},
                success:function(d){
                }
            });
        }
        });


    
    $("#show_product_table").on("click",' tbody tr .delete_save',function(){
        if(confirm("Ցանկանում եք հեռացնել?"))
        {
                  var delete_id = $(this).attr('id');
                  delete_id=delete_id.substring(1, delete_id.length);
                  $.ajax({
                    url:  base_url+'index.php/ProductController/DeleteProduct',
                    type: 'post',
                    data:{delete_id:delete_id},
                    success:function(d){

                        if(!Number.isInteger(parseInt(d)))
                        {
                            alert (d);
                        }
                        else
                        {
                            ShowProducts();
                        }
                        
                    }
                })
        }
        
               
    });


$("#show_project_table").on("click",' tbody tr .delete_save',function(){
        if(confirm("Ցանկանում եք հեռացնել?"))
        {
                  var delete_id = $(this).attr('id');
                  delete_id=delete_id.substring(1, delete_id.length);
                  $.ajax({
                    url:  base_url+'index.php/ProjectController/DeleteProject',
                    type: 'post',
                    data:{delete_id:delete_id},
                    success:function(d){

                        if(!Number.isInteger(parseInt(d)))
                        {
                            alert (d);
                        }
                        else
                        {
                            ShowProjects();
                        }
                        
                    }
                })
        }
        
               
    });


$("#show_supplier_table").on("click",' tbody tr .delete_save',function(){
        if(confirm("Ցանկանում եք հեռացնել?"))
        {
                  var delete_id = $(this).attr('id');
                  delete_id=delete_id.substring(1, delete_id.length);
                  $.ajax({
                    url:  base_url+'index.php/SupplierController/DeleteSupplier',
                    type: 'post',
                    data:{delete_id:delete_id},
                    success:function(d){

                        if(!Number.isInteger(parseInt(d)))
                        {
                            alert (d);
                        }
                        else
                        {
                            ShowSuppliers();
                        }
                        
                    }
                })
        }
        
               
    });

});