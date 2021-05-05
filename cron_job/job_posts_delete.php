<?php
$conn = mysqli_connect("localhost", "polovnit", "4X]BO9j#N0n7ol", "polovnit_kupo");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

	$conn->set_charset("utf8");

$num = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM posts WHERE delete_check='false'"));
if ($num > 100) {

 mysqli_query($conn,"UPDATE posts SET `delete_check`='true' WHERE delete_check='false' AND reg_check='1' AND created_at < NOW() - INTERVAL 30 DAY");
 
  mysqli_query($conn,"DELETE FROM follow WHERE id_post IN (SELECT id FROM posts WHERE delete_check='false' AND reg_check='1' AND created_at < NOW() - INTERVAL 30 DAY)");

}else{
	mysqli_query($conn, "UPDATE posts SET `created_at`=NOW() WHERE created_at < NOW() - INTERVAL 7 DAY");
}
mysqli_query($conn,"DELETE FROM recovery WHERE created_at < NOW() - INTERVAL 1 DAY");
 ?>
