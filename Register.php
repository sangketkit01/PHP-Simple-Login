<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <a href="Login.php">Go back</a>
    <form action="Register.php" method="post">
        <label>Username</label><br>
        <input type="text" name="username" placeholder="Username"><br>
        <label>Password</label><br>
        <input type="password" name="password" placeholder="Password"><br>
        <label>Confrim Password</label> <br>
        <input type="password" name="confirm_pass" placeholder="Confirm Password"> <br>
        <label>Name</label> <br>
        <input type="text" name="name" placeholder="Name"> <br>
        <input type="submit" name="submit" value="Create account">
    </form>

</body>

</html>

<?php
include("Connect.php");

if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    if (isset($_POST["submit"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirm_pass = filter_input(INPUT_POST, "confirm_pass", FILTER_SANITIZE_SPECIAL_CHARS);;
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);;


        if (empty($name) || empty($password) || empty($name) || empty($confirm_pass)) {
            echo "Please fullfill in all field";
        } elseif ($password != $confirm_pass) {
            echo "Password does not match";
        } else {
            try {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username,password,name) values('$username','$hash','$name')";

                mysqli_query($conn, $sql);

                echo "<alert>Create account successfully</alert>";
                header("Location: Login.php");

                mysqli_close($conn);
            } catch (mysqli_sql_exception) {
                echo "Username already taken";
            }
        }
    }
}
?>