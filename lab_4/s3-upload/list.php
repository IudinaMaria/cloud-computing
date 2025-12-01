<?php
$db = new PDO('sqlite:database.sqlite');
$rows = $db->query("SELECT * FROM uploads ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<body>
<h2>Uploaded files</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Original Name</th>
        <th>New Name</th>
        <th>URL</th>
        <th>Date</th>
    </tr>

    <?php foreach ($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['original_name']) ?></td>
            <td><?= htmlspecialchars($row['new_name']) ?></td>
            <td><a href="<?= $row['url'] ?>" target="_blank">Open</a></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="index.php">Upload another file</a>

</body>
</html>
