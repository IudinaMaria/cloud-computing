<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $master->prepare("DELETE FROM todos WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
