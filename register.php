<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $password = $_GET["password"];
        $login = $_GET["login"];
        if (empty($password) || empty($login)){
            header("location: registerform.php");
        } else{
            $login = htmlentities($login, ENT_QUOTES, "UTF-8");
            $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        }

        session_start();

        require_once "db.php";
        $con = @mysqli_connect($server, $dbuser, $dbpassword, $dbname);

        if($con->connect_errno!=0){
            echo "Error ".$con->connect_errno;
        } else {
            $login = mysqli_real_escape_string($con, $login);
            $password = mysqli_real_escape_string($con, $password);

            $query = "select * from user WHERE login = '$login'";
            $insert = "insert into user (login, password, lvl) values ('$login', '$password', 100)";

            if ($queryoutput = $con->query($query)){
                if ($queryoutput->num_rows == 0){
                    $con->query($insert);
                    header("location: loginform.php");
                } else {
                    setcookie("register_error", "User exist", time()+10);
                    header("location: registerform.php");
                }
            }


        }
    ?>
</body>
</html>