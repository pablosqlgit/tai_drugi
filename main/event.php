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
  
  $_SESSION['urlQ'] = $urlQ;
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
        <div id="buying-div">
          <div>
            <span><?php echo $eventDesc;?></span> <br> 
          </div>
          <!-- miejsce na button -->
          <div>
            <form method="post">
              <input type='submit' value='Kup se bilet' name='buy-ticket'></input>
            </form>
          </div>
        </div>
      </div>
    </article>
</body>
</html>
