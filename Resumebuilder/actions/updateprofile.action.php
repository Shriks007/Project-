<?php
session_start();
require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if($_POST){

$post=$_POST;

if($post['full_name'] && $post['email_id']){

   

    $full_name=$db->real_escape_string($post['full_name']);
    $email_id=$db->real_escape_string($post['email_id']);
    $password=md5($db->real_escape_string($post['password']));
$authid = $fn->Auth()['id'];

$result=$db->query("SELECT COUNT(*) as user FROM users WHERE (email_id='$email_id' && id!=$authid)");

$result = $result->fetch_assoc();

if($result['user']){

 $fn->setError($email_id.' is already registered !');
$fn->redirect('../account.php');
die();
}
  

if($password!=''){
 $db->query("UPDATE users SET full_name='$full_name',email_id='$email_id',password='$password' WHERE id=$authid");
}else{
 $db->query("UPDATE users SET full_name='$full_name',email_id='$email_id' WHERE id=$authid");
}

  $fn->setAlert('profile is updated !');
 $fn->redirect('../account.php');


    
   



}else{
     $fn->setError('please fill the form !');
    $fn->redirect('../account.php');
    
}


}else{
    $fn->redirect('../account.php');
}