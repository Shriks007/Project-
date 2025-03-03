<?php 
class functions{
   public function redirect($address){
   header("location:".$address);
}

}
$fn = new functions();
?>