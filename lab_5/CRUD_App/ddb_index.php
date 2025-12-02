<?php
require 'dynamodb.php';

$items = ddb_get_all();
?>

<h2>Todo List (DynamoDB)</h2>
<a href="ddb_create.php">Create new</a>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php foreach ($items as $item): ?>
<tr>
    <td><?= $item['id']['S'] ?></td>
    <td><?= $item['title']['S'] ?></td>
    <td><?= $item['status']['S'] ?></td>
    <td>
        <a href="ddb_update.php?id=<?= $item['id']['S'] ?>">Edit</a>
        <a href="ddb_delete.php?id=<?= $item['id']['S'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
