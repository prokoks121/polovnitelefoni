<?php

$errors = array();
$succes = [];
$time = strtotime("now");

if (isset($_POST['pass_sub']))
{
    changePassword($_POST);
}
if (isset($_POST['prati']))
{
    Prati($_POST);
}
if (isset($_POST['sub_report']))
{
    SendReport($_POST);
}
if (isset($_POST['zaprati']))
{
    followUser($_POST);
}
if (isset($_POST['sub_kont']))
{
    SendKontakt($_POST);
}
function getPostOldDays($old)
{
    global $time;
    $title = " Dana";
    $diff = $time - $old;
    $num = $diff / (60 * 60 * 24);
    if ($num >= 1)
    {
        if ($num == 1)
        {
            $title = " Dan";

        }
        else
        {
            $num = $num . $title;
        }

    }
    else
    {
        $num = $diff / (60 * 60);

        $title = " h";

        if ($num < 1)
        {
            $num = $diff / (60);

            $title = " min";

            if ($num < 1)
            {
                $num = $diff;
                $title = " sec";
            }
        }

    }
    return (floor($num) . $title);
}

function getAllCompany(){
  global $conns;

      $stm = $conns->prepare("SELECT * FROM company");
    $stm->execute();
     $result = $stm->fetchAll(PDO::FETCH_ASSOC);


  return $result;
}
function SendReport()
{
    global $conns, $errors;
    $ip = getIps();
    if (isset($_POST['mail']))
    {

        $email = strip_tags($_POST['mail']);
    }
    else
    {
        array_push($errors, "Unesite email.");
    }
    if (isset($_POST['ime']))
    {

        $ime = strip_tags($_POST['ime']);
    }
    else
    {
        array_push($errors, "Unesite ime.");
    }
    if (isset($_POST['txt']) && !empty($_POST['txt']))
    {
        $txt = strip_tags($_POST['txt']);
    }
    else
    {
        array_push($errors, "Unesite tekst.");
    }
    if (!isset($_GET['post_id']) && !isset($_GET['user_id']) && !isset($_GET['model_id']) && !isset($_GET['comm_id']))
    {
        array_push($errors, "Greska.");
    }
    else
    {
        if (isset($_GET['post_id']))
        {
            $vrsta = "1/%/" . $_GET['post_id'];
        }
        if (isset($_GET['user_id']))
        {
            $vrsta = "2/%/" . $_GET['user_id'];
        }
        if (isset($_GET['model_id']))
        {
            $vrsta = "3/%/" . $_GET['model_id'];
        }
        if (isset($_GET['comm_id']))
        {
            $vrsta = "4/%/" . $_GET['comm_id'];
        }
    }
    if (count($errors) == 0)
    {

        $stm = $conns->prepare("INSERT INTO report (`email`,`ime`,`vrsta`,`txt`,`ip`) VALUES (?,?,?,?,?)");
        $stm->execute([$email, $ime, $vrsta, $txt, $ip]);

        $subject = 'PolovniTelefoni.net';
        $message = '<html><body>';

        $message .= '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f5f8fa; min-width: 350px; font-size: 1px; line-height: normal;">
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
                              Poslao :  ' . $email . ' ' . $ime . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Poruka: ' . $txt . '
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                       
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
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, biće vam omogućena promena lozinke.</span>
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
        $message .= '</body></html>';
        $to = 'kupomobil@gmail.com';
        $headers = 'From: PolovniTelefoni.net <no-replay@polovnitelefoni.net>' . "\r\n";
        $headers .= 'Reply-To: no-replay@polovnitelefoni.net' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($to, $subject, $message, $headers);

    }
}

