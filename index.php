<h2><a href="administrator/">New Post</a></h2>

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