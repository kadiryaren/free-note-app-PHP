<?php session_start(); ?>

<?php
    // CHECKS ARE THERE USERNAME AND PASSWORD IN SESSION 
    if(isset($_SESSION['username']) and isset($_SESSION['password'])):

      header("refresh:0;url=/pages/main.php");

    else:

      $check = 1;

      if(isset($_POST['login-submit'])):

        $username = htmlspecialchars($_POST['username-login']); // GETS LOGIN FORM DATAS 
        $password = htmlspecialchars($_POST['password-login']);

        // DATABASE CONNECTION 
        try{

          $db = new PDO("mysql:host=localhost;dbname=first_database;charset=utf8","root","");
          $db->exec('SET NAMES utf8');
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }     // DATABASE CONNECTION ERROR CATCH 
        catch( PDOException $e){
          die($e->getMessage());
          $status = 0;
        }

        // CHECKS IS THERE ANY USER ON  DATABASE MATCH THIS CONDITION 
        $query = "SELECT password,confirm,mail  FROM note_app WHERE username='$username'"; 
        $prepared = $db->prepare($query);
        $prepared->execute();

        if($prepared->rowCount() > 0):

          $data = $prepared->fetchAll();

          if(md5($password) == $data[0]['password']):

            if($data[0]['confirm'] == 0):

              $check = 2;

            else:

              $_SESSION['username'] = $username;
              $_SESSION['password'] = md5($password);

              header("refresh:0;url=/pages/main.php");

            endif;

          else:

            $check = 0;

          endif;
        endif;
      endif;

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
                      <a href="/pages/index.php"><img id="logo" src="../images/logo2.png" alt="logo"></a>
                  </div>
              </div>
          </div>
          <div class="container-fluid second">
              <div class="Row d-flex justify-content-center align-items-center">
                  <form class="col-10 col-sm-4 col-md-4 col-lg-4 col-xl-3 d-flex flex-column justify-content-center " action="login.php" method="POST">
                      <p>Username</p><input id="username" class="form-control username" type="text" name="username-login" placeholder="Enter Username">
                      <br>
                      <p>Password</p>
                      <input id="password" class="form-control password" type="password" name="password-login"  placeholder="Enter Password">
                      <br>
                      <button class="btn btn-lg btn-outline-light" name="login-submit" id="login_submit_id">Login</button>
                      <br>';

    if($check == 0):

      echo '
          <div style="display:flex;justify-content:center;align-items:center;font-size: 20px; color: rgb(255, 136, 0);">
              Username or Password is invalid!
          </div>';

      elseif($check == 2):

        echo '
            <div style="display:flex;justify-content:center;align-items:center;font-size: 20px; color: rgb(255, 136, 0);">
                Your account is not confirmed! Please check your mail : '.$data[0]['mail'].'
            </div>';

    else:

        echo '
                </form>
              </div>

          </div>
          <script>
          function confirm(){
              if(document.getElementById("password").value === document.getElementById("password-again").value){
              return true;
              }else{
                  console.log("esit degil");
                  document.getElementById("sub").style.display = "block";
                  document.getElementById("sub").style.color = "red";
                  return false;
              }
          }

          </script>
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
    endif;
 ?>