function SendKontakt()
{
    global $conns, $errors;
    if (isset($_POST['mail']))
    {

        $email = strip_tags($_POST['mail']);
    }
    else
    {
        array_push($errors, "Unesite email.");
    }
    if (isset($_POST['ime']))
    {

        $ime = strip_tags($_POST['ime']);
    }
    else
    {
        array_push($errors, "Unesite ime.");
    }
    if (isset($_POST['txt']) && !empty($_POST['txt']))
    {
        $text = $_POST['txt'];
        $txt = strip_tags($text);

    }
    else
    {
        array_push($errors, "Unesite tekst.");
    }

    if (count($errors) == 0)
    {


        $stm = $conns->prepare("INSERT INTO kontakt (`email`,`ime`,`txt`) VALUES (?,?,?)");
        $stm->execute([$email, $ime, $txt]);

        $subject = 'PolovniTelefoni.net';
        $message = '<html><body>';

        $message .= '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f5f8fa; min-width: 350px; font-size: 1px; line-height: normal;">
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
                              Poslao :  ' . $email . ' ' . $ime . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Poruka: ' . $txt . '
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                       
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
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, biće vam omogućena promena lozinke.</span>
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
        $message .= '</body></html>';
        $to = 'kupomobil@gmail.com';
        $headers = 'From: PolovniTelefoni.net <no-replay@polovnitelefoni.net>' . "\r\n";
        $headers .= 'Reply-To: no-replay@polovnitelefoni.net' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($to, $subject, $message, $headers);

    }
}

function getSingleUser()
{
    global $conns, $errors;
    if (!isset($_GET['user_id']) || !isset($_GET['code_id']))
    {
        array_push($errors, "Korisnik ne postoji ili je privremeno deaktiviran.");
    }else{
        $user_id = $_GET['user_id'];
        $code_id = $_GET['code_id'];
            $stm = $conns->prepare("SELECT * FROM users WHERE id=? AND code_id=? LIMIT 1");
            $stm->execute([$user_id, $code_id]);
            $users = $stm->fetch(PDO::FETCH_ASSOC);

            return $users;
        
    }

}
function Prati()
{
    global $conns;
    if (isset($_POST['follow']))
    {
        $mail = $_POST['follow'];
        $stm = $conns->prepare("SELECT * FROM pratioci WHERE email=? ");
        $stm->execute([$mail]);
        $ip = getIps();
        if ($stm->rowCount() == 0)
        {

            $stm = $conns->prepare("INSERT INTO pratioci (`email`,`ip`) VALUES (?,?)");
            $stm->execute([$mail,$ip]);

        }
    }

}
function getPhone()
{
    global $conns;
    $phone_id = $_GET['phone_id'];
    $stm = $conns->prepare("SELECT * FROM phones WHERE id=? LIMIT 1");
    $stm->execute([$phone_id]);
    $model = $stm->fetch(PDO::FETCH_ASSOC);

    return $model;
}
function getCommentsPhone()
{
    global $conns;
    $id = $_GET['phone_id'];

    $stm = $conns->prepare("SELECT * FROM comments WHERE phone_id=? ORDER BY created_at DESC");
    $stm->execute([$id]);
    $comments = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $comments;

}
function getFirmaCena()
{
    global $conns;
    $phone_id = $_GET['phone_id'];

    $stm = $conns->prepare("SELECT DISTINCT(company_id),phone_id, created_at,cena FROM  company_phone WHERE phone_id=? GROUP BY phone_id ORDER BY cena ");
    $stm->execute([$phone_id]);
    $modelis = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $modelis;
}
function getModeli()
{
    global $conns;
    $phone_id = IdCheck();
    if (is_numeric($phone_id))
    {

        $stm = $conns->prepare("SELECT * FROM phones WHERE id_telefona=?");
        $stm->execute([$phone_id]);
        $modelis = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $modelis;
    }

}
function IdCheck()
{
    try
    {
        $link = $_SERVER['REQUEST_URI'];
        $link = explode('/', $link);
        $id = end($link);
        return $id;

    }
    catch(Exception $e)
    {
        return false;
    }

}
function getMarkes()
{
    global $conns;

    $stm = $conns->query("SELECT * FROM modeli");
    $stm->execute();
    $marke = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $marke;
}
function getCompanyUser()
{
    global $conns;
    $user_id = $_GET['company_id'];
    $stm = $conns->prepare("SELECT * FROM company WHERE id=? LIMIT 1");
    $stm->execute([$user_id]);
    $company = $stm->fetch(PDO::FETCH_ASSOC);
    return $company;
}
function getCompanyLocation()
{
    global $conns;
    $company_id = $_GET['company_id'];

    $stm = $conns->prepare("SELECT * FROM lokacije WHERE company_id=?");
    $stm->execute([$company_id]);
    $lokacije = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $lokacije;
}
function getCompanyPost()
{
    global $conns;
    $user_id = $_GET['company_id'];

    $stm = $conns->prepare("SELECT DISTINCT(phone_id),id,phone_id,cena,memorija,created_at,company_id FROM company_phone WHERE company_id=? GROUP BY phone_id ORDER BY marka_id,cena DESC,created_at DESC");
    $stm->execute([$user_id]);
    $post = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $post;
}
function getPostsbyCustomUser($user_id)
{
    global $conns;
   

    $stm = $conns->prepare("SELECT * FROM posts WHERE user_id=? AND delete_check='false' AND published=true ORDER BY created_at DESC");
    $stm->execute([$user_id]);
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}
function followUser()
{
    global $conns, $errors;
    if (isset($_SESSION['user']['id']))
    {

        $user_id = $_SESSION['user']['id'];
        $followed_user = $_GET['user_id'];

        $stm = $conns->prepare("SELECT * FROM follow WHERE folowed_user=? AND id_user=?");
        $stm->execute([$user_id, $followed_user]);
        $num = $stm->rowCount();

        if ($num == 0)
        {

            $stm = $conns->prepare("INSERT INTO follow (`id_user`, `folowed_user`) VALUES (?, ?)");
            $stm->execute([$followed_user, $user_id]);

        }
        if ($num > 0)
        {
            $stm = $conns->prepare("DELETE FROM follow WHERE  folowed_user=? AND id_user=?");
            $stm->execute([$user_id, $followed_user]);
        }
    }
}
function changePassword()
{
    global $conns, $errors;
    if (isset($_GET['conf']) && isset($_GET['user_id']))
    {
        $conf = $_GET['conf'];
        $user_id = $_GET['user_id'];
        $password = strip_tags($_POST['password']);
        $password1 = strip_tags($_POST['password1']);

        if ($password != $password1)
        {
            array_push($errors, "Nije ista sifra");
        }
        if (count($errors) == 0)
        {

            $password = md5($password);

            $stm = $conns->prepare("SELECT * FROM recovery WHERE confirmation_code=? AND user=? LIMIT 1");
            $stm->execute([$conf, $user_id]);

            if ($stm->rowCount() > 0)
            {
                $user = $stm->fetch(PDO::FETCH_ASSOC);

                $id = $user['user_id'];

                $stm = $conns->prepare("UPDATE users SET password=? WHERE id=? LIMIT 1");

                if ($stm->execute([$password, $id]))
                {
                    if (isset($_SESSION['user']['id']))
                    {
                        $_SESSION['user']['password'] = $password;
                    }
                    else
                    {

                        $stm = $conns->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
                        $stm->execute([$id]);

                        $_SESSION['user'] = $stm->fetch(PDO::FETCH_ASSOC);
                    }

                    $stm = $conns->prepare("DELETE FROM recovery WHERE  `confirmation_code`=? AND `user`=? LIMIT 1");
                    $stm->execute([$conf, $user_id]);
                    header('location: ../index');
                }
            }
            else
            {
                array_push($errors, "Ovaj link je vec iskoriscen ili je doslo do neke goreske.</br>Ako i dalje budete dobijali ovu gresku molio vas da nas kontaktirate.");
            }
        }
    }

}

