<?php
    session_start();
    if($_SESSION['logstatus'] === "no") {
    header("Location: ../login/login.php");
    }
    
    if (isset($_POST['logout_input'])) {
    $_SESSION['logstatus'] = "no";
    header('Location: ../login/login.php');
    }

    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="../main/style.css" />
  </head>
  <body>
    <nav>
      <div class='functional-buttons'>
        <form action="main.php" method="post">
          <input type="submit" value="Wróć" id="back-button" name="backbutton">
        </form>
        <span>
          <h1>
            My account
          </h1>
        </span>
      </div>
      <div class='functional-buttons'>
        <form method='post' action='../account/account.php'>
          <input type='submit' value='Moje konto' name="my-account"/>   
        </form>
        <form action="account.php" method="post">
          <input type='submit' value='Wyloguj się' name='logout_input' />      
        </form>
      </div>
    </nav>
    <article id="accounts-container">
      <h1>
        Order history
      </h1>
    </article>
</body>
</html>
