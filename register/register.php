<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';

  $login = $_POST["login"];
  $pass = $_POST["pass"];
  $confirm = $_POST["rPass"];
  $phone = $_POST["phone"]; 

  if($pass == $confirm){
    echo "tak";
  }else{
    echo "nie";
  }
?>