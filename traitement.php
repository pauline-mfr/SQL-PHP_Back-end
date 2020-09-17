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
   -- `image` VARCHAR(255) /*NOT NULL*/NULL DEFAULT NULL ,
   `category` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;
)";
$request = $conn->prepare($sql);
$request->execute();
$request->closeCursor();

//INSERT INTO
if (isset($_POST['save'])) {
  // collect value of input field
  $title = $_POST['title'];
  if (empty($title)) {echo "Title is empty";}
  $description = $_POST['desc'];
  if (empty($description)) {echo "Description is empty";}
  $price = $_POST['price'];
  if (empty($price)) {echo "Price is empty";}
  $category = $_POST['cat'];
  if (empty($category)) {echo "Category is missing";}

$sql = "INSERT INTO `dish` (`title`,`description`,`price`,`category`)
	 VALUES ('$title','$description','$price','$category')";
  // $query = "INSERT INTO `user` (`mail`, `password`) VALUES (:mail, :password)";
   // $values = [
   //   ':mail'=>$mail,
   //   ':password'=>$password
   // ];
   $request = $conn->prepare($sql);
   if($request->execute()) {
     echo "insert ok";
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
    header("Refresh:0"); // reload la page
    echo "delete complete";
  }else{
    echo "delete failed";
  }
  $request->closeCursor();
}

// UPDATE


//UPLOAD
 // if (isset($_POST['img'])) {
 //   move_uploaded_file($_FILES['img']['tmp_name'], $cwd.DIRECTORY_SEPARATOR.$_FILES['img']['name']);
 // }
