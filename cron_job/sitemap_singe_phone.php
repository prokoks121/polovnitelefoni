<?php 
include('../config.php');
global $conn;
$query = "SELECT id,marka,model FROM phones";

$result = mysqli_query($conn, $query);

$base_url = "https://www.polovnitelefoni.net/single-phone/";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url. $row["marka"].'/'. str_replace(' ','-',str_replace('&', '&amp;', $row["model"])) . '?phone_id=' . $row["id"] .'/</loc>' . PHP_EOL;
 echo '<changefreq>monthly</changefreq>' . PHP_EOL;
 echo "<priority>0.6</priority>". PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;
?>