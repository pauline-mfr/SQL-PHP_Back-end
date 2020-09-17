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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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

<br><h2>TEST AFFICHAGE</h2>
<div class="card-group">
  <?php foreach ($ids as $id): ?>
    <div class="card" style="width: 10rem;">

    <div class="card-body">
      <h5 class="card-title"><?= $id['title'] ?></h5>
       <img src="..." class="card-img-top" alt="...">
      <p class="card-text"><?= $id['description'] ?></p>
      <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Price :</strong> <?= $id['price'] ?>€</li>
      <li class="list-group-item"><strong>Category : </strong><?= $id['category'] ?></li>
    </ul>

</div>
</div>
<?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>
