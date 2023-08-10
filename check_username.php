<?php 
include_once "layout_top.php";

if(isset($_POST['user_adm'])){
    $username  = $_POST["user_adm"];
    $sql = $con->query("SELECT * FROM admin WHERE username  = '$username'");
    if($sql->rowCount() > 0){
         echo '<span class="text-danger">username sudah digunakan</span>';
    }else{
        echo '<span class="text-success">username bisa digunakan</span>';
    }
}
