<?php
include 'configs/_db.php';

$query = "SELECT title, date, content, allow_comments, author, img_url FROM clity_posts";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "title: ".$row['title']."<br> date: ".$row['date']."<br> content: ".$row['content']."<br> allow_comments: ".$row['allow_comments']."<br> author".$row['author']."<br> img link: <img src=\"".$row['img_url']."\"><br><br>";
    }
}
?>