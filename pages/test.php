<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>

</head>
<body>
    <div class="container">
        <div class="row col-12 col-md-12 col-xl-12 mt-5">
            <form class="col-12" id="form">
                <input type="text" name="input1">
            </form>
            <button id="buton" class="btn btn-outline-success" onclick="start()">Send</button>
        </div>
        <div class="text"></div>
    </div>
    <script>
        function start(){
            $.ajax({
                type:"POST",
                url:"/pages/test2.php",
                data:$("#form").serialize(),
                success:function(cevap){
                    $("#form").trigger("reset");
                    $(".text").html(cevap);
                }
            });
        }
    </script>
    
   
</body>
</html>