function getModelss()
{

    global $conns;

    $stm = $conns->query("SELECT * FROM modeli");
    $stm->execute();
    $models = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $models;
}

function getPublishedPostsMobile()
{

    global $conns;
    $a1 = array(
        '57',
        '105',
        '153',
        '201'
    );
    $a[0] = array(
        '56',
        '104',
        '152',
        '200'
    );
    $a[1] = array(
        '57',
        '105',
        '153',
        '201'
    );
    $a[2] = array(
        '56',
        '104',
        '152',
        '200'
    );

    if (isset($_COOKIE['mobile_zoom']))
    {
        $zoom = $_COOKIE['mobile_zoom'];
    }
    else
    {
        $zoom = '83';
    }
    $ids = array(
        '62',
        '83',
        '125.3'
    );
    for ($i = 0;$i < 3;$i++)
    {
        if ($ids[$i] == $zoom)
        {
            $a1 = $a[$i];
        }
    }
    if (isset($_GET['num_post']))
    {

        if ($_GET['num_post'] != 0 && $_GET['num_post'] != 1 && $_GET['num_post'] != 2 && $_GET['num_post'] != 3)
        {
            $num_row2 = 2;
        }
        else
        {
            $num_row2 = $_GET['num_post'];

        }
    }
    else
    {
        $num_row2 = 2;
    }
    $num_row = $a1[$num_row2];
    if (isset($_GET['sort']) && !empty($_GET['sort']))
    {
        $sort = $_GET['sort'];
        if ($sort == 'dateup')
        {
            $sort_prem = 'ORDER BY created_at desc';
        }
        if ($sort == 'datedown')
        {
            $sort_prem = 'ORDER BY created_at';
        }
        if ($sort == 'pricedown')
        {
            $sort_prem = ' AND cena!="Dogovor" ORDER BY cena desc';
        }
        if ($sort == 'priceup')
        {
            $sort_prem = 'ORDER BY cena ';
        }

    }
    else
    {
        $sort_prem = 'ORDER BY created_at desc';
    }

    if (isset($_GET['page_id']) && !empty($_GET['page_id']))
    {
        $num = $_GET['page_id'];
    }
    else
    {
        $num = 1;
    }
    if ($num == 1)
    {
        $num_rows = $num_row;
    }
    else
    {
        $num_rows = ($num * $num_row) - $num_row . ',' . $num * $num_row / 2;
    }

    $stm = $conns->query("SELECT * FROM posts WHERE published=true AND delete_check='false' $sort_prem LIMIT $num_rows");
    $stm->execute();
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function getPublishedPosts()
{

    global $conns;
    $a1 = array(
        '54',
        '102',
        '150',
        '198'
    );
    $a[0] = array(
        '54',
        '108',
        '144',
        '198'
    );
    $a[1] = array(
        '56',
        '104',
        '152',
        '200'
    );
    $a[2] = array(
        '56',
        '98',
        '154',
        '196'
    );
    $a[3] = array(
        '54',
        '102',
        '150',
        '198'
    );
    $a[4] = array(
        '50',
        '100',
        '150',
        '200'
    );

    if (isset($_COOKIE['zoom']))
    {
        $zoom = $_COOKIE['zoom'];
    }
    else
    {
        $zoom = '83';
    }
    $ids = array(
        '55.1',
        '62',
        '70.9',
        '83',
        '100'
    );
    for ($i = 0;$i < 5;$i++)
    {
        if ($ids[$i] == $zoom)
        {
            $a1 = $a[$i];
        }
    }
    if (isset($_GET['num_post']))
    {

        if ($_GET['num_post'] != 0 && $_GET['num_post'] != 1 && $_GET['num_post'] != 2 && $_GET['num_post'] != 3)
        {
            $num_row2 = 2;
        }
        else
        {
            $num_row2 = $_GET['num_post'];

        }
    }
    else
    {
        $num_row2 = 2;
    }
    $num_row = $a1[$num_row2];
    if (isset($_GET['sort']) && !empty($_GET['sort']))
    {
        $sort = $_GET['sort'];
        if ($sort == 'dateup')
        {
            $sort_prem = 'ORDER BY created_at desc';
        }
        if ($sort == 'datedown')
        {
            $sort_prem = 'ORDER BY created_at';
        }
        if ($sort == 'pricedown')
        {
            $sort_prem = ' AND cena!="Dogovor" ORDER BY cena desc';
        }
        if ($sort == 'priceup')
        {
            $sort_prem = 'ORDER BY cena ';
        }

    }
    else
    {
        $sort_prem = 'ORDER BY created_at desc';
    }

    if (isset($_GET['page_id']) && !empty($_GET['page_id']))
    {
        $num = $_GET['page_id'];
    }
    else
    {
        $num = 1;
    }
    if ($num == 1)
    {
        $num_rows = $num_row;
    }
    else
    {
        $num_rows = ($num * $num_row) - $num_row . ',' . $num * $num_row / 2;
    }

    $stm = $conns->query("SELECT * FROM posts WHERE published=true AND delete_check='false' $sort_prem LIMIT $num_rows");
    $stm->execute();
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $posts;
}

function getPublishedPostsSidebar($id_modela)
{
    global $conns;
    $id_modela;

    $stm = $conns->prepare("SELECT * FROM posts WHERE reklamno='1' AND model_id=? AND published=true AND delete_check='false' ORDER BY created_at  LIMIT 10");
    $stm->execute([$id_modela]);
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);
    $num1 = $stm->rowCount();
    if ($num1 < 10)
    {
        $num2 = 10 - $num1;

        $stm = $conns->prepare("SELECT * FROM posts WHERE  model_id=? AND published=true AND delete_check='false' ORDER BY created_at  LIMIT $num2");
        $stm->execute([$id_modela]);

        $num1 = $stm->rowCount();

        $posts = array_merge($posts, $stm->fetchAll(PDO::FETCH_ASSOC));
        if ($num1 < $num2)
        {
            $num2 = $num2 - $num1;

            $stm = $conns->query("SELECT * FROM posts WHERE  published=true AND delete_check='false' ORDER BY created_at  LIMIT $num2");
            $stm->execute();

            $num1 = $stm->rowCount();
            $posts = array_merge($posts, $stm->fetchAll(PDO::FETCH_ASSOC));
        }

    }

    return $posts;
}

