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

// INSERT INTO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
  $title = $_REQUEST['title'];
  if (empty($title)) {echo "Title is empty";}
  $description = $_REQUEST['desc'];
  if (empty($description)) {echo "Description is empty";}
  $price = $_REQUEST['price'];
  if (empty($price)) {echo "Price is empty";}
  $category = $_REQUEST['cat'];
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

//UPLOAD
 // if (isset($_POST['img'])) {
 //   move_uploaded_file($_FILES['img']['tmp_name'], $cwd.DIRECTORY_SEPARATOR.$_FILES['img']['name']);
 // }
