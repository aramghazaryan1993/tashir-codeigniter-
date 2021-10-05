<?php include "script.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('front_data/css/bootstrap.min.css'); ?>">
     <script src="<?= base_url('front_data/js/jquery.min.js'); ?>"></script>
     <script src="<?= base_url('front_data/js/bootstrap.min.js'); ?>"></script>

  <link rel="stylesheet" type="text/css" href="<?= base_url('front_data/css/front_style.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('front_data/jQuery-autoComplete-master/jquery.auto-complete.css'); ?>">

  <script type="text/javascript" src="<?= base_url('front_data/jQuery-autoComplete-master/jquery.auto-complete.min.js'); ?>"></script> 
 
  <script type="text/javascript">
    var base_url="<?= base_url(); ?>"
  </script>
  <script type="text/javascript" src="<?= base_url('front_data/js/service.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/ExcelDownloadUpload.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/insert_payment.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/update_payment.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/search.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/delete.js'); ?>"></script> 
  <script type="text/javascript" src="<?= base_url('front_data/resources/jquery-loading-overlay-master/extras/loadingoverlay_progress/loadingoverlay_progress.min.js'); ?>"></script> 
 
  <script type="text/javascript" src="<?= 
  base_url('front_data/resources/jquery-loading-overlay-master/src/loadingoverlay.min.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url('front_data/js/users.js'); ?>"></script>

<style>Hoverable Dropdown
Move the mouse over the button to open the dropdown menu.
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #2e597d;}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #2e597d;
}



</style>
</head>
<body>
  
  <?php
  if($this->session->userdata('session_name') != true)
               { 
               redirect(base_url('index.php/AdminController/index'));
               }
  ?>


<nav class="navbar navbar-default" id="header"><br>
  
  <div style="margin-top:-14px;" class="container-fluid">

<ul class="nav navbar-nav">
                                           <!--  Home paige -->
                 <button id="home"  type="button" class="btn btn-primary btn-md" >Գլխավոր</button>


           <!-- Insert  data -->
<div class="dropdown">
  <button class="dropbtn btn btn-primary btn-md">Մւտքագրել</button>
  <div class="dropdown-content">

                                <!-- Trigger the Payment with a button -->
     <a class="btn btn-info btn-md" id="insert" data-toggle="modal" data-target="#payment" href="#">Գործարք</a>

                                <!-- Trigger the Product full with a button -->
     <a class="btn btn-info btn-md" data-toggle="modal" data-target="#add_product" href="#">Պրոդուկտի մուտքագրում</a>

                                <!-- Trigger the project full with a button -->
     <a class="btn btn-info btn-md" data-toggle="modal" data-target="#add_project" href="#">Պրոյեկտի մուտքագրում</a>

                                <!-- Trigger the ad_supplier full with a button -->
     <a class="btn btn-info btn-md" data-toggle="modal" data-target="#add_supplier" href="#">Մատակարարի մուտքագրում</a>
  </div>
</div>


                                              <!--  Show data -->
                                  
<div class="dropdown">
  <button class="dropbtn btn btn-primary btn-md">Դիտում</button>
    <div class="dropdown-content">

                                  <!-- Trigger the show Product  button -->
              <a id="show_product"  class="btn btn-info btn-md" href="#">Պրոդուկտի Դիտում</a>

                                  <!-- Trigger the show project full with a button -->
              <a id="show_project" class="btn btn-info btn-md" href="#">Պրոյեկտի Դիտում</a>

                                  <!-- Trigger the show  show supplier full with a button -->
              <a id="show_supplier"  class="btn btn-info btn-md" href="#">Մատակարարի Դիտում</a>
                      
    </div>
</div>

<?php  if($this->session->userdata('user_id') == 1) { ?>
 <div class="dropdown">
  <button class="dropbtn btn btn-primary btn-md">Օգտատերերի դիտում</button>
    <div class="dropdown-content">

                                  <!-- Show users button -->
                                  <?php while ($row = mysqli_fetch_array($show)){ ?>
              <a id="<?= $row['id']; ?>"  class="btn btn-info btn-md users" href="#/<?= $row['id']; ?>"><?= $row['first_name']; ?></a>
                                          <?php } ?>
    </div>
</div>
<?php } ?>





    </ul>

                                               <!-- Signup -->

                   
    <a style="float:right;" class="btn btn-primary btn-md" href="<?= site_url('AdminController/logout'); ?>">Logout</a>
    <?php  if($this->session->userdata('user_id') == 1) { ?>
    <a id="signup" style="float:right;" class="btn btn-primary btn-md" href="#">Signup</a>
    <?php } ?>
    <button style="float:right;" type="button" class="btn btn-danger"><?php  print_r($show_user_info[2].' '.$show_user_info[3]); ?></button>


  </div>
</nav>


