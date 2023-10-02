<?php 
    session_start(); 
    if(isset($_SESSION['name']) && isset($_SESSION['email']) && $_SESSION['login_status']=='1') {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
    }
    else{
        header('Location: index.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assests/css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div id="panel-content">
                <h1>👋Hello</h1>
                <div>
                    <?php echo $name ?> 
                    <br>
                    <?php echo $email ?>
                    <a href="" id="logout">Logout</a>
                </div>
                <div>
                    <img src="./assests/images/contents.png" alt="Contents" draggable="false">
                </div>
            </div>
        </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="./assests/js/script.js"></script>
</body>
</html>