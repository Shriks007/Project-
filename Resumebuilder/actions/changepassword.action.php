<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if($_POST){


$post=$_POST;

if($post['password']){

   $password=md5($db->real_escape_string($post['password']));
   $email = $fn->getSession('email');

$db->query("UPDATE users SET password='$password' WHERE email_id='$email'");
  

      $fn->setAlert('password is changed !');
      $fn->redirect('../login.php');
   



}else{
     $fn->setError('please enter your new password');
    $fn->redirect('../change-password.php');
    
}


}else{
    $fn->redirect('../change-password.php');
}