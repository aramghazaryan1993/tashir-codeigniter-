<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>

<body>

 <!-- header -->
 <?php  $this->load->view('inc/index/header.php'); ?>
 <!-- header -->

 <!-- add_project -->
 <?php  $this->load->view('inc/insert_payment/add_project.php'); ?>
 <!-- add_project -->

 <!-- add_product -->
 <?php  $this->load->view('inc/insert_payment/add_product.php'); ?>
 <!-- add_product -->

 <!-- add_supplier -->
 <?php  $this->load->view('inc/insert_payment/add_supplier.php'); ?>
 <!-- add_supplier -->

 <!-- paymant_insertion -->
 <?php  $this->load->view('inc/insert_payment/paymant_insertion'); ?>
 <!-- paymant_insertion -->

  <h3 style="text-align: center;" >Ֆայլում առկա են սխալներ</h3>
    <!-- search  -->
<div class="container">

 <table id="myTable" class="table table-bordered" >
    <thead>
      <tr style="background-color:darkgray;text-align:center;">
        <th style="text-align:center;width: 10%;" >Պրոդուկտ</th>
        <th style="text-align:center;" >Նկարագիր</th>
        <th style="text-align:center;" >Պրոյեկտ</th>
        <th style="text-align:center;" >Մատակարար</th>
        <th style="text-align:center;" > Գին</th>
        <th style="text-align:center;" >Քանակ</th>
      </tr>
    </thead>
    <tbody id ="payments_result">
         <?php foreach ($un_readed_payments->result() as $row) { ?>
    <tr style="text-align:center;">
        <td ><?php if($row->missingProduct==1){?><font color="red"><?php } ?><?= $row->productName; ?><?php if($row->missingProduct==1){ ?></font><?php } ?></td>
        <td ><?= $row->description; ?></td>
         <td ><?php if($row->missingProject==1){?><font color="red"><?php } ?><?= $row->projectName; ?><?php if($row->missingProject==1){ ?></font><?php } ?></td>
        <td ><?php if($row->missingSupplier==1){?><font color="red"><?php } ?><?= $row->supplierName; ?><?php if($row->missingSupplier==1){ ?></font><?php } ?></td>
        <td ><?php if($row->price==0){?><font color="red"><?php } ?><?= number_format($row->price, 2, '.', ''); ?><?php if($row->price==0){ ?></font><?php } ?></td>
        <td ><?php if($row->quantity==0){?><font color="red"><?php } ?><?= $row->quantity; ?><?php if($row->quantity==0){ ?></font><?php } ?></td>
    </tr>
     <?php } ?>
 
    </tbody>
  </table>

</div>
      