<?php
include '../configs/_db.php';
$id = $_REQUEST['s'];

$query = "SELECT title, date, content, allow_comments, author, img_url FROM clity_posts WHERE id='$id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $title = $row['title'];
        $date = $row['date'];
        $content = $row['content'];
        $allow_comments = $row['allow_comments'];
        $author = $row['author'];
        $img_url = $row['img_url'];
    }
} else {
    $title = "NO POSTS FOUND / SO NO TITLES FOUND";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
</head>
<body>
<h2><a href="../">Go back</a></h2>
<?php
echo "<h2>$title</h2>\n";
echo "Author: ".$author."<br>";
echo $date."<br>";
echo "<img src=\"".$img_url."\"><br>";
echo $content."<br>";
if ($allow_comments == true) {
    echo "<br>Comments are allowed<br>";
} else {
    echo "<br>Comments are disabled<br>";
}


?>

</body>
</html>