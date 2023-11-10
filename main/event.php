<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
  session_start();
  if($_SESSION['logstatus'] !== "yes") {
    header("Location: ../login/login.php");
  }

  if (isset($_POST['logout_input'])) {
    $_SESSION['logstatus'] = "no";
    header('Location: ../login/login.php');
  }
  
  $urlQ = str_replace('event=', '', $_SERVER['QUERY_STRING']);
  // echo $urlQ;
  
  if(isset($_POST['buy-ticket'])){
    header("Location: ../buy/buy.php?event=" . $urlQ);
  }
  
  $eventQuery = "SELECT name, description, location, date FROM events WHERE id=$urlQ";
  $imageQuery = "SELECT src FROM images WHERE eventID=$urlQ";
  $eventQueryUse = mysqli_query($conn, $eventQuery);
  $imageQueryUse = mysqli_query($conn, $imageQuery);
  
  $eventInfo = mysqli_fetch_assoc($eventQueryUse);
  $imageInfo = mysqli_fetch_assoc($imageQueryUse);
  
  $eventName =  $eventInfo['name'];
  $eventDesc = $eventInfo['description'];
  $eventLocat = $eventInfo['location'];
  $eventDate =  $eventInfo['date'];
  
  $imageSrc = $imageInfo['src'];
  
  $_SESSION['eventName'] = $eventName;

  // echo $imageSrc;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo trim($eventName) ."'s concert"?></title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <nav>
      <div class='functional-buttons'>
        <form action="main.php" method="post">
          <input type="submit" value="Wróć" id="back-button" name="backbutton">
        </form>
        <span>
          <h1>
            <?php echo trim($eventName) ."'s concert"?> 
          </h1>
        </span>
      </div>
      <div class='functional-buttons'>
        <form method='post' action='../account/account.php'>
          <input type='submit' value='Moje konto' name="my-account"/>   
        </form>
        <form action="event.php" method="post">
          <input type='submit' value='Wyloguj się' name='logout_input' />      
        </form>
      </div>
    </nav>
    <article id="event-article">
      <div id="image-container">
        <img src="../images/<?php echo $imageSrc;?>">
      </div>
      <div id="info-container">
        <div id="important-info-container">
          <div>
            <span>Wykonawca: <?php echo $eventName;?></span> <br>
          </div>
          <div>
            <span>Data: <?php echo $eventDate;?></span> <br>
          </div>
          <div>
            <span>Lokalizacja: <?php echo $eventLocat;?></span> <br>
          </div>
        </div>
        <div class='tickets-table'>
          <div class='tickets'>
            <?php 
              require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
              $urlQ = str_replace('event=', '', $_SERVER['QUERY_STRING']);

              $selectQ = "SELECT * FROM tickets WHERE eventID = $urlQ";
              $res = mysqli_query($conn, $selectQ);
              // $res2 = mysqli_query($conn, $selectQ);

              if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_assoc($res)){
                  // echo $row['ticketName'];
                  echo "
                    <div class='ticket'>
                      <span class='ticket-name'>$row[ticketName]</span>
                      <div>
                        <span>$row[price]PLN</span>
                        <div>
                          <a href='../buy/buy.php?ticket=$row[ticketID]'>Kup bilet</a>
                        </div>
                      </div>
                    </div>
                  ";
                }
              }

              // $ticketID = mysqli_fetch_assoc($res2);
              // $_SESSION['ticketName'] = $ticketID['ticketID'];
              // echo $_SESSION['ticketName'];
            ?>
          </div>
      </div>
    </article>
</body>
</html>
