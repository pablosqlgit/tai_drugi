<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
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
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <nav>
      <div class='functional-buttons'>
        <form action="../main/main.php" method="post">
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
      <div class='order-history'>
        <?php
          $username = $_SESSION['username'];
          $orderedQ = "SELECT * FROM orders WHERE userName='$username'";
          $orderedTickers = mysqli_query($conn,$orderedQ);

          $i = 1;
          while($ticket = mysqli_fetch_assoc($orderedTickers)){
            echo "
              <div class='order-info'>
                <div class='order-count'>$i.</div>
                <div class='order-artist'>Wykonawca: $ticket[eventName]</div>
                <div class='order-price'>Cena: $ticket[ticketPrice]PLN</div>
                <div class='order-type'>Typ biletu: $ticket[ticketName]</div>
                <div class='order-date'>Data zakupu: $ticket[ticketDate]</div>
              </div>
            ";
            $i++;
          }
        ?>
      </div>
    </article>
</body>
</html>
