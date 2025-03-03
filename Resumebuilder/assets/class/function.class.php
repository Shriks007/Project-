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
   if(isset( $_SESSION['error']))
   {
      echo "Swal.fire(null,".$_SESSION['error'].",'success')";
   }
}
public function setAlert($msg)
{
   $_SESSION['alert']=$msg;
}
}

$fn = new functions();
?>