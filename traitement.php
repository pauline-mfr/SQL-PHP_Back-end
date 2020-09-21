<?php
$servername = "localhost";
$dbname = "food"; //nom de la database
$username = "root";
$password = "";

// DATABASE CONNEXION
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e) { // si connexion échoue
  die("Connection failed" . $e->getMessage());   //message d'erreur
}

// CREATE TABLE
$sql= "CREATE TABLE IF NOT EXISTS `dish` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
   `title` VARCHAR(50) NOT NULL ,
   `description` VARCHAR(255) NOT NULL ,
   `price` DECIMAL NOT NULL ,
   `image` VARCHAR(255) NULL DEFAULT NULL ,
   `category` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
)";
$request = $conn->prepare($sql);
$request->execute();
$request->closeCursor();


// AFFICHAGE
$sql = "SELECT * FROM `dish`";
$request = $conn->prepare($sql);
$request->execute();
$ids = $request->FetchAll();
//$ids = contient les données
$request->closeCursor();

//INSERT INTO
if (isset($_POST['save'])) {
  $title = $_POST['title'];
  if (empty($title)) {echo "Title is empty";}
  $description = $_POST['desc'];
  if (empty($description)) {echo "Description is empty";}
  $price = $_POST['price'];
  if (empty($price)) {echo "Price is empty";}

  //IMG UPLOAD
  if(isset($_FILES['img'])){
  $img_name = $_FILES['img']['name'];
  $dir ='img/'.$img_name;
  move_uploaded_file($_FILES['img']['tmp_name'], $dir);
  }

  $category = $_POST['cat'];
  if (empty($category)) {echo "Category is missing";}

$sql = "INSERT INTO `dish` (`title`,`description`,`price`, `image`, `category`)
	 VALUES ('$title','$description','$price', '$img_name', '$category')";
  // $query = "INSERT INTO `user` (`mail`, `password`) VALUES (:mail, :password)";
   // $values = [
   //   ':mail'=>$mail,
   //   ':password'=>$password
   // ];
   $request = $conn->prepare($sql);
   if($request->execute()) {
     echo "insert ok"."<br>";
     echo "<a href='index.php'>Back to main menu</a>";
   }else{
     echo "insert fail";
   }
   $request->closeCursor();
} // END INSERT CONDITION

// DELETE ENTRY
if(isset($_POST['delete'])) {
  echo '<script> alert ("You\'re about to delete this entry !")</script>';
  $sql = "DELETE FROM `dish` WHERE `id` = :id";
  $request = $conn->prepare($sql);
  $array = [
    ":id" => $_POST['delete']
  ];
  if($request->execute($array)) {
    echo "delete complete"."<br>";
    echo "<a href='index.php'>Back to main menu</a>";
    //header("Refresh:0"); // reload la page
  }else{
    echo "delete failed";
  }
  $request->closeCursor();
}

// UPDATE FORM
if(isset($_POST['edit'])) {
  $id = $_POST['edit'];
  $sql = "SELECT * FROM `dish` WHERE `id` = $id ";
  $request = $conn->prepare($sql);
  $request->execute();
  $toUpdate = $request->FetchAll();
  //$toUpdate = contient les données
  $request->closeCursor();

  echo '<h1>Edit</h1>
  <form action="traitement.php" method="POST" enctype="multipart/form-data" name="edit-form">
    <input name="new_title" value="' .$toUpdate[0]['title']. '"></input><br><br>
    <input name="new_desc" value="' .$toUpdate[0]['description']. '"></input><br><br>
    <input name="new_price" value="' .$toUpdate[0]['price']. '"></input><br><br>
    <label for="new_img">Pick an image</label>
    <input type="file" name="new_img" value="' .$toUpdate[0]['image']. '"></input>
    <label for="cat">Categorie</label>
    <select name="new_cat">
      <option value="'.$toUpdate[0]['category'].'">'.$toUpdate[0]['category'].'</option>
      <option value="starter">Starter</option>
      <option value="main-course">Main Course</option>
      <option value="dessert">Dessert</option>
    </select><br><br>
    <button type="submit" name="update" value=' .$id. '>Update</button>
  </form>';
}
 // UPDATE QUERY
 if(isset($_POST['update'])) {
   $new_title = $_POST['new_title'];
   $new_desc = $_POST['new_desc'];
   $new_price = $_POST['new_price'];
   //IMG UPLOAD
   if(isset($_FILES['new_img'])){
   $new_img_name = $_FILES['new_img']['name'];
   $dir ='img/'.$new_img_name;
   move_uploaded_file($_FILES['new_img']['tmp_name'], $dir);
   }
   $new_cat = $_POST['new_cat'];
   $sql = "UPDATE `dish` SET `title` = '$new_title', `description` = '$new_desc', `price` = '$new_price', `image` = '$new_img_name', `category` = '$new_cat' WHERE `id` = :id";
   $request = $conn->prepare($sql);
   $array = [
     ":id" => $_POST['update']
   ];
   if($request->execute($array)) {
     echo "update complete"."<br><br>";
     echo "<a href='index.php'>Back to main menu</a>";
   }else{
     echo "update failed";
   }
   $request->closeCursor();
 }
