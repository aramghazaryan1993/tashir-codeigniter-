
<!-- add_product -->
  <div style="z-index: 2042" class="modal fade" id="add_product" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">Պրոդուկտի մուտքագրում</h4>
        </div>
        <div class="modal-body">
          

 
    <div class="form-group row">
      <div class="col-xs-6">
        <!--  <input type="hidden" class="get_product_id"> -->
         <input    id="get_product_name" class="form-control"  type="text" placeholder="Անուն" ><br>
         <textarea id="get_product_discripshen" class="form-control" rows="3"  placeholder="Նկարագրություն"></textarea><br>
         <input    id="get_product_date" class="form-control default_end_date"  type="date"><br>
         <input    id="insert_product"  class="btn btn-primary btn-md" type="submit" value="Ավելացնել"><br>

      </div>
      
     

    </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Փակել</button>
        </div>
      </div>
    </div>
  </div>
  <!--setting default date -->
<!-- <script type="text/javascript">$("#get_product_date").val(FormatDate(new Date()));</script> -->
  <!-- add_product -->