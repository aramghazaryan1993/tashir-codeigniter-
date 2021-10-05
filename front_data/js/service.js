
	function FormatDate(date)
	{
		var dd = date.getDate();
		var mm = date.getMonth()+1; //January is 0!
		var yyyy = date.getFullYear();

		if(dd<10){
		    dd='0'+dd;
		} 
		if(mm<10){
		    mm='0'+mm;
		}
		date = yyyy+'-'+mm+'-'+dd;
		return date;

	}	

function FormatDateAsFileName(date)
  {
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!
    var yyyy = date.getFullYear();

    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    }
    date = dd+'_'+mm+'_'+yyyy.toString().substr(2,2);//yyyy+'-'+mm+'-'+dd;
    return date;

  } 



function ShowPayments (sort_order = 0)
      {
         var start_date = $("#start_date").val();
	       var end_date   = $("#end_date").val();
	       var idd        = $("#idd").val();
	       var description= $("#description").val();
	       var product    = $("#product").val();
         var project    = $("#project").val();
	       var supplier   = $("#supplier").val();
	       var min_price  = $("#min_price").val();     
	       var max_price  = $("#max_price").val();  
         $.LoadingOverlay("show");
        /*get payments*/
       $.ajax({
         url:  base_url+'index.php/PaymentController/ShowPayments',
         type: 'post',
         data:{start_date:start_date,end_date:end_date,idd:idd,description:description,
          product:product,project:project,supplier:supplier,min_price:min_price,max_price:max_price,sort_order:sort_order},
         success:function(d){
          $.LoadingOverlay("hide");
          $("#payments_result").html(d);
         }
      });

       GetMinMaxPrices();

   }

   /*get min/max prices*/
   function GetMinMaxPrices()
   {
         var start_date = $("#start_date").val();
         var end_date   = $("#end_date").val();
         var idd        = $("#idd").val();
         var description= $("#description").val();
         var product    = $("#product").val();
         var project    = $("#project").val();
         var supplier   = $("#supplier").val();
         var min_price  = $("#min_price").val();     
         var max_price  = $("#max_price").val();  
       $.ajax({
         url:  base_url+'index.php/PaymentController/GetMinMaxPrices',
         type: 'post',
         dataType: 'json',
         data:{start_date:start_date,end_date:end_date,idd:idd,description:description,
          product:product,project:project,supplier:supplier,min_price:min_price,max_price:max_price},
         success:function(d){
          if (d.length!=0)
          {
            var max_price = d[0].max_price;
            var min_price = d[0].min_price;

            $("#result_max_price").text((+max_price).toFixed(2));
            $("#result_min_price").text((+min_price).toFixed(2));
          }
          else
          {
            $("#result_max_price").text('');
            $("#result_min_price").text(''); 
          }

          
         }
          
    });
   }

   function ShowProducts()
   {
         var start_date  = $("#product_start_date").val();
         var end_date    = $("#product_end_date").val();
         var product_id  = $("#product_idd").val();
         var description = $("#product_description").val();
         var product_name= $("#product_name").val();

       $.ajax({
         url:  base_url+'index.php/ProductController/ShowProducts',
         type: 'post',
         data:{start_date:start_date,end_date:end_date,product_id:product_id,description:description,
          product_name:product_name},
         success:function(d){
           $(".table_search").html(d);
         
          
         }
      });
   }

   function ShowProjects()
   {
         var start_date  = $("#project_start_date").val();
         var end_date    = $("#prjeuct_end_date").val();
         var project_id  = $("#project_idd").val();
         var description = $("#project_description").val();
         var project_name= $("#project_name").val();

       $.ajax({
         url:  base_url+'index.php/ProjectController/ShowProjects',
         type: 'post',
         data:{start_date:start_date,end_date:end_date,project_id:project_id,description:description,
          project_name:project_name},
         success:function(d){
          //  show  project
           $(".table_search").html(d);
         
          
         }
      });
   }

   function ShowSuppliers()
   {
      var start_date  = $("#start_date").val();
         var end_date    = $("#end_date").val();
         var supplier_id  = $("#supplier_idd").val();
         var description = $("#description").val();
         var supplier_name= $("#supplier_name").val();

       $.ajax({
         url:  base_url+'index.php/SupplierController/ShowSuppliers',
         type: 'post',
         data:{start_date:start_date,end_date:end_date,supplier_id:supplier_id,description:description,
          supplier_name:supplier_name},
         success:function(d){
           $(".table_search").html(d);
          
         }
      });
   }

   function ImportPayments()
   {
         var importfile = $("#importfile-id").val();
         var file_data = $('#userfile').prop('files')[0];  
         if(file_data==undefined){alert("Ֆայլը ընտրված չէ։"); return;} 
         var form_data = new FormData();                  
         form_data.append('userfile', file_data);
         $.LoadingOverlay("show");
       $.ajax({
         url:  base_url+'index.php/ImportController/save',
         type: 'post',
         data:  form_data,
         contentType: false,
         cache: false,
         processData:false,
         success:function(d){
            $.LoadingOverlay("hide");
            if (d==1){
              alert ("Տվյալները ներբեռնված են հաջողությամբ։")
              window.location.replace(base_url+'index.php/PaymentController/index');
            }
            else
            {
             window.location.replace(base_url+'index.php/ImportController/GetUnReadedPayments');
            }
          }
          
         
      });




   }
   

