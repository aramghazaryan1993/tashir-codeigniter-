<!DOCTYPE html>
<html>
<style>
/* Full-width input fields */
input[type=text], input[type=password],input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
 .cancelbtn,.signupbtn {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn,.signupbtn {
    float: left;
    width: 100%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>

 <!-- header -->
 <?php  $this->load->view('inc/index/header.php'); ?>
 <!-- header -->

<h2 style="text-align:center;">Օգտատերերի ստեղծում</h2>


  <div style="border:1px solid #ccc;text-align:center;" class="container">

    <label><b>Անուն</b></label>
    <input type="text" placeholder="Մուտքագրել անունը" id="first_name"  required>
    
    <label><b>Ազգանուն</b></label>
    <input type="text" placeholder="Մուտքագրել ազգանունը" id="last_name" required>
    
    <label><b>Էլ․ հասցե</b></label>
    <input type="email" placeholder="Մուտքագրել Էլ․ հասցեն" id="email"  required>

    <label><b>Գաղտնաբառ</b></label>
    <input type="password" placeholder="Մուտքագրեք  գաղտնաբառը" id="password"  required>

    <label><b>Կրկնել գախտնաբառը</b></label>
    <input type="password" placeholder="Կրկին անգամ մուտքագրեք ձեր գաղտնաբառը" id="repeat_password"  required>
    <input type="hidden"  id="security_code"   value="<?= $security_code; ?>">

    <div class="clearfix">
    
      <button id="insert_user" type="submit" class="signupbtn">Ստեղծել օգտատեր</button>
    </div>
  </div>



</body>
</html>
