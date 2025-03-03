<?php
require '../assets/class/database.php';
require '../assets/class/function.php';

if($_POST) 
{
$data=$_POST;


if($post['full_name'] && $post['email_id'] && $post['password'])
{
    $full_name=$db ->real_escape_string($post['full_name']);
    $email_id=$db->real_escape_string($post['email_id']);
    $password=md5($db->real_escape_string($post['password']));

    $db->query("INSERT INTO users(full_name,email_id,password) VALUES('$full_name','$email_id','$password')");



}else{   
    $fn->redirect('../register.php');
}


}else{
$fn->redirect('../register.php');
}
?>