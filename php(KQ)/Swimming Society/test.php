<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <form action="test2.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>
