<html>
  <head>
    <link rel='stylesheet' href='style.css' />
  </head>
  <body>
    <?php 
      require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
      $urlQ = str_replace('ticket=', '', $_SERVER['QUERY_STRING']);

      $selectQ = "SELECT * FROM tickets WHERE ticketID = $urlQ";
      $res = mysqli_query($conn, $selectQ);

      if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
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