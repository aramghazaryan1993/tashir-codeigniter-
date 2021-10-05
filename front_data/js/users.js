$(document).ready(function(){


       // insert user
       $('#insert_user').click(function(){
           var first_name      = $('#first_name').val();
           var last_name       = $('#last_name').val();
           var email           = $('#email').val();
           var password        = $('#password').val();
           var repeat_password = $('#repeat_password').val();
           var security_code   = $('#security_code').val();

           if(password == repeat_password){

           $.ajax({
                 url:   base_url+'index.php/AdminController/add_user',
                 type: 'post',
                 data: {first_name:first_name,last_name:last_name,email:email,password:password,security_code:security_code},
                 success:function(d){
                  if(d!=0)
                   {
                      window.location.replace(base_url+'index.php/ShowUsersController/show_user_data/'+d);  
                   }
                   else
                   {
                    $("#email").css("border-color","red");
                   }
                   
                 }
           });
                   }else {alert('Ձեր գաղտանաբառերը չեն համնկնում։');}
       });




       //  check email and  edit security code
       $('#edit_security_code').click(function(){
             var email = $('#email').val();
             $.ajax({
             	url:  base_url+'index.php/AdminController/edit_security_code',
             	type: 'post',
             	data: {email:email},
             	success:function(d){

             		   //  check  edit  edit_security_code
                      if (d!=1)
                      {
                      	$("#email").css("border-color", "red");
                      }
                      else{
                      	alert('Ջեր անվտանգության ծածկագիրը ուղարկվել Է ձեր Էլ․ փոստին');
                      	window.location.replace(base_url+'index.php/AdminController/replace_password');

                      }
             	} 

             });
       });


       //  check repeat  password
       $('#repeat_password').keyup(function(){
             var password          = $('#password').val();
             var repeat_password   = $('#repeat_password').val();

             if(password != repeat_password)
             {
             	$("#repeat_password").css("color", "red");
             }
             else
             {
             	$("#repeat_password").css("color", "green");
             }
       });


       // check security_code
       $('#security_code').keyup(function(){
         var security_code =  $(this).val();
           $.ajax({
           	    url:  base_url+'index.php/AdminController/check_security_code',
           	    type: 'post',
           	    data: {security_code:security_code},
           	    success:function(d){
                        if(d!=security_code)
                        {
                           $("#security_code").css("color", "red");
                        } 
                        else
                        {
                        	$("#security_code").css("color", "green");
                        }
           	    }
           });
       });

          // edit user
      $('.edit_user').click(function(){
          var first_name = $('#first_name').text();
          var last_name  = $('#last_name').text();
          var email      = $('#email').text();
          var edit_user  = $(this).attr('id');
          //alert(user_id);
          $.ajax({
             url:  base_url+'index.php/ShowUsersController/edit_user',
             type: 'post',
             data:{first_name:first_name,last_name:last_name,email:email,edit_user:edit_user},
             success:function(d){
                 alert('Ձեր փոփոխությունը կատարված Է');
                //  alert(d);
             }
          });
      });
                                      
          //  delete user 
       $('.delete_user').click(function(){
           var delete_user = $(this).attr('id');
           $(this).parent().remove();

           $.ajax({
              url:  base_url+'index.php/ShowUsersController/delete_user',
              type: 'post',
              data: {delete_user:delete_user},
              success:function(d){
                window.location.replace(base_url+'index.php/AdminController/signup');
              }
           });
       });


     // edit permission
        $("#user_permissions").on("click",'tr .edit_permission',function(){
          user_id=$('.userClass').text();
          var row = jQuery(this).closest('tr');
          var columns = row.find('td');
          var project_id = columns[0].innerHTML;

          var label1=row.find('.set_permission');
          var label2=row.find('.set_permission_second');
          var input1=label1.find('input');
          var input2=label2.find('input');

          var permission_type='';
          
          if(input1.attr('checked')=="checked")
            permission_type=2;

          if(input2.attr('checked')=="checked")
            permission_type=1;
          
          $.LoadingOverlay("show");

          $.ajax({
             url:  base_url+'index.php/ShowUsersController/edit_user_permission',
             type: 'post',
             data:{project_id:project_id,user_id:user_id,permission_type:permission_type},
             success:function(d){
              //alert(d);
                  if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    $('#get_product_id').val(JSON.parse(d)); 
                    $('#add_project_user').modal('toggle');
                    window.location.replace(base_url+'index.php/ShowUsersController/show_user_data/'+d);  
                    //ShowProducts();
                  }
                  $.LoadingOverlay("hide");
             }
          });
      });
                       
     // delete permission
        $("#user_permissions").on("click",'tr .delete_permission',function(){
        if(confirm("Ցանկանում եք հեռացնել?"))
        {
              user_id=$('.userClass').text();
              var row = jQuery(this).closest('tr');
              var columns = row.find('td');
              var project_id = columns[0].innerHTML;

              var label1=row.find('.set_permission');
              var label2=row.find('.set_permission_second');
              var input1=label1.find('input');
              var input2=label2.find('input');

              $.LoadingOverlay("show");
              $.ajax({
                 url:  base_url+'index.php/ShowUsersController/delete_user_permission',
                 type: 'post',
                 data:{project_id:project_id,user_id:user_id},
                 success:function(d){
                  //alert(d);
                      if(!Number.isInteger(parseInt(d)))
                      {
                        alert (d);
                        
                      }
                      else
                      {
                        $('#get_product_id').val(JSON.parse(d)); 
                        $('#add_project_user').modal('toggle');
                        window.location.replace(base_url+'index.php/ShowUsersController/show_user_data/'+d);  
                        
                      }
                      $.LoadingOverlay("hide");
                 }
              });
          }
      });
                       
  
         $('#add_permission').click(function(){
          var project_id  = $('#get_project_permission').val();
          var permission_type='';
          
          if($('#user_type_read').attr('checked')=="checked")
            permission_type=1;

          if($('#user_type_edit').attr('checked')=="checked")
            permission_type=2;

          var user_id = $('#user_details tr .userClass').text();
          $.LoadingOverlay("show");
           $.ajax({
              url:  base_url+'index.php/ShowUsersController/AddPermission',
              type: 'post',
              data: {project_id:project_id,permission_type:permission_type,user_id:user_id},
              success:function(d){

                if(!Number.isInteger(parseInt(d)))
                  {
                    alert (d);
                  }
                  else
                  {
                    $('#get_product_id').val(JSON.parse(d)); 
                    $('#add_project_user').modal('toggle');
                    window.location.replace(base_url+'index.php/ShowUsersController/show_user_data/'+d);  
                    
                  }
                  $.LoadingOverlay("hide");
              }
           });
       });

     
      $("#user_type_read").click(function(){
      $('#user_type_edit').removeAttr('checked');
      $(this).attr('checked', 'checked');
     })

     $("#user_type_edit").click(function(){
      $('#user_type_read').removeAttr('checked');
      $(this).attr('checked', 'checked');
     })

    $("#user_permissions").on("click",'tr td .set_permission',function(){
      $(this).find('input').attr('checked', 'checked');
      var row = jQuery(this).closest('tr');
      var label=row.find('.set_permission_second');
      label.find('input').removeAttr('checked');   
     });

      $("#user_permissions").on("click",'tr td .set_permission_second',function(){
      $(this).find('input').attr('checked', 'checked');
      var row = jQuery(this).closest('tr');
      var label=row.find('.set_permission');
      label.find('input').removeAttr('checked');   
     });

	});
