<?php 
	
	@ob_start();
	session_start();
	header('Content-Type: application/json');


	$conn = new PDO('mysql:host=localhost;dbname=polovnit_DeIzaci;charset=utf8','polovnit','4X]BO9j#N0n7ol');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$username = $_GET['usr'];
	$password = $_GET['pass'];

    $stm = $conn->prepare("SELECT * FROM `korisnici` WHERE `userName` = ? AND `password`= ? LIMIT 1");
    $stm->execute([$username,$password]);
     $result = $stm->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode(['korisnik' => $result]);
echo $json;

?>