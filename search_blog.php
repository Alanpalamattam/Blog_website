<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blog</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <h2>Search Blog</h2>
    <form action="search_blog.php" method="GET">
        <input type="text" name="query" placeholder="Search by title..." required>
        <button type="submit">Search</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $sql = "SELECT * FROM posts WHERE title LIKE '%$query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<article>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                echo "</article>";
            }
        } else {
            echo "<p>No matching blogs found!</p>";
        }
    }
    ?>
</main>

</body>
</html>
