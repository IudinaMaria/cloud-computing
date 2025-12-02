<?php
require 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $status = $_POST['status'];

    $stmt = $master->prepare("UPDATE todos SET title=?, status=? WHERE id=?");
    $stmt->execute([$title, $status, $id]);

    header("Location: index.php");
    exit;
}

$stmt = $replica->prepare("SELECT * FROM todos WHERE id=?");
$stmt->execute([$id]);
$todo = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Edit Todo</h2>

<form method="post">
    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>">

    <label>Status:</label>
    <select name="status">
        <option value="pending" <?= $todo['status']=='pending'?'selected':'' ?>>Pending</option>
        <option value="done" <?= $todo['status']=='done'?'selected':'' ?>>Done</option>
    </select>

    <button type="submit">Save</button>
</form>

</body>
</html>
