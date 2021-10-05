<?php

function show_categories(){
    $conn = mysqli_connect('localhost','root','','productdb');
    return mysqli_query($conn,"select * from tbl_users where ifnull(user_type,0) <> 1");
    }

$session_name = $this->session->userdata('session_name');

function show_user_info($session_name){
    $conn = mysqli_connect('localhost','root','','productdb');
    return mysqli_query($conn,"select * from tbl_users where email='$session_name' ");
    }  



 $show = show_categories();
 $show_user_info  = mysqli_fetch_array(show_user_info($session_name));

 
