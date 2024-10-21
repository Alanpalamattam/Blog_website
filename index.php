<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<?php include 'header.php'; 
?>

<main>
    <section class="posts">
        <h2>Recent Posts</h2>
    
        <?php
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p><strong>Author:</strong> " . htmlspecialchars($row['author']) . "</p>";
                echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                echo "<small>Posted on: " . $row['created_at'] . "</small>";
                echo "</article>";
            }
        } else {
            echo "<p>No posts found!</p>";
        }

        $conn->close();
        ?>
    </section>
</main>

</body>
</html>
