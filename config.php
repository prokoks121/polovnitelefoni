<?php
	@ob_start();
	session_start();

	$conn = mysqli_connect("localhost", "root", "", "polovnit_kupo");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
	$conns = new PDO('mysql:host=localhost;dbname=polovnit_kupo','root','');
	$conns->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn->set_charset("utf8");
if (!isset($_SESSION['user']['id'])) {
	if (isset($_COOKIE['username'])&& isset($_COOKIE['password'])) {
		$user= $_COOKIE['username'];
		$pass= $_COOKIE['password'];

		$stm = $conns->prepare("SELECT * FROM users WHERE username=? AND password=? LIMIT 1");
        $stm->execute([$user,$pass]);
	if ($stm->rowCount() > 0) {
			   $reg_user_id = $stm->fetch(PDO::FETCH_ASSOC)['id'];

				$stm = $conns->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
        $stm->execute([$reg_user_id]);
		$user = $stm->fetch(PDO::FETCH_ASSOC);

			$_SESSION['user'] = $user;

		}
	}
}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'https://localhost/');
	define('API_KEY', '14c42305f19d4defb0d20e6d0587e6da');
?>
