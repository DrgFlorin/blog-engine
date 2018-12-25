<?php
//error_reporting(0);
include '../configs/_db.php';
$title = $_POST['title'];
$content = $_POST['content'];
$allow_comments = $_POST['allow_comments'];
$author = $_POST['author'];
$img_url = $_POST['img_url'];

// ADDING THE TITTLE TO THE SESSION
$_SESSION['title'] = $title;

$query = "INSERT INTO clity_posts (`title`, `content`, `allow_comments`, `author`, `img_url`) VALUES ('$title', '$content', '$allow_comments', '$author', '$img_url')";

if (isset($_POST['addBtn'])) {
    if ($conn->query($query) === true) {
        echo "Post Added";
    } else {
        echo "Error: " .$query."<br>". $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clity - Blog engine</title>
</head>

<body>
    <form action="index.php" method="POST">
        <input type="text" name="title" placeholder="title...">

        <textarea rows="4" cols="50" name="content" placeholder="content..."></textarea>
        <div class="question">Allow Comments?</div>
        <select name="allow_comments">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <input type="number" name="author" placeholder="author...ID">

        <input type="text" name="img_url" placeholder="image...">

        <input type="submit" name="addBtn" value="Add Post">
    </form>
</body>
</html>