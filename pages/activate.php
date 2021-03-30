<?php

  $status = 0;

  try{

    @$activation = htmlspecialchars($_GET['process']);

    // DATAASE CONNECTION   ---------------------------------------------------------- ---------------------------------------------------------- 
    try{

      $db = new PDO("mysql:host=localhost;dbname=first_database;charset=utf8","root","");
      $db->exec('SET NAMES utf8');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    catch( PDOException $e){
      die($e->getMessage());
      $status = 0;
    }
    // ---------------------------------------------------------- ----------------------------------------------------------

    $query = "SELECT id FROM note_app WHERE confirm_key='$activation'";

    $prepared = $db->prepare($query);
    $prepared->execute();
    $id = $prepared->fetchAll();

    $user_id = $id[0]['id'];

    $query_update = "UPDATE note_app SET confirm=1 WHERE id='$user_id'";

    $update = $db->prepare($query_update);
    $update->execute();
    $status = 1;

  }
  catch(Exception $e){

    echo 'There is error in server side!';

  }
    if($status == 1):

      echo '

        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
          <link rel="icon" href="../images/edit.ico" type="image/icon type">
          <link rel="stylesheet" href="../style/signup.css">
          <title>Login</title>
        </head>
        <body>
          <div class="container-fluid first">
              <div class="row second-row">
                  <div class="logo">
                      <img id="logo" src="../images/logo2.png" alt="logo">
                  </div>
              </div>
          </div>
          <div class="container-fluid second">
              <div class="Row activationRow d-flex flex-column justify-content-center align-items-center">
                <span style="color: green; font-size: 25px;">YOUR ACCOUNT IS ACTIVATED!</span> <br><a class="btn btn-lg btn-outline-light" href="/pages/login.php">Let\'s Start</a>
              </div>
          </div>

          <div class="container-fluid container-footer d-flex flex-column justify-content-center ">
              <div class="row footer">
                  <div class="col-12  d-flex justify-content-center align-items-center">
                      <div style="margin:20px;" class="contact">
                          <a  class="btn btn-outline-dark" href="https://github.com/kadiryaren"><img style="width: 20px;" src="../images/github.png" alt="github">  Contact Me!</a>
                      </div>
                      <div class="source-code">
                          <a  class="btn btn-outline-dark" href="https://github.com/kadiryaren"><img style="width: 20px;" src="../images/github.png" alt="github">  Source Code</a>
                      </div>
                  </div>
              </div>
          </div>

        </body>
        </html>';
    endif;

 ?>



