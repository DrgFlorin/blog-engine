<?php
include '../configs/_db.php';
$username = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$pwdConfirm = $_POST['pwdConfirm'];

if (isset($_POST['register'])) {
    if ($pwd == $pwdConfirm) {

        $query = "INSERT INTO clity_users (`username`, `email`) VALUES ('$username', '$email')";
        $pwdEnc = password_hash($pwd, PASSWORD_BCRYPT);
        $queryPwd = "INSERT INTO clity_users_pwd (`pwd`) VALUES ('$pwdEnc')";

        if ($conn->query($query) === TRUE && $conn->query($queryPwd)) {
            echo "Succesfully Registered";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "Passwords don't match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h3><a href="../">Back to Main</a></h3>
    <form action="./" method="POST">
        <input type="text" name="username" placeholder="username...">
        <input type="email" name="email" placeholder="email...">
        <input type="password" name="pwd" placeholder="password...">
        <input type="password" name="pwdConfirm" placeholder="confirm password...">
        <input type="submit" name="register" value="Register>>">
    </form>
</body>
</html>