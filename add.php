<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Back end</title>
  <link href="main.css" type="text/css" rel="stylesheet">
</head>

<body>
  <h1>Add</h1>

  <form action="traitement.php" method="POST" enctype='multipart/form-data' name="add-form">
    <input name="title" placeholder="Title"></input><br><br>
    <input name="desc" placeholder="Description"></input><br><br>
    <input name="price" placeholder="Price"></input><br><br>
    <label for="img">Pick an image </label><input type='file' name='img'></input><br><br>
    <label for="cat">Categorie</label><br><br>
    <select name="cat">
      <option value="starter">Starter</option>
      <option value="main-course">Main Course</option>
      <option value="dessert">Dessert</option>
    </select>
    <button type="submit" name="save">OK</button>
  </form>

</body>
</html>
