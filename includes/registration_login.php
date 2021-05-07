<?php

require_once(ROOT_PATH  . "/PHPMailer/class.smtp.php");
require_once(ROOT_PATH  . "/PHPMailer/class.phpmailer.php");

  $username = "";
  $email    = "";
  $errors = array();
  $succes = array();

	// REGISTER USER
	if (isset($_POST['reg_user'])) {






		$username = $_POST['username'];
		$email = $_POST['email'];
		$password_1 = $_POST['password_1'];
		$password_2 = $_POST['password_2'];
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$adresa = $_POST['adresa'];
		$grad = $_POST['grad'];
		$br1 = $_POST['br1'];
		$br2 = $_POST['br2'];
		$confirm_code=md5(uniqid(rand()));
		$code_id = md5(uniqid(rand()));

		if (empty($username)) {  array_push($errors, "Polje Username je obavezno"); }
		if (empty($ime)) {  array_push($errors, "Polje Ime je obavezno"); }
		if (empty($prezime)) {  array_push($errors, "Polje Prezime je obavezno"); }
		if (empty($grad)) {  array_push($errors, "Polje Grad je obavezno"); }
		if (empty($adresa)) {  array_push($errors, "Polje Adresa je obavezno"); }
		if (empty($br1)) {  array_push($errors, "Polje Broj telefona je obavezno"); }

		if (empty($email)) { array_push($errors, "Polje Email je obavezno"); }
		if (empty($password_1)) { array_push($errors, "Polje Sifra je obavezno"); }
		if ($password_1 != $password_2) { array_push($errors, "Sifre se ne poklapaju, probajte ponovo");}



$stm = $conns->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
$stm->execute([$username,$email]);
$user = $stm->fetch(PDO::FETCH_ASSOC);


		if ($user) {
			if ($user['username'] === $username) {
			  array_push($errors, "Korisnicko ime vec postoji");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email vec postoji");
			}
		}
		$image = "defaultuser.jpg";

		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

		if (count($errors) == 0) {
			$password = md5($password_1);
$stm = $conns->prepare("INSERT INTO users (username,telefon,telefon2,ime,prezime,grad,adresa, ip_addres, confirmation_code, email, image, password, code_id, created_at, updated_at)  VALUES(?,?,?,?,?,?,?,?,?,?,?, ?,?, now(), now())");
$stm->execute([$username,$br1,$br2,$ime,$prezime,$grad,$adresa,$ip, $confirm_code, $email, $image, $password,$code_id]);

$stm = $conns->prepare("INSERT INTO backusers (username,telefon,telefon2,ime,prezime,grad,adresa, ip_addres, confirmation_code, email, image, password, code_id, created_at, updated_at)  VALUES(?,?,?,?,?,?,?,?,?,?,?, ?,?, now(), now())");
$stm->execute([$username,$br1,$br2,$ime,$prezime,$grad,$adresa,$ip, $confirm_code, $email, $image, $password,$code_id]);


$stm = $conns->prepare("SELECT id FROM users WHERE username=? OR email=? LIMIT 1");
$stm->execute([$username,$email]);
$reg_user_id = $stm->fetch();


			$_SESSION['user'] = getUserById($reg_user_id);
$conf_code = 'https://www.polovnitelefoni.net/user/confirmation?user_id='.$username.'&conf='.$confirm_code;
$subject = 'PolovniTelefoni.net';

$tekst = '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f5f8fa; min-width: 350px; font-size: 1px; line-height: normal;">
  <tr>
    <td align="center" valign="top">
      <!--[if (gte mso 9)|(IE)]>
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top" width="750">
            <![endif]-->
            <table cellpadding="0" cellspacing="0" border="0" width="750" class="table750"
            style="width: 100%; max-width: 750px; min-width: 350px; background: #f5f8fa;">
              <tr>
                <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
                <td align="center" valign="top" style="background: #ffffff;">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f5f8fa;">
                    <tr>
                      <td align="right" valign="top">
                        <div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                    <tr>
                      <td align="center" valign="top">
                        <div style="height: 40px; line-height: 40px; font-size: 38px;">&nbsp;</div>
                        <a href="https://www.polovnitelefoni.net"
                        style="
    display: block;
  ">
                          <img src="https://www.polovnitelefoni.net/static/images/email_logo.png" alt="PolovniTelefoni.net" width="345px" border="0" style="display: block;
    width: 345px;
    border-radius: 5px;">
                        </a>
                        <div class="top_pad2" style="height: 48px; line-height: 48px; font-size: 46px;">&nbsp;</div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                    <tr>
                      <td align="left" valign="top"> <font face="Source Sans Pro, sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 54px; font-weight: 300; letter-spacing: -1.5px;">
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 52px; line-height: 54px; font-weight: 300; letter-spacing: -1.5px;">Verifikujte Vaš Email</span>
                           </font>

                        <div style="height: 21px; line-height: 21px; font-size: 19px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                              Pozdrav  '.$ime.' '.$prezime.',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Dobili smo zahtev za kreiranje nalogu na sajtu PolovniTelefoni.net.
                                Ako želite da sa vašom email adresom '.$email.' bude kreiran nalog, kliknite na polje ispod.
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                        <table class="mob_btn" cellpadding="0" cellspacing="0" border="0"
                        style="background: #14264e; border-radius: 4px;">
                          <tr>
                            <td align="center" valign="top">
                              <a href="'.$conf_code.'"
                              target="_blank" style="display: block; border: 1px solid #14264e; border-radius: 4px; padding: 19px 27px; font-family: Source Sans Pro, Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 26px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;"> <font face="Source Sans Pro, sans-serif" color="#ffffff" style="font-size: 26px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
               <span style="font-family: Source Sans Pro, Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 26px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Verifikuj Email</span>
            </font>

                              </a>
                            </td>
                          </tr>
                        </table>
                        <div style="height: 90px; line-height: 90px; font-size: 88px;">&nbsp;</div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="90%" style="width: 90% !important; min-width: 90%; max-width: 90%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-bottom: none; border-left: none; border-right: none;">
                    <tr>
                      <td align="left" valign="top">
                        <div style="height: 28px; line-height: 28px; font-size: 26px;">&nbsp;</div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                    <tr>
                      <td align="left" valign="top"> <font face="Source Sans Pro, sans-serif" color="#7f7f7f" style="font-size: 17px; line-height: 23px;">
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, sve vaše poruke sa PolovniTelefoni.net će stizati na '.$email.'</span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                      </td>
                    </tr>
                  </table>
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f5f8fa;">
                    <tbody>
                      <tr>
                        <td align="center" valign="top">
                          <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
                          <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                            <tbody>
                              <tr>
                                <td align="center" valign="top">

                                  <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#868686" style="font-size: 15px; line-height: 20px;">
                        <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 15px; line-height: 20px;">
                           PolovniTelefoni.net
                           <br>
                           Copyright 2018 by PolovniTelefoni.net. Sva prava su zadrzana</span>
                     </font>

                                  <div style="height: 4px; line-height: 4px; font-size: 2px;">&nbsp;</div>
                                  <div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
                                  <!-- <font face="Source Sans Pro, sans-serif" color="#1a1a1a" style="font-size:
                                  17px; line-height: 20px;">
                        <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="mailto:help@hireclub.com" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">help@hireclub.com</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">1(800)232-90-26</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Unsubscribe</a></span>
                     </font>

                     <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>

                     <table cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr>
                           <td align="center" valign="top">
                              <a href="#" target="_blank" style="display: block; max-width: 19px;">
                                 <img src="images/soc_1.png" alt="img" width="19" border="0" style="display: block; width: 19px;">
                              </a>
                           </td>
                           <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                           <td align="center" valign="top">
                              <a href="#" target="_blank" style="display: block; max-width: 18px;">
                                 <img src="images/soc_2.png" alt="img" width="18" border="0" style="display: block; width: 18px;">
                              </a>
                           </td>
                           <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                           <td align="center" valign="top">
                              <a href="#" target="_blank" style="display: block; max-width: 21px;">
                                 <img src="images/soc_3.png" alt="img" width="21" border="0" style="display: block; width: 21px;">
                              </a>
                           </td>
                           <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                           <td align="center" valign="top">
                              <a href="#" target="_blank" style="display: block; max-width: 25px;">
                                 <img src="images/soc_4.png" alt="img" width="25" border="0" style="display: block; width: 25px;">
                              </a>
                           </td>
                        </tr>
                     </tbody></table>
                     -->
                                  <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
              </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
          </tr>
        </table>
      <![endif]-->
    </td>
  </tr>
</table>';

$kome = $ime.' '.$prezime;
smtpmailere($email,  $kome, $subject, $tekst);

			if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
				$_SESSION['message'] = "You are now logged in";

				header('location: ' . BASE_URL . 'admin/dashboard.php');
				exit(0);
			} else {
				$_SESSION['message'] = "You are now logged in";

				header('location: /user/user');
				exit(0);
			}
		}
	}

	// LOG USER IN

