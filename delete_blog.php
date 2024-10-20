<?php
// Include database connection
include 'db_connect.php';

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $delete_query = "DELETE FROM posts WHERE id = $id";

    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Blog deleted successfully!')</script>";
    } else {
        echo "Error deleting blog: " . $conn->error;
    }
}

// Fetch All Blogs to Display in Table
$blogs_query = "SELECT * FROM posts ORDER BY created_at DESC";
$blogs = $conn->query($blogs_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Delete Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="blogs-table">
        <h2>All Blogs</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($blogs->num_rows > 0): ?>
                    <?php while ($blog = $blogs->fetch_assoc()): ?>
                        <tr>
                            <td><?= $blog['id']; ?></td>
                            <td><?= $blog['title']; ?></td>
                            <td><?= $blog['author']; ?></td>
                            <td><?= $blog['category']; ?></td>
                            <td><?= substr($blog['content'], 0, 50) . '...'; ?></td>
                            <td>
                                <a href="delete_blog.php?delete_id=<?= $blog['id']; ?>" 
                                   onclick="return confirm('Are you sure you want to delete this blog?');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No blogs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
