<?php include('traitement.php') ?>
<?php
// requête affichage
$sql = "SELECT `title`, `description`, `price`, `category` FROM `dish`";
$request = $conn->prepare($sql);
$request->execute();
$datas = $request->FetchAll();//Mode(PDO::FETCH_ASSOC);
//$data = contient les données
//var_dump($datas); //=tableau des données
$request->closeCursor();
?>

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
          <h3>Titles</h3>
            <ul>
            <?php foreach ($datas as $data): ?>
              <li>
                <?= $data['title'] ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <img>
          <p>Descriptions :</p>
          <?php foreach ($datas as $data): ?>
            <li>
              <?= $data['description'] ?>
            </li>
          <?php endforeach; ?>
          <p>Price</p>
          <p>Category</p>
        </div>
        <div>
    </div>
    </div>
    <form method="POST" action="add.php">
<button type="submit" name="add">Add section</button>
</form>

<?php
// requête affichage
$sql = "SELECT * FROM `dish` WHERE `id`";
$request = $conn->prepare($sql);
$request->execute();
$ids = $request->FetchAll();//Mode(PDO::FETCH_ASSOC);
//$data = contient les données
//var_dump($datas); //=tableau des données
$request->closeCursor();
?>

<div>
  <h2>TEST AFFICHAGE</h2>
  <?php foreach ($ids as $id): ?>
    <li>
      <?= $id['title'] ?>
      <?= $id['description'] ?>
      <?= $id['price'] ?>
      <?= $id['category'] ?>
    </li>
  <?php endforeach; ?>
</div>


  </body>
</html>
