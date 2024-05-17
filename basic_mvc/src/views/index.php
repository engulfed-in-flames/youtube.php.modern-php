<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt">
    <input type="submit" value="Upload">
  </form>

  <!-- 
You can also upload multiple files by using the following code.
<form action="/upload" method="post" enctype="multipart/form-data">
  <input type="file" name="receipt[]">
  <input type="file" name="receipt[]">
  <input type="submit" value="Upload">
</form> 
-->
</body>

</html>