function getPost()
{
    global $conns;
    $post_slug = IdCheck();
    $stm = $conns->prepare("SELECT * FROM posts WHERE id=? AND published=true AND delete_check='false' ORDER BY created_at DESC");
    $stm->execute([$post_slug]);
    $post = $stm->fetch(PDO::FETCH_ASSOC);

    return $post;
}
function getCaracter()
{
    global $conns;

    $post_slug = $_GET['id'];

    $stm = $conns->prepare("SELECT * FROM phones WHERE id=$post_slug");
    $stm->execute([$post_slug]);
    $phone = $stm->fetch(PDO::FETCH_ASSOC);

    return $phone;
}

function getFilterPost()
{
    global $conns;
    if (!empty($_GET["post_id"]) || !empty($_GET["model_id"]))
    {

        if (isset($_GET["post_id"]) && !empty($_GET["post_id"]) != '')
        {

            if ($_GET["post_id"] == "")
            {
                $selStudent1 = "";
            }
            else
            {
                if (is_array($_GET["post_id"]))
                {
                    $selStudent = implode(", ", $_GET["post_id"]);

                    $selStudent1 = "id_telefona IN ($selStudent) AND";

                }
                else
                {
                    $selStudent1 = "id_telefona IN (" . $_GET["post_id"] . ") AND";
                }
            }
        }
        if (isset($_GET["model_id"]) && empty($_GET["post_id"]))
        {
            $selStudent = $_GET['model_id'];
            $selStudent1 = "model_id IN ($selStudent) AND";
        }
    }
    else
    {
        $selStudent1 = "";
        $selStudent = "";
    }

    if (!empty($_GET["garan"]))
    {

        if ($_GET["garan"] != 0)
        {
            $garancija = "AND garancija!=0";
        }
        else
        {
            $garancija = "";
        }
    }
    else
    {
        $garancija = "";
    }
    if (!empty($_GET["cena"]))
    {

        if ($_GET["cena"] == "")
        {
            $cena = "";
        }
        else
        {


          $splitCena = explode('-', $_GET["cena"]);

          if (!empty($splitCena[1])) {
             $cena = "AND cena<=" . $splitCena[1] . " AND cena >=".$splitCena[0];

          }else if(is_numeric($_GET["cena"])){

            $cena = "AND cena<=" . $_GET["cena"];

          }else{
            $cena = "";
          }



        }
    }
    else
    {
        $cena = "";
    }
    if (!empty($_GET["network_id"]))
    {

        $network_id = $_GET["network_id"];
        if ($network_id == 1)
        {
            $network = "";
        }
        if ($network_id == 2)
        {
            $network = "AND mreza=2";
        }
        if ($network_id == 3)
        {
            $network = "AND mreza=3";
        }
        if ($network_id == 4)
        {
            $network = "AND mreza=4";
        }
    }
    else
    {
        $network = "";
    }

    $a1 = array(
        '54',
        '102',
        '150',
        '198'
    );
    $a[0] = array(
        '54',
        '108',
        '144',
        '198'
    );
    $a[1] = array(
        '56',
        '104',
        '152',
        '200'
    );
    $a[2] = array(
        '56',
        '98',
        '154',
        '196'
    );
    $a[3] = array(
        '54',
        '102',
        '150',
        '198'
    );
    $a[4] = array(
        '50',
        '100',
        '150',
        '200'
    );

    if (isset($_COOKIE['zoom']))
    {
        $zoom = $_COOKIE['zoom'];
    }
    else
    {
        $zoom = '83';
    }
    $ids = array(
        '55.1',
        '62',
        '70.9',
        '83',
        '100'
    );
    for ($i = 0;$i < 5;$i++)
    {
        if ($ids[$i] == $zoom)
        {
            $a1 = $a[$i];
        }
    }

    if (isset($_GET['num_post']))
    {

        if ($_GET['num_post'] != 0 && $_GET['num_post'] != 1 && $_GET['num_post'] != 2 && $_GET['num_post'] != 3)
        {
            $num_row2 = 2;
        }
        else
        {
            $num_row2 = $_GET['num_post'];
        }
    }
    else
    {
        $num_row2 = 2;
    }
    $num_row = $a1[$num_row2];

    if (isset($_GET['sort']) && !empty($_GET['sort']))
    {
        $sort = $_GET['sort'];
        if ($sort == 'dateup')
        {
            $sort_prem = 'ORDER BY reklamno desc, created_at desc';
        }
        if ($sort == 'datedown')
        {
            $sort_prem = 'ORDER BY  reklamno desc, created_at';
        }
        if ($sort == 'pricedown')
        {
            $sort_prem = ' AND cena!="Dogovor" ORDER BY  reklamno desc, cena desc';
        }
        if ($sort == 'priceup')
        {
            $sort_prem = 'ORDER BY  reklamno desc, cena';
        }

    }
    else
    {
        $sort_prem = 'ORDER BY reklamno desc, created_at desc';
    }

    if (isset($_GET['page_id']) && !empty($_GET['page_id']))
    {
        $num = $_GET['page_id'];
    }
    else
    {
        $num = 1;
    }
    if ($num == 1)
    {
        $num_rows = $num_row;
    }
    else
    {
        $num_rows = ($num * $num_row) - $num_row . ',' . $num * $num_row / 2;
    }

    $stm = $conns->query("SELECT id FROM posts WHERE $selStudent1 published=true AND delete_check='false' $garancija $cena $network $sort_prem ");
    $stm->execute();
    $num = $stm->rowCount();

    $stm = $conns->query("SELECT * FROM posts WHERE $selStudent1 published=true AND delete_check='false' $garancija $cena $network $sort_prem LIMIT $num_rows");
    $stm->execute();
    $post = $stm->fetchAll(PDO::FETCH_ASSOC);

    return array(
        $post,
        $num
    );
}

