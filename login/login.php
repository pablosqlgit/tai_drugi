<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
    
    session_start();
    if($_SESSION['logstatus'] === "yes"){
        header("Location: ../main/main.php");
    }else{
        session_destroy();
        session_start();
        $_SESSION['logstatus'] = "no";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zaloguj się</title>
  <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
  <section>
    <form method="post" action="login.php">
      <header>
        <h1>Zaloguj się</h1>
      </header>
      <span class='login-control'>
        <input type="text" name="login" placeholder="Login" required>
      </span>
      <span class="pass-control">
        <input type="password" name="pass" placeholder="Password" required>
      </span>
      <input type="submit" id="submit" name="submitlogin" value="Zaloguj się">
    </form>
  </section>
</body>
</html>
<?php
    $username = $_POST['login'];
    $password = $_POST['pass'];
    
    $userQ = "SELECT login FROM users WHERE login = '$username'";
    $passQ = "SELECT pass FROM users WHERE login = '$username'";
    
    $userRes = mysqli_query($conn,$userQ);
    $passRes = mysqli_query($conn,$passQ);
    
    
    if (mysqli_num_rows($userRes) == 1) {
        $passCheck = mysqli_fetch_assoc($passRes);
        if (password_verify($password, $passCheck['pass'])){
            header("Location:../main/main.php");
            $_SESSION['username'] = $username;
            $_SESSION['logstatus'] = "yes";
        }elseif($password === $passCheck['pass']){ //delete it after deployment;
            header("Location:../main/main.php");
            $_SESSION['username'] = $username;
            $_SESSION['logstatus'] = "yes";
        }
    }elseif (mysqli_num_rows($userRes) == 0) {
        echo "such a user does not exists";
    }
?>