<?php 
	
	@ob_start();
	session_start();
	header('Content-Type: application/json');


	$conn = new PDO('mysql:host=localhost;dbname=polovnit_DeIzaci;charset=utf8','polovnit','4X]BO9j#N0n7ol');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $stm = $conn->prepare("SELECT * FROM lokali");
    $stm->execute();
     $result = $stm->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode( $result, JSON_UNESCAPED_SLASHES);
$result = str_replace("\\\"","\"",$result);
$result = str_replace("\"[","[",$result);
$result = str_replace("]\"","]",$result);
echo $result;

?>