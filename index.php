<?php
include 'configs/_db.php';
$email = $_POST['email'];
$pwd = $_POST['pwd'];
if ($_SESSION['not_logged'] == true) {
    echo "You are not logged either you don't have permission";
    unset($_SESSION['not_logged']);
}
if (isset($_POST['login'])) {
    $query = "SELECT id, username, email, created, admin FROM clity_users WHERE email='$email'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $username = $row['username'];
            $created = $row['created'];
            $admin = $row['admin']; 
        }
    }
    $query = "SELECT pwd FROM clity_users_pwd WHERE id='$id'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify("$pwd", $row['pwd'])) {
                echo "Logged In Succefully";
                $_SESSION['logged'] = true;
            } else {
                echo "Wrong Credentials / Create an account or be more careful";
            }
        }
    } else {
        echo "Wrong Credentials";
    }
}
if ($_SESSION['logged'] == 1) {
    if ($admin == 1) {
        echo "<h2><a href=\"administrator/\">New Post</a></h2>";
        $_SESSION['admin'] = 1;
    }
    echo "<form action=\"./\" method=\"POST\"><input type=\"submit\" name=\"logOut\" value=\"Log Out\"></form"; //LOGOUT BUTTON
} else {
    // "Please log in to be able to post"; 
}
if (isset($_POST['logOut'])) {
    $_SESSION['logged'] = 0;
    $_SESSION['admin'] = 0;
    header("Refresh:0");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog - Engine</title>
</head>
<body>
    <form action="./" method="POST">
        <input type="email" name="email" placeholder="email...">
        <input type="password" name="pwd" placeholder="password...">
        <input type="submit" name="login" value="Login>>">
    </form>
    <h3><a href="register/">Register</a></h3>
</body>
</html>


<?php
include 'configs/_db.php';

$query = "SELECT id, title, date, content, allow_comments, author, img_url FROM clity_posts ORDER BY id DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "title: <a href=\"post?s=".$row['id']."\">".$row['title']."</a><br> date: ".$row['date']."<br> content: ".substr($row['content'], 0,50)."...<br> allow_comments: ".$row['allow_comments']."<br> author: ".$row['author']."<br> img link: <img src=\"".$row['img_url']."\"><br><br>";
    }
}
?>