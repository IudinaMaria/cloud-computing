<?php
require 'dynamodb.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ddb_update($id, $_POST['status']);
    header("Location: ddb_index.php");
    exit;
}
?>

<h2>Update status</h2>

<form method="POST">
    New status:
    <select name="status">
        <option value="pending">pending</option>
        <option value="done">done</option>
    </select>
    <button type="submit">Save</button>
</form>
