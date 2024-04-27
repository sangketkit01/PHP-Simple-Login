<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Hello <?php echo $_SESSION["name"]?></h1> <br>
    <form action="Home.php" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>

<?php
    if(empty($_SESSION["name"])){
        header("Location: Login.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["logout"])){
            session_destroy();
            header("Location: Login.php");
        }
    }
?>