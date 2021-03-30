<?php session_start(); ?>

<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

    if(isset($_SESSION['username']) and isset($_SESSION['password'])):

        header("refresh:0;url=/pages/");
        
    else:

        require '../lib/PHPMailer-master/src/PHPMailer.php';
        require '../lib/PHPMailer-master/src/Exception.php';
        require '../lib/PHPMailer-master/src/SMTP.php';

        if(isset($_POST["signup_submit"])):

        @$maill = htmlspecialchars($_POST['mail']);
        @$username = htmlspecialchars($_POST['username']);
        @$password = htmlspecialchars($_POST['password']);
        $status = 1;


        try{
            $db = new PDO("mysql:host=localhost;dbname=first_database;charset=utf8","root","");
            $db->exec('SET NAMES utf8');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch( PDOException $e){
            die($e->getMessage());
            $status = 0;
        }
        if($status == 1){
            $usernameLast = $username;
            $passwordLast = md5($password);
            $mailLast = $maill;
            $confirmLast = 0;
            $confirmKeyLast = md5(mt_rand(10000,99999));
            $query = "INSERT INTO note_app(username,password,mail,confirm,confirm_key) VALUES(?,?,?,?,?)";
            $prepared = $db->prepare($query);
            $prepared->execute(array($username,$passwordLast,$mailLast,$confirmLast,$confirmKeyLast));
            $activation = "/pages/activate.php?process=".$confirmKeyLast."";



            $mail = new PHPMailer(true);

            try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->Charset = 'UTF-8';                    //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info.notesup@gmail.com';                     //SMTP username
            $mail->Password   = 'LEvandovski35!';                               //SMTP password
            $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('info.notesup@gmail.com', 'NotesUp!');
            $mail->addAddress($mailLast);     //Add a recipient
            $mail->addReplyTo('info.notesup@gmail.com', 'User Replies');
            /*$mail->addCC('cc@example.com');*/
            $mail->addBCC($mailLast);

            //Attachments
            /*$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name*/

            //Content

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = ' NotesUp Account Verification';                                                                 // localhost/pages/activate.php?process='.$confirmKeyLast.'
            $mail->Body    = 'Please go to this link to activate your account! : <a style="text-decoration:none !important; color:blue" href="noteapp.duckdns.org'.$activation.'">ACTIVATE!</a> noteapp.duckdns.org'.$activation.'';
            /*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

            $mail->send();

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }




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
                    <title>Sign Up</title>
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
                        <div class="Row activationRow d-flex flex-column justify-content-center align-items-center">
                            <span>Your activation key sended your mail address :</span><br> <span class="mail-addr">'.$mailLast.'</span>
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

        }else{

            echo 'Can\'t connect to database';

        }

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
                    <link rel="icon" href="../images/edit.ico" type="image/icon type">
                    <link rel="stylesheet" href="../style/signup.css">
                    <title>Sign Up</title>
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
                            <form class="col-10 col-sm-4 col-md-4 col-lg-4 col-xl-3 d-flex flex-column justify-content-center " action="signup.php" method="POST" onsubmit="return confirm()">

                                <p>Mail</p>
                                <input id="mail" class="form-control password" type="text" name="mail" placeholder="Enter mail address">
                                <br>
                                <p>Username</p><input id="username" class="form-control username" type="text" name="username" placeholder="Enter Username">
                                <br>
                                <p>Password</p>
                                <input id="password" class="form-control password" type="password" name="password"  placeholder="Enter Password">
                                <br>
                                <p>Password Again</p>
                                <input id="password-again" class="form-control password" type="password" name="password"  placeholder="Password Again">
                                <br>
                                <button class="btn btn-lg btn-outline-light" name="signup_submit" id="login_submit_id">Sign Up</button>
                                <br>
                                <b  id="sub" style="display:none; font-size:15px !important;">passwords doesnt match</b>
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
