<?php session_start() ?>

<?php

if(isset($_SESSION['username']) and isset($_SESSION['password'])): // CHECKS THAT ARE THERE USERNAME AND PASSWORD IN SESSION 

  header("refresh:0;url=/pages/main.php");

else:

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
            <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../style/index.css">
            <link rel="icon" href="../images/edit.ico" type="image/icon type">
            <title>NotesUP</title>
        </head>
        <body>
            <div class="container-fluid header">
                <div class="row header-row">
                    <div id="logo-div"><a href="index.php"><img  id="logo"  src="../images/logo2.png" alt="logo"></a></div>
                    <div id="form-div">
                        <a class="btn btn-lg btn-outline-light button" href="login.php">Login</a>
                        <a class="btn btn-lg btn-outline-light button" href="signup.php">Sign Up</a>
                    </div>

                </div>
                <div class="increase">
                    <p>Increase your productivity</p>

                </div>
                <div class="form-div-2">
                    <a class="btn  btn-outline-light button2" href="login.php">Login</a>
                    <a class="btn  btn-outline-light button2" href="signup.php">Sign Up</a>
                </div>
            </div>
            <div class="container-fluid second-container">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="card mt-5 col-11 col-sm-11 col-md-5 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center">
                        <img class="img" src="../images/task1.png" alt="task1">
                        <p class="card-text" >Fast</p>
                    </div>
                    <div class="card mt-5 col-11 col-sm-11 col-md-5 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center">
                        <img class="img" src="../images/task2.png" alt="task2">
                        <p class="card-text" >Easy</p>
                    </div>
                    <div class="card mt-5 col-11 col-sm-11 col-md-5 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center">
                        <img class="img" src="../images/task3.png" alt="task3">
                        <p class="card-text" >Colorful</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid thirth-container">
                <div class="row second-image">

                </div>

            </div>
            <div class="container-fluid ">
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
