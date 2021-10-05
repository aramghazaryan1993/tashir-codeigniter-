
 <!-- header -->
 <?php  $this->load->view('inc/index/header.php'); ?>
 <!-- header -->


<div class="container">
	       <!-- user information -->
  <h3 style="text-align:center;">Օգտատիրոջ տվյալներ</h3>
       
  <table class="table table-bordered">
    <thead>
      <tr>
      	<td>ID</td>
        <th>Անուն</th>
        <th>Ազգանուն</th>
        <th>Էլ․ փոստ</th>
        <th>Փոփոխել</th>
        <th>Հեռացնել</th>
      </tr>
    </thead>
    <tbody id="user_details">
      <?php  foreach ($user_data as $row) { ?>
      <tr>
      	<td class ="userClass"><?= $row['id']; ?></td>
        <td contenteditable="true" id="first_name"><?= $row['first_name']; ?></td>
        <td contenteditable="true" id="last_name"><?= $row['last_name']; ?></td>
        <td contenteditable="true" id="email"><?= $row['email']; ?></td>
        <td style="cursor:pointer;" class="edit_user" id="<?=  $row['id']; ?>">Փոփոխել</td>
        <td style="cursor:pointer;" class="delete_user" id="<?=  $row['id']; ?>" >Հեռացնել</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

              <!-- user information -->
  <h3 style="text-align:center;">Օգտատիրոջ մուտքի սահմանափակաումներ</h3>
  <button style="margin-bottom: 10px;  text-align:center;cursor:pointer;" data-toggle="modal" data-target="#add_project_user">Ավելացնել հասանելիություն</button>
       
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>ID</th>
        <th>Անուն (պրոյեկտի)</th>
        <th>Դիտել</th>
        <th>Դիտել/փոփոխել</th>
        <th>Փոփոխել</th>
        <th>Հեռացնել</th>
      </tr>
    </thead>
     <tbody id="user_permissions">
      <?php  foreach ($user_permissions as $row) { ?>
      <tr>
        <td ><?= $row['id']; ?></td>
        <td contenteditable="true" id="project_name"><?= $row['name']; ?></td>
        <td ><label   class="radio-inline set_permission"><input <?php if ($row['permission_type']==2) { ?> checked="checked" <?php } ?> name="limit_permission<?=  $row['id']; ?>" type="radio" >Դիտել/փոփոխել</label>
         </td>
        <td ><label   class="radio-inline set_permission_second"><input
        <?php if ($row['permission_type']==1) { ?> checked="checked" <?php } ?> name="limit_permission<?=  $row['id']; ?>" type="radio" value="">Դիտել</label></td>
        <td style="cursor:pointer;" class="edit_permission" id="<?=  $row['id']; ?>">Փոփոխել</td>
        <td style="cursor:pointer;" class="delete_permission" id="<?=  $row['id']; ?>" >Հեռացնել</td>
      </tr>
      <?php } ?>
    </tbody> 
   </table>


</div>


  <!-- Add project user -->
  <div class="modal fade" id="add_project_user" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Պրոյեկտի ավելացում</h4>
        </div>
    <div class="modal-body">

       <div class="col-xs-6">
         <input type="hidden" id="get_project_permission">
         <input id="project"  class="form-control" type="text" placeholder="Անուն"><br>
         <!-- <textarea id="get_project_discripshen" class="form-control" rows="3" placeholder="Նկարագրություն"></textarea><br> -->
         <input id="get_project_date" class="form-control default_end_date" type="date"><br>
         <input id="add_permission" class="btn btn-primary btn-md" type="submit" value="Ավելացնել"><br>
       </div>
         <label id="user_type_edit" class="radio-inline"><input name="limit" type="radio" value="">Դիտել/փոփոխել</label>
         <label id="user_type_read" class="radio-inline"><input name="limit" type="radio" value="">Դիտել</label>
    </div>

        <div class="modal-footer">
         
        </div>
      </div>
      
    </div>
  </div>

</body>
