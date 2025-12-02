<?php
require 'dynamodb.php';

$id = $_GET['id'];
ddb_delete($id);

header("Location: ddb_index.php");
exit;
