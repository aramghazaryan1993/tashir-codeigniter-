$(document).ready(function(){

   
var today = FormatDate(new Date());

var weekAgo = new Date();
weekAgo.setDate(weekAgo.getDate() - 7);
weekAgo = FormatDate(weekAgo);

$('.default_start_date').val(weekAgo);
$('.default_end_date').val(today);


/*$('#start_date').val(weekAgo);
$('#end_date').val(today);
*/
var $loading = $('#loading').hide();
$(document)
  .ajaxStart(function () {
    $loading.show();
  })
  .ajaxStop(function () {
    $loading.hide();
  });

   // auto complete for products
   $('#add_product_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProductController/ShowProductsAjax',  {get_product_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

   $('#product_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProductController/ShowProductsAjax',  {get_product_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

   // auto complete for projects
   $('#add_project_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProjectController/ShowProjectsAjax',  {get_project_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

   $('#project_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProjectController/ShowProjectsAjax',  {get_project_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

// auto complete for suppliers
   $('#add_supplier_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/SupplierController/ShowSuppliersAjax',  {get_supplier_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

    $('#supplier_name').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/SupplierController/ShowSuppliersAjax',  {get_supplier_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });



 $("#get_product_id").keyup(function(){
      var product_id = $(this).val();

      if (product_id !='' && product_id !=undefined)
      {
           $.ajax({
             url:  base_url+'index.php/ProductController/GetProductById',
             type: 'post',
             dataType: 'json',
             data:{product_id:product_id},
             success:function(d){
              $('#add_product_name').val((d!=undefined)?d.name:'');
             
          }
              
        }); 
      }
      else
      {
        $('#add_product_name').val(''); 
      }
        
  });

 
 $("#add_product_name").on('input keyup blur change', function() { 
      var name = $(this).val();
           $.ajax({
             url:  base_url+'index.php/ProductController/GetProductIdByName',
             type: 'post',
             dataType: 'json',
             data:{name:name},
             success:function(d){
              $('#get_product_id').val((d=="0")?"":d);
             
          }
              
        }); 
  });

 $("#add_project_name").on('input keypress blur change', function() { 
      var name = $(this).val();
           $.ajax({
             url:  base_url+'index.php/ProjectController/GetProjectIdByName',
             type: 'post',
             dataType: 'json',
             data:{name:name},
             success:function(d){
              $('#get_project_id').val((d=="0")?"":d);
             
          }
              
        }); 
  });

  $("#project").on('input keypress blur change', function() { 
      var name = $(this).val();
           $.ajax({
             url:  base_url+'index.php/ProjectController/GetProjectIdByName',
             type: 'post',
             dataType: 'json',
             data:{name:name},
             success:function(d){
              $('#get_project_permission').val((d=="0")?"":d);
             
          }
              
        }); 
  });

 $("#add_supplier_name").on('input keypress blur change', function() { 
      var name = $(this).val();
           $.ajax({
             url:  base_url+'index.php/SupplierController/GetSupplierIdByName',
             type: 'post',
             dataType: 'json',
             data:{name:name},
             success:function(d){
              $('#get_supplier_id').val((d=="0")?"":d);
             
          }
              
        }); 
  });


    //autocompletes for main search form  
    $('#product').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProductController/ShowProductsAjax', {get_product_name:term} , 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

    $('#project').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/ProjectController/ShowProjectsAjax',  {get_project_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });

    $('#supplier').autoComplete({
    minChars: 1,
    source: function(term, response){
        $.getJSON(base_url+'index.php/SupplierController/ShowSuppliersAjax',  {get_supplier_name:term}, 
          function(data)
          {
            result = [].map.call(data, function(obj)
            {
              return obj.name;
            });
            response(result);
          });
          }
      });


// search payments
 $("#search_payment").click(function(){
       ShowPayments();
    

  });

 // payments sort
 $("#payment_reg").click(function(){
     if($("#payment_reg").attr("checked") == 'checked')  
     {
       ShowPayments(1);
     }
     else
     {
       ShowPayments(1);
     }
       GetMinMaxPrices();

  });

 // payments sort
 $("#payment_date").click(function(){
       ShowPayments(1);
  });

 $("#payment_price").click(function(){
       ShowPayments(2);
  });


 //search_products
 $("#search_product").click(function(){
        ShowProducts();
  });

 //search_projects
 $("#search_project").click(function(){
         ShowProjects();
  });

 //search_supplier
 $("#search_supplier").click(function(){
         ShowSuppliers();
  });

 GetMinMaxPrices();
 
 });