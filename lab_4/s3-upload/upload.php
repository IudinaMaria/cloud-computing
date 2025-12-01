<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Ramsey\Uuid\Uuid;

// ---------- SETTINGS ----------
define('BUCKET_NAME', 'cc-lab4-pub-k02-maria');
$region = 'eu-central-1';

// ---------- AWS CLIENT ----------
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => $region,
]);

// ---------- FILE FROM FORM ----------
$originalName = $_FILES['fileToUpload']['name'];
$tmpFile = $_FILES['fileToUpload']['tmp_name'];

// ---------- GENERATE UNIQUE NAME ----------
$uuid = Uuid::uuid4()->toString();
$extension = pathinfo($originalName, PATHINFO_EXTENSION);
$newName = $uuid . "." . $extension;

// Папка avatars/
$key = "avatars/" . $newName;

try {
    // ---------- UPLOAD TO S3 ----------
    $result = $s3->putObject([
        'Bucket'     => BUCKET_NAME,
        'Key'        => $key,
        'SourceFile' => $tmpFile,
        'ACL'        => 'public-read'
    ]);

    $url = $result['ObjectURL'];

    echo "Uploaded successfully!<br>";
    echo "URL: <a href='$url'>$url</a><br>";

    // ---------- SAVE TO SQLITE ----------
    $db = new PDO('sqlite:database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $db->exec("
        CREATE TABLE IF NOT EXISTS uploads (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            original_name TEXT,
            new_name TEXT,
            url TEXT,
            created_at TEXT
        );
    ");

    $stmt = $db->prepare("
        INSERT INTO uploads (original_name, new_name, url, created_at)
        VALUES (:original_name, :new_name, :url, :created_at)
    ");

    $stmt->execute([
        ':original_name' => $originalName,
        ':new_name'      => $newName,
        ':url'           => $url,
        ':created_at'    => date('Y-m-d H:i:s')
    ]);

    echo "<br><a href='list.php'>See uploaded files</a>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
