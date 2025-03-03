<?php 
class functions{
   public function redirect($address){
   header("location:".$address);
}
public function setError($msg)
{
   $_SESSION['error']=$msg;
}
public function error()
{
   
}
}
$fn = new functions();
?>