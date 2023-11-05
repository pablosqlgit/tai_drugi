<html>
  <head>
    <link rel="stylesheet" href="../styles/register.css">
  </head>
  <body>
    <section>
      <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';
        if(isset($_POST['login-button'])){
          header("Location: ../login/index.html");
        }else if(isset($_POST['register-button'])){
          header("Location: index.html");
        }else{

          if(isset($_POST['login'])){
            $login = $_POST["login"];
            $pass = $_POST["pass"];
            $hash = password_hash($pass,PASSWORD_DEFAULT);
            $phone = $_POST["phone"]; 

            $insertQ = "INSERT INTO users VALUES(null, '$login', '$hash' , '$phone')";
            $selectQ = "SELECT * FROM users WHERE login = '$login'";
            $res = mysqli_query($conn, $selectQ);

            if(mysqli_num_rows($res) > 0){
              echo "
              <div class='register-container'>
                <header>
                  <h1>Taki użytkownik już istnieje</h1>
                  <h6>Spróbuj zarejestrować się ponownie przy użyciu poniższego przycisku</h6>
                </header>
                <form method='post'>
                  <input type='submit' value='Zarejestruj się' name='register-button' />
                </form>
              </div>";
            }else{
              if(mysqli_query($conn, $insertQ)){
                echo "
                <div class='register-container'>
                  <header>
                    <h1>Zarejestrowano pomyślnie!</h1>
                    <h6>Przejdź na stronę logowania przy użyciu poniższego przycisku</h6>
                  </header>
                  <form method='post'>
                    <input type='submit' value='Zaloguj się' name='login-button'>
                  </form
                </div>";
              }else{
                echo "
                <div class='register-container'>
                  <header>
                    <h1>Wystąpił błąd podczas rejestracji</h1>
                    <h6>Spróbuj zarejestrować się ponownie przy użyciu poniższego przycisku</h6>
                  </header>
                  <form method='post'>
                    <input type='submit' value='Zarejestruj się' name='register-button' />
                  </form>
                </div>";
              }
            }
          }
        }
      ?>
    </section>
  </body>
</html>