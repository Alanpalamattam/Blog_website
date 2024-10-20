<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Add a New Blog</h2>
    <form action="add_blog.php" method="POST">
        <label>Author:</label>
        <input type="text" name="author" required><br>

        <label>Category:</label>
        <input type="text" name="category" required><br>

        <label>Title:</label>
        <input type="text" name="title" required><br>

        <label>Content:</label>
        <textarea name="content" rows="6" required></textarea><br>

        <button type="submit" name="submit">Add Blog</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $author = $_POST['author'];
        $category = $_POST['category'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "INSERT INTO posts (author, category, title, content) 
                VALUES ('$author', '$category', '$title', '$content')";

        if ($conn->query($sql) === TRUE) {
            
echo "<script>
    alert('Blog added successfully!');

</script>";


        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
    $conn->close();
    ?>
</main>

</body>
</html>
