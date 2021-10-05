   <!-- search  -->
<div class="container">

  
     
   <div class="form-group row">
    <form>
     <div class="col-xs-2">
        <label>Սկիզբ</label>
        <input class="form-control default_start_date" id="start_date"  type="date" name="start_date"> 
     </div>
     
     <div class="col-xs-2">
     <label>Վերջ</label>
        <input class="form-control default_end_date" id="end_date"  type="date" name="end_date">
     </div>
     
     <div class="col-xs-2">
     <label>Պրոդուկտ</label>
        <input class="form-control" id="product" placeholder="Պրոդուկտ" type="text" name="product">
     </div>
     
     <div class="col-xs-2">
     <label>ID</label>
        <input class="form-control" id="idd" placeholder="ID" type="number" name="idd">
     </div>
     
     <div class="col-xs-2">
     <label>Նկարագիր</label>
        <input class="form-control" id="description" placeholder="Նկարագիր" type="text" name="description">
     </div>
     
     <div class="col-xs-2">
     <label>Պրոյեկտ</label>
        <input class="form-control" id="project" placeholder="Պրոյեկտ" type="text" name="project">
     </div>
     
     <div class="col-xs-2" style="margin-top:15px;">
     <label>Մատակարար</label>
        <input class="form-control" id="supplier" placeholder="Մատակարար" type="text" name="supplier">
     </div>
     
     <div class="col-xs-2" style="margin-top:15px;">
     <label>Մինիմում գին</label>
        <input class="form-control" id="min_price" placeholder="Մինիմում գին" type="number" name="min_price">
     </div>
     
     <div class="col-xs-2" style="margin-top:15px;">
     <label>Մաքսիմում գին</label>
        <input class="form-control" id="max_price" placeholder="Մաքսիմում գին" type="number" name="max_price">
     </div>
    
      <div style="margin-top:15px;">
     <button style="margin-top:40px; margin-bottom: 40px;" id="search_payment" type="button" class="btn btn-primary  col-xs-1">
      <span class="glyphicon glyphicon-search"></span> Որոնել
     </button>

     <div class="col-xs-2" style="margin-top:15px;">
      <label>Առավելագույն գին</label>
        <label style="background-color: #eee; text-align: right;" class="form-control" id="result_max_price" name="result_max_price"></label>
     </div>

     <div class="col-xs-2" style="margin-top:15px;">
      <label>Նվազագույն գին</label>
        <label style="background-color: #eee;text-align: right;" class="form-control" id="result_min_price" name="result_min_price"></label>
     </div>
 </form>
</div><br>


<?php  if($this->session->userdata('user_id') == 1) { ?>
<div  enctype="multipart/form-data"  accept-charset="utf-8">
   <div class="row">
      <div class="col-lg-12 col-sm-12">
         <div class="form-group"><label for="image">Ներբեռնել excel</label><input type="file" name="userfile" id="userfile" class="form-control filestyle" value="" data-icon="false"></div>
      </div>
      <div class="col-lg-12 col-sm-12">
         <div  class="form-group text-right"><input onclick="ImportPayments()" type="button" name="importfile" value="Import" id="importfile-id" class="btn btn-primary"></div>
      </div>
   </div>
</div>
<?php } ?>

<div xlass="row">
    <div class="col-lg-12 col-sm-12">
        <div class="form-group text-right">
            <a id="dlink" ></a> 
            <input   type="button" onclick="tableToExcel('myTable', 'name', 
            'payments_'+FormatDateAsFileName(new Date()))" value="Export to Excel">
        </div>
    </div>
</div>   

 <table id="myTable" class="table table-bordered" >
    <thead>
      <tr style="background-color:darkgray;text-align:center;">
        <th id ="payment_reg" style="text-align:center;" ><input class="deleteFromExcel" type="radio" style="border:0px;width:50%;height:1.2em;"  name="sortOrder" id ="payment_date">Ամսաթիվ</th>
        <th style="text-align:center;width: 10%;" >Պրոդուկտ</th>
        <th style="text-align:center;" >ID</th>
        <th style="text-align:center;" >Նկարագիր</th>   
        <th style="text-align:center;" >Պրոյեկտ</th>
        <th style="text-align:center;" >Մատակարար</th>
        <th style="text-align:center;" > <input class="deleteFromExcel" type="radio" style="border:0px;width:50%;height:1.2em;" name="sortOrder" id ="payment_price">Գին</th>
        <th style="text-align:center;" >Քանակ</th>
        <th style="text-align:center;" >Փոփոխել</th>
        <th style="text-align:center;" >Հեռացնել</th>
      </tr>
    </thead>
    <tbody id ="payments_result">
        <?php  $this->load->view('search_table_payment.php'); ?>
    </tbody>
  </table>

</div>
      <!-- search  -->