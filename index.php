<?php
include 'configs/_db.php';

// CHECK AND SET DEFAULT LINK TO 1'st PAGE
if ($_SERVER['REQUEST_URI'] == "/$folder_of_website/") {
    header("Location: ?p=1");
}
// GETTING LOGIN DATA
$email = $_POST['email'];
$pwd = $_POST['pwd'];

// THIS IS REDIRECT FROM ADMIN WHEN USER TRIES TO ACCES IT W/OUT PERMISSION
if ($_SESSION['not_logged'] == true) {
    echo "You are not logged either you don't have permission";
    unset($_SESSION['not_logged']);
}

// LOGGIN IN AND SAVING USERS DATA IN VARIABLES
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

    // PART OF LOGGING PROCCES - PASSWORD VERIFICATION
    $query = "SELECT pwd FROM clity_users_pwd WHERE id='$id'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if (password_verify("$pwd", $row['pwd'])) {
                echo "Logged In Succefully";
                $_SESSION['logged'] = true;
            } else {
                echo "Wrong Credentials / Create an account or be more careful"; // IF WRONG PASSWORD
            }
        }
    } else {
        echo "Wrong Credentials"; // IF NO USER FOUND
    }
}

// CHECK IF USER IS ADMIN OR NOT
if ($_SESSION['logged']) {
    if ($admin == 1) {
        echo "<h2><a href=\"administrator/\">New Post</a></h2>";
        $_SESSION['admin'] = true;
    }
    echo "<form action=\"./\" method=\"POST\"><input type=\"submit\" name=\"logOut\" value=\"Log Out\"></form"; //LOGOUT BUTTON
} else {
     echo "Please login as admin to be able to post"; // IF THE USER IS NOT ADMIN DOES THIS
}
if (isset($_POST['logOut'])) {
    $_SESSION['logged'] = false;
    $_SESSION['admin'] = false;
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

<?php
    // GETTING THE HIGHEST ID FROM POSTS
    $query = "SELECT MAX(id) AS largest_id FROM clity_posts";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $highest_id = $row['largest_id'];
        }
    }
    // PAGINATION // ISSUES PROBLEM
    $page = $_REQUEST['p'];
    if ($page > 1) {
        $highest_id = --$page * ++$posts_per_page;
    }
    $lowest_id = $highest_id - --$posts_per_page;
    echo "low :".$lowest_id." high: ".$highest_id."<br>";

    /*
    $big_page = $page * $posts_per_page;
    $small_page = --$page * $posts_per_page;
     REMAKE THIS
    p1 = 1 * 2 = 2; 2posts 1 2
    p2 = 2 * 2 = 4; 2posts 3 4
    */

    // DISPLAY THE POSTS
    $query = "SELECT id, title, date, content, allow_comments, author, img_url FROM clity_posts WHERE id BETWEEN $lowest_id AND $highest_id ORDER BY id DESC";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "title: <a href=\"post?s=".$row['id']."\">".$row['title']."</a><br> date: ".$row['date']."<br> content: ".substr($row['content'], 0,50)."...<br> allow_comments: ".$row['allow_comments']."<br> author: ".$row['author']."<br> img link: <img src=\"".$row['img_url']."\"><br><br>";
        }
    }
?>

</body>
</html>


