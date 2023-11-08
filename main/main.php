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
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <nav>
    <span>
      <h1>
        Witaj, {username}!
      </h1>
    </span>
    <div class='functional-buttons'>
      <form method='post'>
        <input type='submit' value='Moje konto' />      
      </form>
      <form>
        <input type='submit' value='Wyloguj się' name='logout_input' />      
      </form>
    </div>
  </nav>
  <article>
    <section>
      <?php 
      
        if (isset($_POST['logout_input'])) {
          $_SESSION['logstatus'] = "no";
          header('Location: ../login/login.php');
        }
      
        require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';

        $selectQ = "SELECT * FROM events INNER JOIN images ON images.eventID = events.id INNER JOIN cheapest ON cheapest.eventID = events.id;";
        $res = mysqli_query($conn, $selectQ);

        $ticketsQ = "SELECT * FROM events INNER JOIN images ON images.eventID = events.id";
      
        if(mysqli_num_rows($res) > 0){
          while($row = mysqli_fetch_assoc($res)){
            echo "
              <div class='concert-container'>
                <div class='event-image'>
                  <img src='../images/$row[src]'>
                </div>
                <div class='event-data'>
                  <span class='event-name'>
                    $row[name]
                  </span>
                  <span class='event-location'>
                    Lokalizacja: $row[location]
                  </span>
                  <span class='event-date'>
                    Data: $row[date]
                  </span>
                  <span class='tickets-price'>
                    Bilety od: $row[lowest_value]PLN
                  </span>
                </div>
                <div class='buy-ticket'>
                  <a href='event.php?event=$row[id]'>Kup bilet</a>
                </div>
              </div>
            ";
          }
        }
      ?>
    </section>
  </article>
</body>
</html>