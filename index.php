<?php include('traitement.php') ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Back end</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link href="main.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <h1>Back-office</h1>

      <h2>My sections</h2>

<div class="row row-cols-1 row-cols-md-3 g-4">
  <?php foreach ($ids as $id): ?>
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?= $id['title'] ?><img src="edit.png" style="width: 15px; height:15px;" id="edit-icon">
         <form method="POST" action="traitement.php" id="edit-options">
       <button class="btn btn-outline-primary btn-sm" type="submit" name="edit" value="<?= $id['id'] ?>">Edit</button>
       <button class="btn btn-outline-primary btn-sm ml-2" type="submit" name="delete" value="<?= $id['id'] ?>">Delete</button>
     </form></h5>
     <img src="img/<?= $id['image'] ?>" class="card-img-top" alt="<?= $id['image'] ?>">
        <p class="card-text"><?= $id['description'] ?></p>
        <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>Price :</strong> <?= $id['price'] ?>€</li>
        <li class="list-group-item"><strong>Category : </strong><?= $id['category'] ?></li>
      </ul>
      </div>
    </div>
  </div>

   <?php endforeach; ?>
</div>

<!-- ADDING FORM -->
<div>
<form method="POST" action="add.php">
<br><button type="submit" name="add">Add section</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>
