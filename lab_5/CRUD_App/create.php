<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];

    $stmt = $master->prepare("INSERT INTO todos (title, category_id, status) VALUES (?, 1, 'pending')");
    $stmt->execute([$title]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Create Todo (WRITE via MASTER)</h2>

<form method="post">
    <label>Title:</label>
    <input type="text" name="title" required>
    <button type="submit">Create</button>
</form>

</body>
</html>
