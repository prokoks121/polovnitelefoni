<?php 
// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

// general variables
$errors = [];
if (!isset($_SESSION['user']['role'])) {
	header('Location: /index');
}else{
if ($_SESSION['user']['role'] != "Admin") {
	header('Location: /index');
}
$user_id = $_SESSION['user']['id'];
  $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='Admin' AND id=$user_id LIMIT 1"));
 if ($result == 0) {
 header('Location: /index');
 }
}

if (isset($_POST['changePhone'])) {
	changePhone($_POST);
}
function getAllCompanyRequest(){
	global $conn;
	$result = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM zahtev ORDER BY created_at DESC"),MYSQLI_ASSOC);
return $result;
}
 function getAllReports(){
 	global $conn;
	$result = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM report ORDER BY created_at DESC"),MYSQLI_ASSOC);
return $result;
 }
function getAllMessages(){
	global $conn;
	$result = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM kontakt ORDER BY created_at DESC"),MYSQLI_ASSOC);
return $result;
}
if (isset($_GET['create-company'])) {
$id = $_GET['create-company'];
createCompany($id);
}
if (isset($_GET['delete-company'])) {
$id = $_GET['delete-company'];
DeleteCompany($id);
}
if (isset($_GET['delete-phone-request'])) {
$id = $_GET['delete-phone-request'];
DeletePhoneRequest($id);
}
function DeletePhoneRequest($id){
		global $conn;
	mysqli_query($conn,"DELETE FROM request WHERE id=$id");
				header('location: request_phone');


}
function getAllCompanys(){
	global $conn;
	$result = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM company ORDER BY create_at DESC"),MYSQLI_ASSOC);
	return $result;
}
function DeleteCompany($id){
	global $conn;
	$user_id = mysqli_fetch_assoc(mysqli_query($conn,"SELECT user_id FROM company WHERE id=$id"));
	mysqli_query($conn,"DELETE FROM company WHERE id=$id");
	mysqli_query($conn,"DELETE FROM company_phone WHERE company_id=$id");
	mysqli_query($conn,"DELETE FROM lokacije WHERE company_id=$id");
	mysqli_query($conn,"DELETE FROM posts WHERE user_id=$user_id AND reg_check='2'");

					header('location: company');



}
function getAllPhoneRequest(){
	global $conn;
	$result = mysqli_fetch_all(mysqli_query($conn,"SELECT * FROM request ORDER BY created_at DESC"),MYSQLI_ASSOC);
	return $result;
}
function createCompany($id){
	global $conn,$errors;
	$company = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM zahtev WHERE id=$id"));

	if (empty($company)) { array_push($errors,"Ne postoji");}

		$user_id = $company['user_id'];
			if ($user_id == '') { array_push($errors,"Ne postoji user_id");}
			if ($company['mbr'] == '' || $company['pib'] == '') { array_push($errors,"Ne postoji mbr ili pib");}
			if ($company['ime'] == '') { array_push($errors,"Ne postoji ime");}

		$reg = $company['mbr']."/%/".$company['pib'];
		$zahtev_id = $company['id'];
		$ime = $company['ime'];
$email = $company['email'];
		$adresa = explode('/%/', $company['adresa']);
		$adr = $adresa['1'] ."%". $adresa['2'] ."%". $adresa['0'] ."%". $adresa['3'];
					if (!isset($adresa['3'])) { array_push($errors,"Ne postoji adresa");}

		$adr1 = $adresa['1'] .", ".$adresa['2'];
		$vr = explode('&&', $company['vreme']);
		$vr1 = explode('/%/', $vr['0']);
		$vr2 = explode('/%/', $vr['1']);
		$vr3 = explode('/%/', $vr['2']);
if (!isset($vr['2'])) { array_push($errors,"Ne postoji vreme");}
if (!isset($vr1['1'])) { array_push($errors,"Ne postoji vreme");}

		$rad = $vr1['0']." do ". $vr1['1'];
		if (isset($vr2['1'])) {
		$rad1 = $vr2['0']." do ". $vr2['1'];
		}else{
			$rad1 = 'Neradno';
		}
			if (isset($vr3['1'])) {
		$rad2 = $vr3['0']." do ". $vr3['1'];
		}else{
			$rad2 = 'Neradno';
		}
$dani = $rad . "%". $rad1 . "%".$rad2;
		$telefon = $company['telefon'];


 if (count($errors)==1) {

$addressLine = str_ireplace(" ","%20",$adresa['1']);  
$adminDistrict = str_ireplace(" ","%20",$adresa['2']);  
$locality = str_ireplace(" ","%20",$adresa['0']);  
$postalCode = str_ireplace(" ","%20",$adresa['3']);  


$url = "street=".$addressLine."&city=".$locality."&postalcode=".$postalCode."&county=".$adminDistrict;
$url = "https://us1.locationiq.com/v1/search.php?key=51b19888a471c1&limit=1&countrycodes=RS&".$url."&format=json";
$curl = curl_init($url);

curl_setopt_array($curl, array(
  CURLOPT_RETURNTRANSFER    =>  true,
  CURLOPT_FOLLOWLOCATION    =>  true,
  CURLOPT_MAXREDIRS         =>  10,
  CURLOPT_TIMEOUT           =>  30,
  CURLOPT_CUSTOMREQUEST     =>  'GET',
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$obj= json_decode($response);
 $loca = $obj[0]->lat . ', ' . $obj[0]->lon;

   


// create an XML element based on the XML string    


$sql = "INSERT INTO `company`(`user_id`, `regist`, `ime`, `adresa`, `lokacija`, `adrese`, `r_dani`, `e_cont`, `create_at`, `telefon`) VALUES ('$user_id','$reg','$ime','$adr','$loca','$adr1','$dani','$email',NOW(),'$telefon')";
$sql1 = "INSERT INTO `backcompany`(`user_id`, `regist`, `ime`, `adresa`, `lokacija`, `adrese`, `r_dani`, `e_cont`, `create_at`, `telefon`) VALUES ('$user_id','$reg','$ime','$adr','$loca','$adr1','$dani','$email',NOW(),'$telefon')";
if (mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)) {
	mysqli_query($conn,"DELETE FROM zahtev WHERE id=$zahtev_id");

}
}
				header('location: company_request');
	
}
function changePhone(){
	global $conn;
	$id = $_GET['id'];

	$a0 = $_POST['a0'];
	$a1 = $_POST['a1'];
	$a2 = $_POST['a2'];
	$a3 = $_POST['a3'];
	$a4 = $_POST['a4'];


	$b1 = $_POST['b1'];
	$b2 = $_POST['b2'];
	$b3 = $_POST['b3'];
	$b4 = $_POST['b4'];
	$b5 = $_POST['b5'];
	$b6 = $_POST['b6'];

	$c1 = $_POST['c1'];
	$c2 = $_POST['c2'];
	$c3 = $_POST['c3'];

	$d1 = $_POST['d1'];
	$d2 = $_POST['d2'];

	$e1 = $_POST['e1'];
	$e2 = $_POST['e2'];
	$e3 = $_POST['e3'];
	$e4 = $_POST['e4'];

	$q1 = $_POST['q1'];
	$q2 = $_POST['q2'];
	$q3 = $_POST['q3'];

	$w1 = $_POST['w1'];
	$w2 = $_POST['w2'];
	$w3 = $_POST['w3'];
	$w4 = $_POST['w4'];

	$r1 = $_POST['r1'];
	$r2 = $_POST['r2'];
	$r3 = $_POST['r3'];

	$y1 = $_POST['y1'];

	$u1 = $_POST['u1'];
	$u2 = $_POST['u2'];
	$u3 = $_POST['u3'];
	$u4 = $_POST['u4'];
$cost = "/%/";
$b = $b1 . $cost . $b2 . $cost . $b3 . $cost .  $b4 . $cost . $b5 . $cost . $b6;
$c = $c1 . $cost . $c2 . $cost . $c3 . $cost . $r1 . $cost . $r2 . $cost . $r3;
$d = $d1 . $cost . $d2 . $cost . $y1;
$e = $e1 . $cost . $e2 . $cost . $e3 . $cost .  $e4;
$q = $q1 . $cost . $q2 . $cost . $q3 . $cost . $w1 . $cost . $w2 . $cost . $w3 . $cost .  $w4;
$u = $u1 . $cost . $u2 . $cost . $u3 . $cost .  $u4;


if (isset($_POST['id'])) {

	$sql = "UPDATE `phones` SET `id_telefona`='$a0',`marka`='$a1',`datum`='$a4',`model`='$a2',`photo`='$a3',`kuciste`='$b',`ekran`='$e',`kamera`='$q',`cipovi`='$c',`moduli`='$d',`mreze`='$u' WHERE id=$id";
	
}else{
	$sql = "INSERT INTO `phones`(`id_telefona`, `marka`, `model`, `photo`, `datum`, `kuciste`, `ekran`, `kamera`, `cipovi`, `moduli`, `mreze`) VALUES ('$a0','$a1','$a2','$a3','$a4','$b','$e','$q','$c','$d','$u')";
	
}
mysqli_query($conn,$sql);
	header("Refresh:0");
}






















/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}


