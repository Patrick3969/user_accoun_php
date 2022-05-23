<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <h1><?php
            session_start();
            if (!empty($_SESSION["userID"])){
                require_once "db.php";
                $con = @mysqli_connect($server, $dbuser, $dbpassword, $dbname);
                $userID = $_SESSION["userID"];
                if ($con->connect_errno != 0){
                    echo "error ".$con->connect_errno;
                } else{
                    $lvl = $con->query("select user.lvl from user where userID ='$userID'")->fetch_assoc();
                    echo "twój lvl wynosi ".$lvl["lvl"];
                }
            } else{
                header("location: loginform.php");
            }
            ?></h1>
        <input type="button" value="wyrejestruj" class="deregister">
        <script>document.querySelector("input").addEventListener("click",function (){location.href="deregister.php"})</script>
    </div>
</body>
</html>