<?php
require 'dynamodb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = uniqid();
    ddb_put($id, $_POST['title'], $_POST['status']);
    header("Location: ddb_index.php");
    exit;
}
?>

<h2>Create new item (DynamoDB)</h2>

<form method="POST">
    Title: <input name="title"><br><br>
    Status: 
    <select name="status">
        <option value="pending">pending</option>
        <option value="done">done</option>
    </select><br><br>

    <button type="submit">Create</button>
</form>
