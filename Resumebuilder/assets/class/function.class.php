<?php
session_start();
class Functions{

    public function redirect($address){
    header("Location:".$address);
    }

    public function setError($msg){
        $_SESSION['error']=$msg;
    }

     public function setAuth($data){
        $_SESSION['Auth']=$data;
    }

    public function Auth(){
        if(isset($_SESSION['Auth'])){
            return $_SESSION['Auth'];
        }else{
            return false;
        }
    }

     public function error(){

        if(isset($_SESSION['error'])){
            echo "Swal.fire('','".$_SESSION['error']."','error')";
            unset($_SESSION['error']);
        }
      
    }

    public function setAlert($msg){
        $_SESSION['alert']=$msg;
    }

    public function alert(){

        if(isset($_SESSION['alert'])){
            echo "Swal.fire('','".$_SESSION['alert']."','success')";
            unset($_SESSION['alert']);

        }
      
    }

    public function setSession($key,$value){
        $_SESSION[$key]=$value;
    }

    public function getSession($key){
        return $_SESSION[$key]??'';
    }

    public function authPage(){
        if(!isset($_SESSION['Auth'])){
        $this->redirect('login.php');
        }
    }

    public function nonAuthPage(){
        if(isset($_SESSION['Auth'])){
        $this->redirect('myresumes.php');
        }
    }

    public function randomstring(){
        $string="0123456789abcdefghijklmnopqrstuvwxyz_".time().rand(1111,2222333);
        $string=str_shuffle($string);
        return str_split($string,16)[0];
    }

}

$fn = new Functions();