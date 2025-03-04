
<?php

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


if($_POST){

$post=$_POST;

// echo "<pre>";
// print_r($post);



if($post['resume_id'] && $post['course'] && $post['institute'] && $post['started'] && $post['ended']){
$resumeid = array_shift($post);
$post2 = $post;
unset($post['slug']);
    $columns='';
    $values='';

   foreach($post as $index=>$value){
    $value=$db->real_escape_string($value);
    $columns.=$index.',';
    $values.="'$value',";
   }

$columns.='resume_id';
$values.=$resumeid;





    try{
    
        $query = "INSERT INTO educations";
        $query.="($columns) ";
        $query.="VALUES($values)";

     
       
 $db->query($query);

  $fn->setAlert('education added');
 $fn->redirect('../updateresume.php?resume='.$post2['slug']);


    }catch(Exception $error){
 $fn->setError($error->getMessage());
   $fn->redirect('../updateresume.php?resume='.$post2['slug']);
    }
   



}else{
     $fn->setError('please fill the form !');
      $fn->redirect('../updateresume.php?resume='.$post2['slug']);
    
}


}else{
     $fn->redirect('../updateresume.php?resume='.$post2['slug']);
}