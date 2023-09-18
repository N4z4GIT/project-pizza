<?php
include_once("comfig-login.php");

try {
$pdo= new PDO ("mysql:host=".SERVER_NAME.";dbname=".DATABASE_NAME,USER_NAME,PASSWORD);
// set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "CONEXION EXITOSA";
}
catch(PDOException $e) {
   echo "CONEXION FALLIDA" . $e->getMessage();
}
$usr=$_POST['username'];
$pass=$_POST['password'];
$hashed_pass=hash('sha256',$pass);
$sql="select * from users where (username=:usr or email=:usr) and (password=:hashed_pass) and (active='si')";
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':usr',$usr);
$stmt->bindValue(':hashed_pass',$hashed_pass);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row == 0) {
    echo "Login invalido";
    
    } else {
      echo "Bienvenido";
    }
    
?>