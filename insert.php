<?php
//INSERT INTO
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
