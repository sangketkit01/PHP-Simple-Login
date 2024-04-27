<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="Login.php" method="post">
        <label>Username</label><br>
        <input type="text" name="username" placeholder="Username"> <br>
        <label>Password</label> <br>
        <input type="password" name="password" placeholder="Password"> <br>
        <input type="submit" value="Login" name="login">
    </form>
    <label>Don't have an account? </label>
    <a href="Register.php">Create an account</a>
</body>

</html>

<?php
include("Connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) || empty($password)) {
            echo "Please enter Username and Password";
        } else {
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $data = mysqli_query($conn, $sql);

            $user_data = mysqli_fetch_assoc($data);

            $username_exist = mysqli_num_rows($data) > 0;
            $password_exist = password_verify($password, $user_data["password"]);

            if ($username_exist && $password_exist) {
                echo "<script type='text/javascript'>alert('Login successfully');</script>";

                $_SESSION["name"] = $user_data["name"];
                header("Location: Home.php");
            } else {
                echo "<script type='text/javascript'>alert('Invalid Username or Password');</script>";
            }

            mysqli_close($conn);
        }
    }
}
?>