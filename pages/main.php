<?php session_start(); ?>
<?php
    include 'database.php';
    $show_site = 0; // only for debugging. If there is any error in file, site wont load and will print error message!

    // DB CONNECTION ------------------------------------------------------------------------------------------
    $db = database::database_check();
    // --------------------------------------------------------------------------------------------------------

    @$process = htmlspecialchars($_GET['process']);

    if($process == "log-out"): // DELETES ALL SESSION VARIABLES

        session_destroy();
        header("refresh:0;url=/pages/");


    elseif($process == "insert"): // NEW NOTE SAVING PROCESS


        @$note = htmlspecialchars($_POST['text-area']);
        $username = $_SESSION['username']; //$_SESSION['username'];
        $get_user_id_query = "SELECT id  FROM  note_app WHERE username='$username' ";
        $prepare_userID = $db->prepare($get_user_id_query);
        $prepare_userID->execute();

        
        $note_count = $prepare_userID->rowCount();
        $data_userid = $prepare_userID->fetchAll();
        $userid = $data_userid[0]['id'];


        $add_user_notes = "INSERT INTO notes(userID,note) VALUES(?,?) ";
        $add_usernotes = $db->prepare($add_user_notes);
        $add_usernotes->execute(array($userid,$note));

        
        $show_site = 1; // IF PROCESS SUCCES, SHOW SITE
        header("refresh:0;url=/pages/main.php");


    elseif($process == "delete-item"):


        if(isset($_POST['delete-button'])):

            $item_id = htmlspecialchars($_POST['note_id']);
            $query_delete = "DELETE FROM notes WHERE id=$item_id";
            $prepare_delete = $db->prepare($query_delete);
            $prepare_delete->execute();
            $show_site = 1;

        else:

            echo 'process unsuccesful';

        endif;


    elseif($process  == "update-item"):

        $note_id = htmlspecialchars($_POST['note_id']); 
        $item_input = htmlspecialchars($_POST['item-input']);
        $query_update_note =  "UPDATE notes SET note='$item_input' WHERE id='$note_id'";
        $prepare_update = $db->prepare($query_update_note);
        $prepare_update->execute();
       
        $show_site = 1;
        
        header('refresh:0;url=/pages/main.php');

    else:

        $show_site  = 1;

    endif;

    
    if($show_site == 1):

        $username = $_SESSION['username']; //$_SESSION['username'];
        $get_user_id_query = "SELECT id  FROM  note_app WHERE username='$username' ";
        $prepare_userID = $db->prepare($get_user_id_query);
        $prepare_userID->execute();
        
        $note_count = $prepare_userID->rowCount();
        $data_userid = $prepare_userID->fetchAll();
        $userid = $data_userid[0]['id'];
        $get_user_notes = "SELECT id,note FROM notes WHERE userID=$userid ";
        $usernotes = $db->prepare($get_user_notes);
        $usernotes->execute();

        $data_usernote_last = $usernotes->fetchAll();
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
                <link rel="stylesheet" href="../style/main.css">
                <title>NotesUp</title>
            </head>
            <body>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="image">
                            <a href="/pages/index.php"><img id="logo" src="../images/logo2.png" alt=""></a>
                        </div>
                        <div class="signout mr-5">
                            <a class="btn btn-outline-light" href="/pages/main.php?process=log-out">Log Out</a>
                        </div>
                    </div>
                </div>
                <div class="container mt-5 ">
                    <form class="d-flex flex-column justify-content-center " action="/pages/main.php?process=insert" method="post">
                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                            <label class="input-title" for="comment">Note</label>
                            <br>
                            <textarea name="text-area" class="form-control" rows="5" id="comment"></textarea>
                            <br>
                        </div>
                        <input class="btn btn-lg btn-outline-light send-button" type="submit" name="input-content-submit-button" value="Save">
                    </form>
                    <br>
                    <br>
                <hr>
                <br><br>
                </div>
                <div class="container-fluid data-display">
                    <div class="row  d-flex justify-content-center align-items-center">
                        <p class="last-notes-title">Last Notes</p>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center align-items-center">';


        if($usernotes->rowCount() > 0):

            for($i = 0; $i<$usernotes->rowCount();$i++){

                echo '
                <div class="content-row col-11 col-md-4 col-xl-2 d-flex flex-column align-items-center">
               
                    <div class="d-flex justify-content-around align-items-center">
                        <form class="d-flex  justify-content-start delete-form " action="/pages/main.php?process=delete-item" method="post">
                            <input name="note_id" type="hidden" value="'.$data_usernote_last[$i]['id'].'">
                            <input class="btn btn-outline-danger"  type="submit" name="delete-button" value="Delete">
                        </form>
                        <div class="change-button" ><button class="btn btn-outline-primary" name="update-button" id="update-button'.$data_usernote_last[$i]["id"].'">Change</button></div>
                    </div>

                    <hr>
                    <form id="update-form'.$data_usernote_last[$i]["id"].'" class="d-flex  justify-content-end update-form m-3" action="/pages/main.php?process=update-item" method="post">
                        <input name="note_id" type="hidden" value="'.$data_usernote_last[$i]['id'].'">
                        <textarea class="form-control update-input" id="x'.$data_usernote_last[$i]["id"].'" name="item-input" type="text" >'.$data_usernote_last[$i]['note'].'</textarea>
                    </form>
                </div>
                <script type="text/javascript">
                    textarea = document.querySelector("#x'.$data_usernote_last[$i]["id"].'");
                    textarea.style.height = textarea.scrollHeight + "px";
                    
                    textarea.addEventListener("input", autoResize, false);
             
                    function autoResize() {
                        this.style.height = "auto";
                        this.style.height = this.scrollHeight + "px";
                    }
                </script>
                <script>
                    document.getElementById("update-button'.$data_usernote_last[$i]["id"].'").addEventListener("click",function(){
                        document.getElementById("update-form'.$data_usernote_last[$i]["id"].'").submit();
                    });
                </script>';
            }

        else:

            echo '
            <div class="content-row col-11 col-md-4 col-xl-2">
                <p class="text-content">There is no notes  here! Create One!</p>
            </div>';

        endif;   

     echo'
            </div>
            </div>
            
        

        
            <div class="container-fluid container-footer d-flex flex-column justify-content-center footer ">
            <div class="row">
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

    else:

        echo '$show_site = 0';

    endif;

 ?>
