<!DOCTYPE html>
<html>
<body>
<h2>Upload avatar to S3</h2>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Select file:</label>
    <input type="file" name="fileToUpload" required />
    <button type="submit">Upload</button>
</form>

<br>
<a href="list.php">View uploaded files</a>

</body>
</html>