if (isset($_GET['edit-role']) && isset($_GET['role'])) {
	$role = $_GET['role'];
	$admin_id = $_GET['edit-role'];
	editRole($admin_id,$role);
}

// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){
	global $conn, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for admin users");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
	if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
	// Ensure that no user is registered twice. 
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: users.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
	global $conn, $username, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	// set form values ($username and $email) on the form to be updated
	$username = $admin['username'];
	$email = $admin['email'];
	$role = $admin['role'];

}
function editRole($admin_id,$role)
{
	global $conn, $username, $isEditingUser, $admin_id, $email;
if ($role == 'none') {
	$roles = 'role=NULL';
}else{
$roles = "role='".$role."'";
}
	$sql = "UPDATE users SET $roles WHERE id=$admin_id";
	 mysqli_query($conn, $sql);




}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	// get id of the admin to be updated
	$admin_id = $request_values['admin_id'];
	// set edit state to false
	$isEditingUser = false;


	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password (security purposes)
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
// delete admin user 
function deleteAdmin($admin_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}





/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
function getAllUsers(){
	global $conn;
	$sql = "SELECT * FROM users ";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

	
$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);


if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "Wellcome admin";
				
			} else {
				
				header('location: ' . BASE_URL . '/index.php');
							
				exit(0);} 
				?>