if (isset($_POST['login_btn'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];



$key = "6LdLUI4UAAAAAHI9EGn4tAwge_5HEG6Ci6JKzUQK";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'secret' => $key,
    'response' => $_POST['g-recaptcha-response'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
]);

$resp = json_decode(curl_exec($ch));
curl_close($ch);

if ($resp->success) {
	$s=1;
} else {
    array_push($errors, "Ako niste robot obratite se administratoru ");
}


		if (empty($username)) { array_push($errors, "Unesite Username"); }
		if (empty($password)) { array_push($errors, "Unesite Password"); }
		if (empty($errors)) {
			$password = md5($password);

$stm = $conns->prepare("SELECT * FROM users WHERE username=? and password=? LIMIT 1");
$stm->execute([$username, $password]);


  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}




			if ($stm->rowCount() > 0) {




				$reg_user_id = $stm->fetch(PDO::FETCH_ASSOC)['id'];





				$_SESSION['user'] = getUserById($reg_user_id);

             $stm = $conns->prepare("INSERT INTO login (user_id,created_at,ip) VALUES (?,NOW(),?) ");
$stm->execute([$reg_user_id, $ip]);

if(isset($_POST["remember"]))
                    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $username, $hour);
                         setcookie('password', $password, $hour);
                    }else {

					setcookie ("username");
					setcookie ("password");

			}


				if ( in_array($_SESSION['user']['role'], ["Admin", "Author"])) {
					$_SESSION['message'] = "You are now logged in";

					header('location: ' . BASE_URL . '/admin/dashboard.php');
					exit(0);
				} else {
					$_SESSION['message'] = "You are now logged in";

					header("Refresh:0");

					exit(0);
				}
			} else {
				array_push($errors, 'Uneli ste pogresao korisnicko ime ili sifru');
			}
		}
	}



	function getUserById($id)
	{
		global $conns;

$stm = $conns->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
$stm->execute([$id]);
$user = $stm->fetch(PDO::FETCH_ASSOC);


		return $user;
	}


function smtpmailere($to,  $from_name, $subject, $body)
    {


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.polovnitelefoni.net';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'confirmation@polovnitelefoni.net';                     // SMTP username
    $mail->Password   = '-O)06L(JXHTt';                               // SMTP password
    $mail->SMTPSecure = 'tls';        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('confirmation@polovnitelefoni.net', 'PolovniTelefoni.net');
    $mail->addAddress($to, $from_name);     // Add a recipient
    $mail->addReplyTo('confirmation@polovnitelefoni.net', 'Information');


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
} catch (Exception $e) {
}
    }










?>
