<?php
// Include database connection
include 'db_connect.php';

// Fetch the blog to be updated if an ID is provided via GET
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $blog_query = "SELECT * FROM posts WHERE id = $id";
    $blog_result = $conn->query($blog_query);
    $blog = $blog_result->fetch_assoc();
}

// Handle form submission to update the blog
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    // SQL query to update the blog
    $update_query = "UPDATE posts SET 
                     author='$author', 
                     title='$title', 
                     category='$category', 
                     content='$content' 
                     WHERE id=$id";

    if ($conn->query($update_query) === TRUE) {
    } else {
        echo "Error updating blog: " . $conn->error;
    }
}

// Fetch all blogs for listing
$blogs_query = "SELECT * FROM posts ORDER BY created_at DESC";
$blogs = $conn->query($blogs_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title>Update Blog</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="blogs-table">
        <h2>Select a Blog to Update</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($blogs->num_rows > 0): ?>
                    <?php while ($row = $blogs->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['author']; ?></td>
                            <td><?= $row['category']; ?></td>
                            <td>
                                <a href="update.php?edit_id=<?= $row['id']; ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No blogs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($blog)): ?>
    <div class="update-form">
        <h2>Update Blog</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?= $blog['id']; ?>">
            
            <label for="author">Author:</label>
            <input type="text" name="author" id="author" value="<?= $blog['author']; ?>" required><br>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= $blog['title']; ?>" required><br>

            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="<?= $blog['category']; ?>" required><br>

            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="5" required><?= $blog['content']; ?></textarea><br>

            <button type="submit" name="update">Update Blog</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>
