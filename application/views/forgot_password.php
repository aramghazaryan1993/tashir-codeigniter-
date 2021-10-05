<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password],input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<head>
         <script src="<?= base_url('front_data/js/jquery.min.js'); ?>"></script>
         <script type="text/javascript" src="<?= base_url('front_data/js/users.js'); ?>"></script>
         <script type="text/javascript">
          var base_url="<?= base_url(); ?>"
         </script>
</head>
<body>

<h2 style="text-align:center;">Հայտարարել նոր գաղտնաբառ</h2>

<form method="post" action="<?php echo base_url('index.php/AdminController/edit_password'); ?>" style="margin-left:30%;text-align:center;width:40%;">
  <div class="imgcontainer">
    <img src="<?= base_url('front_data/img/forgot_psw.jpg'); ?>" alt="Avatar" class="avatar">
  </div>

  <div class="container">
   
    <label><b>Անվտագության ծածկագիր</b></label>
    <input id="security_code" type="text" placeholder="Մուտքագրեք ձեր Անվտագության ծածկագիրը" value="<?php if(!empty($_POST['security_code'])){echo $_POST['security_code']; } ?>" name="security_code" required>

    <label><b>Գախտնաբառ</b></label>
    <input type="password" placeholder="Մուտքագրեք ձեր գաղտնաբառը" name="password" id="password" class="password"  required>

    <label><b>Կրկնել գախտնաբառը</b></label>
    <input type="password" placeholder="Կրկին անգամ մուտքագրեք ձեր գաղտնաբառը" id="repeat_password" name="repeat_password" class="password"  required>
        
    <button type="submit">Հաստատել</button>
   
  </div>

  <div class="container" style="background-color:#f1f1f1">
   
     <span style="float:left;"  class="psw"><a style="text-decoration:none;" href="<?= base_url('index.php/AdminController/index'); ?>">Լոգին </a></span>
    <span  class="psw">Մոռացել եք ձեր անվ․ <a style="text-decoration:none;"  href="<?= base_url('index.php/AdminController/validation_email'); ?>">ծածկագիրը?&nbsp&nbsp&nbsp </a></span>
    <span style="margin-right:10%;" class="psw">Փոփոխել ձեր <a style="text-decoration:none;" href="<?= base_url('index.php/AdminController/replace_password'); ?>">Գաղտնաբառը?&nbsp&nbsp&nbsp&nbsp </a></span>
  
  </div>
</form>

</body>
</html>
