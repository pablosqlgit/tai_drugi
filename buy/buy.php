<?php
session_start();
?>

<html>
  <head>
    <link rel='stylesheet' href='style.css' />
  </head>
  <body>
    <?php 
      error_reporting(0);

      require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
      $urlQ = str_replace('ticket=', '', $_SERVER['QUERY_STRING']);

      $selectQ = "SELECT * FROM tickets WHERE ticketID = $urlQ";
      $res = mysqli_query($conn, $selectQ);

      $username = $_SESSION['username'];
      $eventName = $_SESSION['eventName'];
      $ticketName = $_SESSION['ticketName'];

      $ticketIDQ = "SELECT ticketName FROM tickets WHERE ticketID='$urlQ'";
      $ticketID = mysqli_query($conn,$ticketIDQ);
      $ticketName = mysqli_fetch_assoc($ticketID);
  
      $currDate = date("Y-m-d H:i:s");

      if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
          $currdate = date('Y-m-d');
          $insertQ = "INSERT INTO orders VALUES(null, '$username', '$eventName', '$row[eventID]', '$row[price]','$ticketName[ticketName]', '$currDate')";
          mysqli_query($conn, $insertQ);
          echo "
            <div class='ordered'>
              <div>
                <h1>Bilet został zamówiony</h1>
                <button>Strona główna</button>
              </div>
            </div>
          ";
        }
      }
    ?>
  </body>
  <script>
    const button = document.querySelector('button')
    
    button.addEventListener('click', () => {
      window.location.href = '/tai_drugi/main/main.php'
    })
  </script>
</html>