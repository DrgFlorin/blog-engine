<?php
include 'configs/_db.php';
$email = $_POST['email'];
$pwd = $_POST['pwd'];

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
                echo "Wrong Password";
            }
        }
    }
}
if ($_SESSION['logged'] == 1) {
    if ($admin == 1) {
        echo "<h2><a href=\"administrator/\">New Post</a></h2>";
    }
    echo "<form action=\"./\" method=\"POST\"><input type=\"submit\" name=\"logOut\" value=\"Log Out\"></form";
} else {
    "Please log in to be able to post";
}
if (isset($_POST['logOut'])) {
    $_SESSION['logged'] = 0;
    header("Refresh:0");
}

?>
<form action="./" method="POST">
    <input type="email" name="email" placeholder="email...">
    <input type="password" name="pwd" placeholder="password...">
    <input type="submit" name="login" value="Login>>">
</form>
<h3><a href="register/">Register</a></h3>


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