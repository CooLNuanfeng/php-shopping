<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="doAction.php" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile[]" multiple="multiple"/><br>
        <input type="file" name="myfile1"/><br>
        <input type="submit" value="upload"/>
    </form>
</body>
</html>
