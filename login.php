<?php
if(count($_POST)>0){
//1 get values of form
$email = $_POST["email"];
$password = $_POST["password"];

//2 connect with db
$servername = "localhost";
$username = "root";
$Password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=Restaurante_db", $username, $Password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
  $stmt = $conn->prepare("SELECT code FROM tb_user WHERE
   email=:email AND password=md5(:password)");
   $stmt->bindParam(':email',$email, PDO::PARAM_STR); 
   $stmt->bindParam(':password',$password, PDO::PARAM_STR); 
    $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
  $qtd_users = (count($result));

if($qtd_users == 1){
  //change for "redirecionamento..."
    $resultado["msg"] = "User found";
    $resultado["cod"] = 1;
}else if($qtd_users==0){
    $resultado["msg"] = "User NOT found";
    $resultado["cod"] = 0;
}
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  $conn = NULL;
}
//3 verify email and password 
}
    include("index.php");
?>