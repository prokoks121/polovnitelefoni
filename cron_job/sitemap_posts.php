<?php 
include('../config.php');
global $conn;
$query = "SELECT id,id_telefona FROM posts WHERE delete_check='false'";
function SplitWrods($words){
  global $conn;
  $return = str_replace(' ', '-', $words);
  return $return;

}
$result = mysqli_query($conn, $query);

$base_url = "https://www.polovnitelefoni.net";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	try {

$id_telefona = $row['id_telefona'];
$sqls = "SELECT marka,model FROM phones WHERE id=$id_telefona";
$results = mysqli_query($conn, $sqls);
$models = mysqli_fetch_assoc($results);
	$link = $models['marka'] . "-" . $models['model'];
$link = SplitWrods($link);
$link = $base_url.'/single_post/'. $link.'/'. $row['id'];

 echo '<url>' . PHP_EOL;
 echo '<loc>'. $link .'</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo "<priority>0.7</priority>". PHP_EOL;
 echo '</url>' . PHP_EOL;
		
	} catch (Exception $e) {
		
	}
}

echo '</urlset>' . PHP_EOL;

?>