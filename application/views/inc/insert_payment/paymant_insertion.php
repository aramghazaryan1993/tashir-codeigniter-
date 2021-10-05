 <!-- paymant insertion -->

  <div class="modal fade" id="payment" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Payment </h4>
        </div>
        <div class="modal-body">
          

              <h3 style="text-align:center;" >Գործարք</h3>
 
 
    <div  class="form-group row">
 
 
      <div class="col-xs-6">
      
         <input type="hidden" id="get_project_id">
         <input type="hidden" id="get_supplier_id">

         <input    id="get_product_id" class="form-control  " style="width:60%;" type="number" placeholder="Պրոդուկտ ID " >      
         <input    id="add_product_name" class="form-control " type="text" placeholder="Պրոդուկտի անուն" style="margin-top:8px;"  >
         <div id ="productList"></div>

         <textarea id="payment_description" class="form-control" rows="3"  placeholder="Նկարագրություն" style="margin-top:8px;"></textarea>
         
         <input    id="add_project_name" class="form-control"  type="text" placeholder="Պրոյեկտի անուն" style="margin-top:8px;">
         <div id ="projectList"></div>
         
        <input    id="add_supplier_name" class="form-control"  type="text" placeholder="Մատակարարի անուն" style="margin-top:8px;">
        <div id ="supplierList"></div>

         <input    id="price" class="form-control" style="width:50%; margin-top:8px;" type="number" placeholder="Գին"  >
         <input    id="quantity" class="form-control" style="width:40%; margin-top:8px;" type="number" placeholder="Քանակ">
         <input    id="date" class="form-control default_end_date" type="date" style="margin-top:8px;">
         <input    id="add_payment" class="form-control"   type="submit" value="Ավելացնել" style="margin-top:8px;">
         <input    id="" class="form-control update_payment" type="submit" value="Փոփոխել" style="margin-top:8px;">

      </div>
      
                                                                 <!-- #add_product -->
      <div class="col-xs-6" id="" style="margin-top:43px;">
         <input id="sub_add_product" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#add_product"  type="submit" style="width:40%;" value="Մուտքագրել">
      </div>
                                                                 <!-- #add_product -->


                                                                 <!-- #add_project -->
      <div class="col-xs-6" id="" style="margin-top:90px;">
         <input id="sub_add_project" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#add_project"  type="submit" style="width:40%;" value="Մուտքագրել">
      </div>
                                                                 <!-- #add_project -->


                                                                 <!-- #add_supplier -->
      <div class="col-xs-6" id="" style="margin-top:9px;">
         <input id="sub_add_supplier" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#add_supplier"  type="submit" style="width:40%;" value="Մուտքագրել">
      </div>
                                                                 <!-- #add_supplier -->

    </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Փակել</button>
        </div>
      </div>
    </div>
  </div>
  
  <!--setting default date -->
<script type="text/javascript">$("#date").val(FormatDate(new Date()));</script>

<!-- paymant insertion -->