function makePaginate()
{
    global $conns;

    $stm = $conns->query("SELECT * FROM posts WHERE published=true AND delete_check='false'");
    $stm->execute();
    $num_rows = $stm->rowCount();
    return $num_rows;
}

function getReklamniPost()
{
    global $conns;
    $stm = $conns->query("SELECT id FROM posts WHERE reklamno=true AND published=true AND delete_check='false' LIMIT 48");
    $stm->execute();
    $num = $stm->rowCount();

    if ($num > 47)
    {
        $num_rek = 48;
        $num_add = 0;
    }
    else
    {
        $num_rek = $num;
        $num_add = 48 - $num;
    }

    $stm = $conns->query("SELECT * FROM posts WHERE reklamno=true AND published=true AND delete_check='false' ORDER BY RAND() LIMIT $num_rek");
    $stm->execute();
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);

    if ($num_add != 0)
    {

        $stm = $conns->query("SELECT * FROM posts WHERE reklamno=false AND published=true AND delete_check='false' ORDER BY RAND() LIMIT $num_add");
        $stm->execute();
        $posts1 = $stm->fetchAll(PDO::FETCH_ASSOC);

        $post = array_merge($posts, $posts1);

    }
    else
    {
        $post = $posts;
    }

    return $post;
}
function GetSessionUserPublic()
{
    global $conns;
    if (isset($_SESSION['user']['id']))
    {
        $user_id = $_SESSION['user']['id'];

        $stm = $conns->prepare("SELECT * FROM users WHERE id=?");
        $stm->execute([$user_id]);
        $users = $stm->fetch(PDO::FETCH_ASSOC);

        return $users;
    }
}

function SplitWrods($words)
{
    $return = str_replace(' ', '-', $words);
    return $return;

}
function getIps(){
     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
return $ip;
}


?>
