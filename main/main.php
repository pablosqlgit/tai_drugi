<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
  session_start();
  if($_SESSION['logstatus'] === "no") {
    header("Location: ../login/login.php");
  }elseif($_SESSION['logstatus'] = "yes"){
    echo "witaj na ticketseventorder " . $_SESSION['username'] . "!";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Strona Główna</title>
</head>
<body>
  <form action="main.php" method="post">
    <input type="submit" value="wyloguj się" name="logout_input">
  </form>
  <?php
    if (isset($_POST['logout_input'])) {
      $_SESSION['logstatus'] = "no";
      header('Location: ../login/login.php');
    }
  ?>
</body>
</html>