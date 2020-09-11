<?php include('traitement.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Back end</title>
    <link href="main.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <h1>Back-office</h1>
    <div>
      <h2>My sections</h2>
        <div>
          <h3>Title</h3>
          <img>
          <p>Description</p>
          <p>Price</p>
          <p>Category</p>
        </div>
        <div>
          <?php
          // lancement de la requête
          $sql = "SELECT `title`, `description`, `price`, `category` FROM `dish`";
          // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
          $request = mysql_query($sql) or die('Erreur SQL');
          // on va scanner tous les tuples un par un
          while ($data = mysql_fetch_array($request)) {
          	// on affiche les résultats
          	echo 'Nom : '.$data['title'].'<br />';
          	echo 'Son tél : '.$data['description'].'<br /><br />';
          }
          mysql_free_result ($request);
          mysql_close ();
          ?>
    </div>
    </div>
    <form method="POST" action="add.php">
<button type="submit" name="add">Add section</button>
</form>
  </body>
</html>
