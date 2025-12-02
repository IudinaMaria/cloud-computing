<?php
require 'config.php';

$stmt = $replica->query("SELECT * FROM todos");
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<body>
<h2>Todo List (READ via REPLICA)</h2>

<a href="create.php">Create new todo</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th><th>Title</th><th>Status</th><th>Actions</th>
</tr>

<?php foreach ($todos as $t): ?>
<tr>
    <td><?= $t['id'] ?></td>
    <td><?= htmlspecialchars($t['title']) ?></td>
    <td><?= $t['status'] ?></td>
    <td>
        <a href="update.php?id=<?= $t['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $t['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
