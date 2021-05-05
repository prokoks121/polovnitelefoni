<?php
require_once(ROOT_PATH  . "/PHPMailer/class.smtp.php");
require_once(ROOT_PATH  . "/PHPMailer/class.phpmailer.php");
$errors = [];
$succes = [];
$notic = [];
$telefon2 = "";

if (isset($_POST['sacuvaj']))
{
    editUser($_POST);
}
if (isset($_POST['submit_rec']))
{
    recoveryPassword($_POST);
}
if (isset($_POST['edit_phone_id']))
{
    editPhonesCompany($_POST);
}

if (isset($_POST['sacuvaj2']))
{
    editPsw($_POST);
}
if (isset($_POST['submit12']))
{
    ReSendCode($_POST);
}
if (isset($_POST['sacuvaj13']))
{
    editEmailed($_POST);
}
if (isset($_POST['com_submit']))
{
    getCommentsbyCustomUser($_POST);
}
if (isset($_POST['com_submit1']))
{
    getCommentsbyPhone($_POST);
}
if (isset($_POST['comm_delete']))
{
    DeleteComments($_POST);
}
if (isset($_POST['reg_company']))
{
    RegCompany($_POST);
}
if (isset($_POST['company_change']))
{
    UserCompanyChange($_POST);
}
if (isset($_POST['create_post_company']))
{
    CreatePostCompany($_POST);
}
if (isset($_POST['company_location_add']))
{
    CreateComapnyLocation($_POST);
}
if (isset($_POST['company_post_delete']))
{
    DeleteCompanyPost($_POST);
}
if (isset($_POST['company_location_delete']))
{
    DeleteCompanyLocation($_POST);
}
if (isset($_POST['new_model']))
{
    AddNewModel($_POST);
}

function editPhonesCompany()
{
    global $conns, $errors;
    if (!isset($_GET['id_telefona']))
    {
        array_push($errors, "Greska.");
    }

    if (!isset($_SESSION['user']['id']))
    {
        array_push($errors, "Morate da se prijavite.");
    }

    $phone_id = $_POST['edit_phone_id'];
    $company_id = getCompanyUserbyUser() ['id'];
    $mem['1'] = $_POST['mem/' . $phone_id . '/0'];
    $mem['2'] = $_POST['mem/' . $phone_id . '/1'];
    $mem['3'] = $_POST['mem/' . $phone_id . '/2'];
    $mem['4'] = $_POST['mem/' . $phone_id . '/3'];
    $mem['5'] = $_POST['mem/' . $phone_id . '/4'];
    $mem['6'] = $_POST['mem/' . $phone_id . '/5'];
    $mem['7'] = $_POST['mem/' . $phone_id . '/6'];
    $mem['8'] = $_POST['mem/' . $phone_id . '/7'];
    $mem['9'] = $_POST['mem/' . $phone_id . '/8'];

    $cena['1'] = $_POST['cena/' . $phone_id . '/0'];
    $cena['2'] = $_POST['cena/' . $phone_id . '/1'];
    $cena['3'] = $_POST['cena/' . $phone_id . '/2'];
    $cena['4'] = $_POST['cena/' . $phone_id . '/3'];
    $cena['5'] = $_POST['cena/' . $phone_id . '/4'];
    $cena['6'] = $_POST['cena/' . $phone_id . '/5'];
    $cena['7'] = $_POST['cena/' . $phone_id . '/6'];
    $cena['8'] = $_POST['cena/' . $phone_id . '/7'];
    $cena['9'] = $_POST['cena/' . $phone_id . '/8'];
    if (count($errors) == 0)
    {

        for ($i = 1;$i < 10;$i++)
        {
            $mems = $mem[$i];
            $cenas = $cena[$i];

                  $stm = $conns->prepare("SELECT id FROM company_phone WHERE company_id=? AND phone_id=? AND memorija=? LIMIT 1");
        $stm->execute([$company_id,$phone_id,$mems]);
        $check = $stm->rowCount();


            if ($check != 0)
            {
                if ($cenas == '' or $cenas == '0')
                {
                        $stm = $conns->prepare("DELETE FROM `company_phone` WHERE `company_id`=? AND `phone_id`=? AND `memorija`=? LIMIT 1");
        $stm->execute([$company_id,$phone_id,$mems]);
                }
                else
                {
                 $stm = $conns->prepare("UPDATE `company_phone` SET `cena`=? WHERE `company_id`=? AND `phone_id`=? AND `memorija`=? LIMIT 1");
        $stm->execute([$cenas, $company_id,$phone_id,$mems]);
          $stm = $conns->prepare("SELECT id_telefona FROM modeli WHERE model=(SELECT marka FROM phones WHERE id=?LIMIT 1) LIMIT 1");
                             $stm->execute([$phone_id ]);
                                 $marka = $stm->fetchAll(PDO::FETCH_ASSOC);
                                 $marka = $marka['0']['id_telefona'];
     $stm = $conns->prepare("INSERT INTO `backcompany_phone`(`company_id`, `phone_id`, `marka_id`, `cena`, `memorija`, `created_at`) VALUES (?,?,?,?,?,NOW())");
                             $stm->execute([$company_id,$phone_id,$marka,$cenas,$mems]);

                }
            }
            else
            {
                if ($cenas != '' and $cenas != '0')
                {
                  

                             $stm = $conns->prepare("SELECT id_telefona FROM modeli WHERE model=(SELECT marka FROM phones WHERE id=?LIMIT 1) LIMIT 1");
       						 $stm->execute([$phone_id ]);
       						     $marka = $stm->fetchAll(PDO::FETCH_ASSOC);
       						     $marka = $marka['0']['id_telefona'];
       						 $stm = $conns->prepare("INSERT INTO `company_phone`(`company_id`, `phone_id`, `marka_id`, `cena`, `memorija`, `created_at`) VALUES (?,?,?,?,?,NOW())");
       						 $stm->execute([$company_id,$phone_id,$marka,$cenas,$mems]);
                                 $stm = $conns->prepare("INSERT INTO `backcompany_phone`(`company_id`, `phone_id`, `marka_id`, `cena`, `memorija`, `created_at`) VALUES (?,?,?,?,?,NOW())");
                             $stm->execute([$company_id,$phone_id,$marka,$cenas,$mems]);

                }
            }
        }
    }

}
function AddNewModel()
{
    global $conns, $errors, $notic;
    if (!isset($_SESSION['user']['id']))
    {
        array_push($errors, "Morate da se prijavite.");
    }
    if ($_POST['model'] == '')
    {
        array_push($errors, "Unesite model.");
    }
    if ($_POST['marka'] == '')
    {
        array_push($errors, "Unesite Proizvodjaca.");
    }
    $user_id = $_SESSION['user']['id'];
    $model = strip_tags($_POST['model']);
    $marka = strip_tags($_POST['marka']);
    $out = $model . "/%/" . $marka;
    if (count($errors) == 0)
    {
  
               $stm = $conns->prepare("INSERT INTO request (`user_id`, `sta`, `created_at`) VALUES (?,?,NOW())");
       						 $stm->execute([$user_id,$out]);
        echo "<meta http-equiv='refresh' content='0'>";
    }

}

function DeleteCompanyLocation()
{
    global $conns;
    $post_id = $_POST['company_location_delete'];
    $user_id = getCompanyUserbyUser() ['id'];
   $stm = $conns->prepare("DELETE FROM lokacije WHERE id=? AND company_id=?");
       						 $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";
}

function DeleteCompanyPost()
{
    global $conns;
    $post_id = $_POST['company_post_delete'];
    $user_id = getCompanyUserbyUser() ['id'];
      $stm = $conns->prepare("DELETE FROM company_phone WHERE id=? AND company_id=?");
      $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";

}
function CreateComapnyLocation()
{
    global $conns, $errors;
    $company_id = getCompanyUserbyUser() ['id'];
    $ime = getCompanyUserbyUser() ['ime'];
    $telefon = strip_tags($_POST['telefon']);
    $email = strip_tags($_POST['email']);
    $opstina = strip_tags($_POST['adresa1']);
    $adresas = strip_tags($_POST['adresa']);
    $grad = strip_tags($_POST['adresa2']);
    $postal_code = strip_tags($_POST['adresa3']);
    $adresa = $adresas . "%" . $opstina . "%" . $grad . "%" . $postal_code;
    $rad = strip_tags($_POST['rad1']) . "%" . strip_tags($_POST['rad2']) . "%" . strip_tags($_POST['rad3']);
    if ($telefon == '')
    {
        array_push($errors, "Niste uneli telefon");
    }
    if ($email == '')
    {
        array_push($errors, "Niste uneli Email");
    }
    if ($grad == '')
    {
        array_push($errors, "Niste uneli Grad");
    }
    if ($adresas == '')
    {
        array_push($errors, "Niste uneli Adresu");
    }
    if ($opstina == '')
    {
        array_push($errors, "Niste uneli Opstinu");
    }
    if ($postal_code == '')
    {
        array_push($errors, "Niste uneli postanski beoj");
    }

    $baseURL = "https://dev.virtualearth.net/REST/v1/Locations";

    // Create variables for search parameters (encode all spaces by specifying '%20' in the URI)
    $key = 'AgHRct6VCWsXPU2p7Y7mI8wsjY5zmWObaXLmBEeN20Tow_w0Q8VmeQSV3TvK_81y';
    $country = "RS";
    $addressLine = str_ireplace(" ", "%20", $adresas);
    $adminDistrict = str_ireplace(" ", "%20", $opstina);
    $locality = str_ireplace(" ", "%20", $grad);
    $postalCode = str_ireplace(" ", "%20", $postal_code);

    // Compose URI for Locations API request
    $findURL = $baseURL . "/" . $country . "/" . $adminDistrict . "/" . $postalCode . "/" . $locality . "/" . $addressLine . "?output=xml&key=" . $key;
    // get the response from the Locations API and store it in a string
    if (count($errors) == 0)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $findURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        // create an XML element based on the XML string
        $response = new SimpleXMLElement($output);

        // Extract data (e.g. latitude and longitude) from the results
        $latitude = $response
            ->ResourceSets
            ->ResourceSet
            ->Resources
            ->Location
            ->Point->Latitude;
        $longitude = $response
            ->ResourceSets
            ->ResourceSet
            ->Resources
            ->Location
            ->Point->Longitude;
        $loca = $latitude . ", " . $longitude;

    $ip = getIp();
          $stm = $conns->prepare("INSERT INTO lokacije (`ime`, `company_id`, `email`, `telefon`, `geocode`, `vreme`, `adresa`, `ip`) VALUES (?,?,?,?,?,?,?,?)");
      $stm->execute([$ime,$company_id,$email,$telefon,$loca,$rad,$adresa,$ip]);
       $stm = $conns->prepare("INSERT INTO backlokacije (`ime`, `company_id`, `email`, `telefon`, `geocode`, `vreme`, `adresa`, `ip`) VALUES (?,?,?,?,?,?,?,?)");
      $stm->execute([$ime,$company_id,$email,$telefon,$loca,$rad,$adresa,$ip]);
        echo "<meta http-equiv='refresh' content='0'>";

    }

}

function CreatePostCompany()
{
    global $conns, $errors;
    $user_id = getCompanyUserbyUser() ['id'];
    $model = strip_tags($_POST['model']);
    $cena = strip_tags($_POST['cena']);
    if ($model == 0)
    {
        array_push($errors, "Niste uneli model");
    }
    if ($cena == '')
    {
        array_push($errors, "Niste uneli cenu");
    }
    if (count($errors) == 0)
    {
        $stm = $conns->prepare("SELECT * FROM company_phone WHERE phone_id=? AND company_id=?");
      $stm->execute([$model,$user_id]);

        if ($stm->rowCount() == 0)
        {
              $stm = $conns->prepare("INSERT INTO company_phone (`company_id`, `phone_id`, `cena`,`created_at`) VALUES (?,?,?,NOW())");
      $stm->execute([$user_id,$model,$cena]);
       $stm = $conns->prepare("INSERT INTO backcompany_phone (`company_id`, `phone_id`, `cena`,`created_at`) VALUES (?,?,?,NOW())");
      $stm->execute([$user_id,$model,$cena]);
            echo "<meta http-equiv='refresh' content='0'>";

        }
        else
        {
             $stm = $conns->prepare("UPDATE company_phone SET cena=?, created_at=now() WHERE phone_id=? AND  company_id=?");
      $stm->execute([$cena,$model,$user_id]);

   $stm = $conns->prepare("INSERT INTO backcompany_phone (`company_id`, `phone_id`, `cena`,`created_at`) VALUES (?,?,?,NOW())");
      $stm->execute([$user_id,$model,$cena]);

            echo "<meta http-equiv='refresh' content='0'>";

        }

    }
}

function UserCompanyChange()
{
    global $conns, $errors;
    $user_id = $_SESSION['user']['id'];

    $telefon = strip_tags($_POST['telefon']);
    $email = strip_tags($_POST['email']);
    $opstina = strip_tags($_POST['adresa1']);
    $adresas = strip_tags($_POST['adresa']);
    $grad = strip_tags($_POST['adresa2']);
    $postal_code = strip_tags($_POST['adresa3']);
    $adresa = $adresas . "%" . $opstina . "%" . $grad . "%" . $postal_code;
    $rad = strip_tags($_POST['rad1']) . "%" . strip_tags($_POST['rad2']) . "%" . strip_tags($_POST['rad3']);
    $adrese22 = $adresas . ', ' . $opstina;
    if ($telefon == '')
    {
        array_push($errors, "Niste uneli telefon");
    }
    if ($email == '')
    {
        array_push($errors, "Niste uneli Email");
    }
    if ($grad == '')
    {
        array_push($errors, "Niste uneli Grad");
    }
    if ($adresas == '')
    {
        array_push($errors, "Niste uneli Adresu");
    }
    if ($opstina == '')
    {
        array_push($errors, "Niste uneli Opstinu");
    }
    if ($postal_code == '')
    {
        array_push($errors, "Niste uneli postanski beoj");
    }

    if (count($errors) == 0)
    {

        $url = "street=" . $adresas . "&city=" . $grad . "&postalcode=" . $postal_code . "&county=" . $opstina;
        $url = "https://us1.locationiq.com/v1/search.php?key=51b19888a471c1&limit=1&countrycodes=RS&" . $url . "&format=json";
        $curl = curl_init($url);

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $obj = json_decode($response);

        $loca = $obj[0]->lat . ', ' . $obj[0]->lon;


      $stm = $conns->prepare("UPDATE company SET adresa=?,lokacija=?,adrese=?,r_dani=?,e_cont=?,telefon=? WHERE user_id=?");
      $stm->execute([$adresa,$loca,$adrese22,$rad,$email,$telefon,$user_id]);

    $stm = $conns->prepare("SELECT regist,ime FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
    $company = $stm->fetch(PDO::FETCH_ASSOC);
$reg = $company['regist'];
$ime = $company['ime'];

      $stm = $conns->prepare("INSERT INTO `backcompany`(`user_id`, `regist`, `ime`, `adresa`, `lokacija`, `adrese`, `r_dani`, `e_cont`, `create_at`, `telefon`) VALUES ('$user_id','$reg','$ime','$adr','$loca','$adr1','$dani','$email',NOW(),'$telefon')");
      $stm->execute([$user_id,$reg,$ime,$adresa,$loca,$adrese22,$rad,$email,$telefon]);


         

        echo "<meta http-equiv='refresh' content='0'>";

    }
}
function getCompanyUserbyUser()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
    $company = $stm->fetch(PDO::FETCH_ASSOC);


    return $company;
}
function getCompanyLocationbyUser()
{
    global $conns;
    $company_id = getCompanyUserbyUser() ['id'];

    $stm = $conns->prepare("SELECT * FROM lokacije WHERE company_id=?");
    $stm->execute([$company_id]);
    $lokacije = $stm->fetchAll(PDO::FETCH_ASSOC);



    return $lokacije;
}
function getCompanyPostbyUser()
{
    global $conns;
    $user_id = getCompanyUserbyUser() ['id'];
    $stm = $conns->prepare("SELECT * FROM company_phone WHERE company_id=? ORDER BY created_at DESC");
    $stm->execute([$user_id]);
    $post = $stm->fetchAll(PDO::FETCH_ASSOC);


    return $post;
}
function RegCompany()
{
    global $conns, $errors;
    $user_id = $_SESSION['user']['id'];
    $pib = strip_tags($_POST['pib']);
    $mbr = strip_tags($_POST['mbr']);
    $telefon = strip_tags($_POST['telefon']);
    $email = strip_tags($_POST['email']);
    $ime = strip_tags($_POST['ime']);
    $grad = strip_tags($_POST['grad']);
    $adresas = strip_tags($_POST['adresa']);
    $opstina = strip_tags($_POST['opstina']);
    $post_code = strip_tags($_POST['pos_br']);
    $adresa = $grad . "/%/" . $adresas . "/%/" . $opstina . "/%/" . $post_code;
    if (isset($_POST['sub_ne']))
    {
        $subota = "Neradno";
    }
    else
    {
        $subota = strip_tags($_POST['sub1']) . "/%/" . strip_tags($_POST['sub2']);
    }
    if (isset($_POST['ned_ne']))
    {
        $nedelja = "Neradno";
    }
    else
    {
        $nedelja = strip_tags($_POST['ned1']) . "/%/" . strip_tags($_POST['ned2']);
    }
    $rad = strip_tags($_POST['rad1']) . "/%/" . strip_tags($_POST['rad2']);
    $vreme = $rad . "/&&/" . $subota . "/&&/" . $nedelja;
    if ($pib == '')
    {
        array_push($errors, "Niste uneli PIB");
    }
    if ($mbr == '')
    {
        array_push($errors, "Niste uneli MBR");
    }
    if ($telefon == '')
    {
        array_push($errors, "Niste uneli telefon");
    }
    if ($email == '')
    {
        array_push($errors, "Niste uneli Email");
    }
    if ($grad == '')
    {
        array_push($errors, "Niste uneli Grad");
    }
    if ($adresa == '')
    {
        array_push($errors, "Niste uneli Adresu");
    }
    if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id']))
    {
        array_push($errors, "Doslo je do greske");
    }
    if (count($errors) == 0)
    {
$ip = getIp();

            $stm = $conns->prepare("INSERT INTO `zahtev`(`user_id`, `mbr`, `pib`, `ime`, `adresa`, `email`, `telefon`, `vreme`, `ip`) VALUES (?,?,?,?,?,?,?,?,?)");
    $stm->execute([$user_id,$mbr,$pib,$ime,$adresa,$email,$telefon,$vreme,$ip]);





        echo "<meta http-equiv='refresh' content='0'>";
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
                              Poslao :  ' . GetSessionUser() ['email'] . ' ' . GetSessionUser() ['ime'] . ' ' . GetSessionUser() ['prezime'] . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Poruka: Novi zahtev za preduzece!!!
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
        $headers = 'From: PolovniTelefoni.net <no-replay@polovnitelefoni.net>' . "\r\n";
        $headers .= 'Reply-To: no-replay@polovnitelefoni.net' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

        mail('aleksic@polovnitelefoni.net', $subject, $message, $headers);

    }
}

function DeleteComments()
{
    global $conns, $errors;
    $com_id = $_POST['comm_delete'];
    $user_id = $_SESSION['user']['id'];

    $stm = $conns->prepare("DELETE FROM comments WHERE id=? AND user_id=? ");
    $stm->execute([$com_id,$user_id]);




    echo "<meta http-equiv='refresh' content='0'>";

}
function editEmailed()
{
    global $conns, $errors;
    $ip = getIp();
    $mail = strip_tags($_POST['email122']);
    $email = GetSessionUser() ['email'];
    $user = $_SESSION['user']['id'];
    $confirm_code = GetSessionUser() ['confirmation_code'];
    if (strpos($mail, '@') != true)
    {
        array_push($errors, "Uneli ste neispravan e-mail");
    }
    if ($mail == '')
    {
        array_push($errors, "Niste uneli e-mail");
    }
    if ($mail == $email)
    {
        array_push($errors, "Uneli ste isti email");
    }


    $result = $conns->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $result->execute([$mail]);




    if ($result->rowCount() != 0)
    {
        array_push($errors, "Ovaj email se vec u upotrebi");
    }
    if (count($errors) == 0)
    {
        $confirm_code = md5(uniqid(rand()));

         $rsrt = $conns->prepare("INSERT INTO recovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,'0011001200', now(),?)");
    $rsrt->execute([$mail,$user, $confirm_code,$ip]);

          $rsrt = $conns->prepare("INSERT INTO backrecovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,'0011001200', now(),?)");
    $rsrt->execute([$mail,$user, $confirm_code,$ip]);

        echo "<meta http-equiv='refresh' content='0'>";

        $conf_code = 'https://www.polovnitelefoni.net/user/confirmation_email?user_id=' . $user . '&conf=' . $confirm_code;
        $subject = 'PolovniTelefoni.net';
        $i_user = GetSessionUser();
        $message = '<html><body>';

        $message .= '
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f5f8fa; min-width: 350px; font-size: 1px; line-height: normal;">
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
                              Pozdrav  ' . $i_user['ime'] . ' ' . $i_user['prezime'] . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Dobili smo zahtev za promenu email adrese na vašem nalogu na sajtu PolovniTelefoni.net.
                                Ako želite da vaša nova email adresa bude ' . $mail . ' , kliknite na polje ispod.
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                        <table class="mob_btn" cellpadding="0" cellspacing="0" border="0"
                        style="background: #14264e; border-radius: 4px;">
                          <tr>
                            <td align="center" valign="top">
                              <a href="' . $conf_code . '"
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
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, sve vaše poruke sa PolovniTelefoni.net će stizati na ' . $mail . '</span>
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

        $from_name = $i_user['ime'] . ' ' . $i_user['prezime'];

        if (smtpmailers($mail, $from_name, $subject, $message))
        {

            $_SESSION['user']['confirmation_code'] = $code;

        }

    }

    if (isset($_POST['mail']))
    {
        $mail = strip_tags($_POST['mail']);


           $stm = $conns->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stm->execute([$mail]);


        if ($stm->rowCount() > 0)
        {
                $user = $stm->fetch(PDO::FETCH_ASSOC);

                       $stm = $conns->prepare("SELECT * FROM recovery WHERE email=? LIMIT 1");
        $stm->execute([$mail]);
            if ($stm->rowCount() == 0)
            {

                $confirm_code = md5(uniqid(rand()));

                $user_code = $user['confirmation_code'];
                $user_id = $user['id'];
                $i_user = GetSessionUser();

                    $stm = $conns->prepare("INSERT INTO recovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,?, now(),?)");
        $stm->execute([$mail,$user_id, $confirm_code,$user_code,$ip]);

          $stm = $conns->prepare("INSERT INTO backrecovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,?, now(),?)");
        $stm->execute([$mail,$user_id, $confirm_code,$user_code,$ip]);
                echo "<meta http-equiv='refresh' content='0'>";

                $conf_code = 'https://www.polovnitelefoni.net/user/confirmation_pass?user_id=' . $user_code . '&conf=' . $confirm_code;
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
                              Pozdrav  ' . $i_user['ime'] . ' ' . $i_user['prezime'] . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Dobili smo zahtev za kreiranje nalogu na sajtu PolovniTelefoni.net.
                                Ako želite da sa vašom email adresom ' . $mail . ' bude kreiran nalog, kliknite na polje ispod.
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                        <table class="mob_btn" cellpadding="0" cellspacing="0" border="0"
                        style="background: #14264e; border-radius: 4px;">
                          <tr>
                            <td align="center" valign="top">
                              <a href="' . $conf_code . '"
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
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, sve vaše poruke sa PolovniTelefoni.net će stizati na ' . $mail . '</span>
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
                $message .= '</body></html>';
                $from_name = $i_user['ime'] . ' ' . $i_user['prezime'];

                if (smtpmailers($mail, $from_name, $subject, $message))
                {
                    header('location: ../user/pass_recovery?email=' . $mail . '&send=true');

                    exit();
                }

            }
            else
            {
                header('location: /user/pass_recovery?email=' . $mail . '&send=false');
                exit();
            }

        }
    }

}

function getCommentsbyCustomUser()
{
    global $conns;
    if (strip_tags($_POST['text']) != '' && isset($_POST['smile']) && $_POST['smile'] != '' && isset($_SESSION['user']['id']))
    {

        $text = strip_tags($_POST['text']);

        $user_id = $_SESSION['user']['id'];
        $to_user = $_GET['user_id'];
        $code = $_GET['code_id'];

        $smile = strip_tags($_POST['smile']);


 $stm = $conns->prepare("SELECT * FROM users WHERE id=? AND code_id=?");
        $stm->execute([$to_user, $code]);
        $num = $stm->rowCount();


        if ($num != 0)
        {
            $ip = getIp();
 $stm = $conns->prepare("INSERT INTO comments (`user_id`, `to_user`,`text`,`smile`,`created_at`,`ip`) VALUES(?,?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$smile,$ip]);
         $stm = $conns->prepare("INSERT INTO backcomments (`user_id`, `to_user`,`text`,`smile`,`created_at`,`ip`) VALUES(?,?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$smile,$ip]);

                echo "<meta http-equiv='refresh' content='0'>";

                header("Refresh:0");
                exit;
            
        }

    }
}
function getCommentsbyPhone()
{
    global $conns;
    if ($_POST['text1'] != '' && isset($_SESSION['user']['id']))
    {

        $text = strip_tags($_POST['text1']);

        $user_id = $_SESSION['user']['id'];
        $to_user = $_GET['phone_id'];
 $stm = $conns->prepare("SELECT * FROM phones WHERE id=?");
        $stm->execute([$to_user]);
        $num = $stm->rowCount();

        if ( $num > 0)
        {

$ip = getIp();
             $stm = $conns->prepare("INSERT INTO comments (`user_id`, `phone_id`,`text`,`created_at`,`ip`) VALUES(?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$ip]);
                     $stm = $conns->prepare("INSERT INTO backcomments (`user_id`, `phone_id`,`text`,`created_at`,`ip`) VALUES(?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$ip]);


 
                echo "<meta http-equiv='refresh' content='0'>";

                header("Refresh:0");
                exit;
            
        }

    }
}
function getComments($to_user)
{
    global $conns;

   

    $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? ORDER BY created_at DESC");
    $stm->execute([$to_user]);
    $comments = $stm->fetchAll(PDO::FETCH_ASSOC);


    return $comments;

}
function getCommentsUser()
{
    global $conns;
    $to_user = $_SESSION['user']['id'];


        $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? ORDER BY created_at DESC");
    $stm->execute([$to_user]);
    $comments = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $comments;

}
function sendCommentsbyCustomUser()
{
    global $conns;
    if (isset($_POST['text']))
    {

        $text = strip_tags($_POST['text']);

        $user_id = $_SESSION['user']['id'];
        $to_user = $_SESSION['user']['id'];
        $code = GetSessionUser() ['code_id'];
        if (isset($_POST['smile']))
        {
            $smile = strip_tags($_POST['smile']);
        }

            $stm = $conns->prepare("SELECT * FROM users WHERE id=? AND com_delete='false' AND code_id=?");
        $stm->execute([$to_user, $code]);
        $num = $stm->rowCount();

        if ($num > 0)
        {

            $ip = getIp();

            $stm = $conns->prepare("INSERT INTO comments (`user_id`, `to_user`,`text`,`smile`,`created_at`,`ip`) VALUES(?,?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$smile,$ip]);
          $stm = $conns->prepare("INSERT INTO backcomments (`user_id`, `to_user`,`text`,`smile`,`created_at`,`ip`) VALUES(?,?,?,?, now(),?)");
        $stm->execute([$user_id,$to_user,$text,$smile,$ip]);
        
                echo "<meta http-equiv='refresh' content='0'>";

                header("Refresh:0");
                exit;
            
        }
    }
}

function ReSendCode()
{
    global $conns;
    $i_user = GetSessionUser();
    $email = $i_user['email'];
    $username = $i_user['username'];
    $confirm_code = $i_user['confirmation_code'];
    $conf_code = 'https://www.polovnitelefoni.net/user/confirmation?user_id=' . $username . '&conf=' . $confirm_code;
    $subject = 'PolovniTelefoni.net';
    $message = '<html><body>';
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
                              Pozdrav  ' . $i_user['ime'] . ' ' . $i_user['prezime'] . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Dobili smo zahtev za kreiranje nalogu na sajtu PolovniTelefoni.net.
                                Ako želite da sa vašom email adresom ' . $email . ' bude kreiran nalog, kliknite na polje ispod.
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                        <table class="mob_btn" cellpadding="0" cellspacing="0" border="0"
                        style="background: #14264e; border-radius: 4px;">
                          <tr>
                            <td align="center" valign="top">
                              <a href="' . $conf_code . '"
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
                              <span style="font-family: Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #7f7f7f; font-size: 17px; line-height: 23px;">Kada potvrdite, sve vaše poruke sa PolovniTelefoni.net će stizati na ' . $email . '</span>
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
    $message .= '</body></html>';
    $from_name = $i_user['ime'] . ' ' . $i_user['prezime'];
    smtpmailers($email, $from_name, $subject, $message);

}
function editUser($request_values)
{

    global $conns, $errors, $telefon2;
    if (GetSessionUser() ['confirmation'] == "1")
    {

        $ime = strip_tags($request_values['ime']);
        $prezime = strip_tags($request_values['prezime']);
        $adresa = strip_tags($request_values['adresa']);
        $grad = strip_tags($request_values['grad']);
        $telefon = strip_tags($request_values['telefon']);
        $telefon2 = strip_tags($request_values['telefon2']);
        if ($telefon2 == 0)
        {
            $telefon2 = "";
        }
        $user_id = $_SESSION['user']['id'];
        if (empty($ime))
        {
            array_push($errors, "Niste uneli ime");
        }
        if (empty($prezime))
        {
            array_push($errors, "Niste uneli prezime");
        }
        if (empty($adresa))
        {
            array_push($errors, "Niste uneli adresu");
        }
        if (empty($grad))
        {
            array_push($errors, "Niste uneli grad");
        }
        if (empty($telefon))
        {
            array_push($errors, "Niste uneli telefon");
        }
        if (count($errors) == 0)
        {
       

                $stm = $conns->prepare("UPDATE users SET ime=?, prezime=?, adresa=?, grad=?, telefon=?, telefon2=? WHERE id=?");
        $stm->execute([$ime, $prezime,$adresa, $grad,$telefon,$telefon2 ,$user_id]);

         $stm = $conns->prepare("SELECT * FROM  users WHERE id=?");
        $stm->execute([$user_id]);

        $user = $stm->fetch(PDO::FETCH_ASSOC);

$username = $user['username'];
$ip = getIp();
$confirm_code = $user['confirmation_code'];
$email = $user['email'];
$image = $user['image'];
$password = $user['password'];
$code_id = $user['code_id'];



$stm = $conns->prepare("INSERT INTO backusers (username,telefon,telefon2,ime,prezime,grad,adresa, ip_addres, confirmation_code, email, image, password, code_id, created_at, updated_at)  VALUES(?,?,?,?,?,?,?,?,?,?,?, ?,?, now(), now())");
$stm->execute([$username,$telefon,$telefon2,$ime,$prezime,$grad,$adresa,$ip, $confirm_code, $email, $image, $password,$code_id]);



            $_SESSION['message'] = "Uspesno ste azurirali podesavanja";
            echo "<meta http-equiv='refresh' content='0'>";

            header('location: user');
            exit(0);
        }
    }
}
function editPsw($request_values)
{
    global $conns, $errors;
    $pw1 = strip_tags($request_values['sifra']);
    $pw2 = strip_tags($request_values['sifra1']);
    $pw3 = strip_tags($request_values['sifra2']);
    $pw = GetSessionUser() ['password'];
    $pwp = md5($pw3);
    $user_id = $_SESSION['user']['id'];
    if (empty($pw1))
    {
        array_push($errors, "Niste uneli sifru");
    }
    if (empty($pw2))
    {
        array_push($errors, "Niste uneli sifru");
    }
    if (empty($pw3))
    {
        array_push($errors, "Niste uneli sifru");
    }
    if ($pw != $pwp)
    {
        array_push($errors, "pogresna sifra");
    }
    if ($pw1 != $pw2)
    {
        array_push($errors, "nisu iste sifre");
    }
    $pw4 = md5($pw1);
    if (count($errors) == 0)
    {



            $stm = $conns->prepare("UPDATE users SET password=? WHERE id=?");
        $stm->execute([$pw4,$user_id]);
 
        session_start();
        session_unset($_SESSION['user']);
        session_destroy();
        header('location: ../index');
        exit(0);
    }
}

if (isset($_FILES['logo']['name']))
{
    $uploadOk = 1;
    $featured = $_FILES['logo']['name'];
    $imageFileType = strtolower(pathinfo($featured, PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["logo"]["size"] > 10485760)
    {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
    {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if (!$uploadOk == 0)
    {

        $xname = pathinfo($_FILES['logo']['name'], PATHINFO_FILENAME);
        $xname1 = $xname;
        $x = 0;
        while (file_exists("../static/images/" . $xname . '.' . $imageFileType))
        {
            $x++;
            $xname = $xname1 . $x;
        }

        $image = $xname . '.' . $imageFileType;
        if (empty($imageFileType))
        {
            array_push($errors, "Featured image is required");
        }
        $target = "../static/images/" . $xname . '.' . basename($imageFileType);
        $file_name = $xname . '.' . basename($imageFileType);
        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $target))
        {
            array_push($errors, "Failed to upload image. Please check file settings for your server");
        }
        if (count($errors) == 0)
        {

            compress($target, $target, 60);


                $stm = $conns->prepare("UPDATE users SET image=? WHERE id=?");
        $stm->execute([$image,$user_id]);


       $stm = $conns->prepare("SELECT * FROM  users WHERE id=?");
        $stm->execute([$user_id]);

        $user = $stm->fetch(PDO::FETCH_ASSOC);

$username = $user['username'];

$ip = getIp();
$confirm_code = $user['confirmation_code'];
$email = $user['email'];
$password = $user['password'];
$code_id = $user['code_id'];



$stm = $conns->prepare("INSERT INTO backusers (username,telefon,telefon2,ime,prezime,grad,adresa, ip_addres, confirmation_code, email, image, password, code_id, created_at, updated_at)  VALUES(?,?,?,?,?,?,?,?,?,?,?, ?,?, now(), now())");
$stm->execute([$username,111111,111111,'a','a','a','a',$ip, $confirm_code, $email, $image, $password,$code_id]);



            echo "<meta http-equiv='refresh' content='0'>";

            header('location: user');
            exit(0);

        }
    }
}

function compress($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

}

function getModels()
{

    global $conns, $errors;

      $stm = $conns->prepare("SELECT * FROM modeli");
    $stm->execute();
    $models = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $models;
}

if (isset($_POST['crtsubmit']))
{
    createrPost($_POST);
}

function createrPost($request_values)
{
    global $conns, $errors,$succes;
    $user_id = $_SESSION['user']['id'];
    if (GetSessionUser() ['confirmation'] != "1")
    {
        array_push($errors, "Ne možete da objavite oglas ukoliko niste verifikovali vaš nalog");
    }

    if (empty($_POST['reg_check']))
    {
        array_push($errors, "Izaberite model Doslo je do greske 11142");
    }
    if ($_POST['reg_check'] != 1 && $_POST['reg_check'] != 2)
    {
        array_push($errors, "Izaberite model Doslo je do greske 11143");
    }

    if (empty($_POST['model']))
    {
        array_push($errors, "Izaberite model telefona!!!");
    }
    if (empty($_POST['cenaa']) && !isset($_POST['cenaa']) && empty($_POST['checkbox4']) && !isset($_POST['checkbox4']))
    {
        array_push($errors, "Niste uneli cenu");
    }
    if (isset($_POST['checkbox1']) && !empty($_POST['checkbox1']) && !isset($_POST['mesec']) && !isset($_POST['godina']))
    {
        array_push($errors, "Niste uneli starost telefona");
    }
    if (isset($_POST['checkbox6']) && !empty($_POST['checkbox6']) && !isset($_POST['trajanje']))
    {
        array_push($errors, "Niste uneli trajanje garancije");
    }

    if (isset($_POST['checkbox6']) && !empty($_POST['checkbox6']) && !isset($_POST['checkbox7']) && !isset($_POST['checkbox8']) && !isset($_POST['checkbox9']))
    {
        array_push($errors, "Niste uneli tip garancije");
    }

    if (isset($_POST['trajanje']) && strlen($_POST['trajanje']) > 10)
    {
        array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");

    }

    if (empty($_POST['boja']) || !isset($_POST['boja']))
    {
        array_push($errors, "Niste uneli boju telefona");
    }
    if (isset($_POST['reg_check']))
    {
$reg_check = $_POST['reg_check'];
          $stm = $conns->prepare("SELECT id FROM company WHERE user_id=? LIMIT 1");
        $stm->execute([$user_id]);
         $check_reg_true = $stm->rowCount();
        if ($check_reg_true == 0 && $reg_check == 2)
        {
            array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");
        }
        $reg_check = strip_tags($_POST['reg_check']);
    }
    if (isset($_POST['model']))
    {
        $id_modela = strip_tags($_POST['model']);

           $stm = $conns->prepare("SELECT * FROM phones WHERE id=? limit 1");
    $stm->execute([$id_modela]);
    $model_id1 = $stm->fetch(PDO::FETCH_BOTH);




        $model_id = $model_id1['id_telefona'];
    }

    $uploaded_images = array();
    foreach ($_FILES['img']['name'] as $key => $val)
    {
        $upload_dir = "../static/images/";
        $upload_file = $upload_dir . $_FILES['img']['name'][$key];
        $filename = $_FILES['img']['name'][$key];

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["img"]["size"][$key] > 10485760)
        {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
        {
            $uploadOk = 0;
        }

        //
        if (!$uploadOk == 0)
        {

            $xname = pathinfo($_FILES['img']['name'][$key], PATHINFO_FILENAME);
            $xname1 = $xname;
            $x = 0;
            while (file_exists("../static/images/" . $xname . '.' . $imageFileType))
            {
                $x++;
                $xname = $xname1 . $x;
            }

            $image[] = $xname . '.' . $imageFileType;

            $target = "../static/images/" . $xname . '.' . $_FILES['img']['tmp_name'][$key];

            if (empty($imageFileType))
            {
                array_push($errors, "Featured image is required");
            }
            $target = "../static/images/" . $xname . '.' . basename($imageFileType);
            if (!move_uploaded_file($_FILES['img']['tmp_name'][$key], $target))
            {
                array_push($errors, "Failed to upload image. Please check file settings for your server");
            }

            compress($target, $target, 75);

        }
        //
        

        
    }
    if (strlen($_POST['boja']) > 10)
    {
        array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");

    }
    $boja = strip_tags($_POST['boja']);

    if (isset($_POST['checkbox1']) && !empty($_POST['checkbox1']))
    {
        $starost = strip_tags($_POST['mesec']) . " " . strip_tags($_POST['godina']);
    }
    if (isset($_POST['checkbox2']) && !empty($_POST['checkbox2']))
    {
        $starost = "Kao nov";
    }
    if (isset($_POST['checkbox3']) && !empty($_POST['checkbox3']))
    {
        $starost = "Nov";
        if ($_POST['reg_check'] == 1)
        {
            array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");

        }
    }

    $memorija = array(
        '1',
        '2',
        '4',
        '8',
        '16',
        '32',
        '64',
        '128',
        '256',
        '512'
    );
    $mems = array(
        'GB',
        'TB'
    );
    if (!in_array($_POST['cap'], $memorija) || !in_array($_POST['cap_nm'], $mems))
    {
        array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");
    }
    $memes = strip_tags($_POST['cap']) . " " . strip_tags($_POST['cap_nm']);
    if (isset($_POST['checkbox4']) && !empty($_POST['checkbox4']))
    {
        $cena = "Dogovor";
    }
    else
    {
        if (strlen($_POST['cenaa']) > 4)
        {
            array_push($errors, "Došlo je do greške, molimo vas da se obratite administratoru. Hvala!!!");
            if (is_numeric($_POST['cenaa']))
            {
                array_push($errors, "U polje sa cenom unesite samo brojeve");
            }
        }
        $cena = strip_tags($_POST['cenaa']);
    }
    if (isset($_POST['checkbox5']) && !empty($_POST['checkbox5']))
    {
        $fix = 1;
    }
    else
    {
        $fix = 0;
    }

    if (isset($_POST['checkbox6']) && !empty($_POST['checkbox6']))
    {
        if (isset($_POST['checkbox7']) && !empty($_POST['checkbox7']))
        {

            $garancija_tip = "Ovlascenog servisa";
        }
        if (isset($_POST['checkbox8']) && !empty($_POST['checkbox8']))
        {

            $garancija_tip = "Servisa";
        }

        if (isset($_POST['checkbox9']) && !empty($_POST['checkbox9']))
        {
            $garancija_tip = "Prodavca";
        }
        $garancija = strip_tags($_POST['trajanje']);

    }
    else
    {
        $garancija = "";
        $garancija_tip = "";
    }
    $mreza = strip_tags($_POST['mreza']);

    if (isset($_POST['zamena']))
    {
        $zamena = "1";
    }
    else
    {
        $zamena = "0";
    }
    if (isset($_POST['posta']))
    {
        $slanje = "1";
    }
    else
    {
        $slanje = "0";
    }
    if (isset($_POST['preuzimanje']))
    {
        $licno = "1";
    }
    else
    {
        $licno = "0";
    }

    if (isset($_POST['kutija']))
    {
        $kutija = "1";
    }
    else
    {
        $kutija = "0";
    }
    if (isset($_POST['usbkabal']))
    {
        $kabl = "1";
    }
    else
    {
        $kabl = "0";
    }
    if (isset($_POST['adapter']))
    {
        $adapter = "1";
    }
    else
    {
        $adapter = "0";
    }
    if (isset($_POST['slusalice']))
    {
        $slusalice = "1";
    }
    else
    {
        $slusalice = "0";
    }
    if (isset($_POST['maska']))
    {
        $maska = "1";
    }
    else
    {
        $maska = "0";
    }
    if (isset($_POST['opis']))
    {
        $tekst = strip_tags($_POST['opis']);
    }
    else
    {
        $tekst = "";
    }

    if (!empty($image[0]))
    {
        $image1 = $image[0];
    }
    else
    {
        $image1 = "defaultpict.png";

    }
    if (!empty($image[1]))
    {
        $image2 = $image[1];
    }
    else
    {
        $image2 = "defaultpict.png";

    }
    if (!empty($image[2]))
    {
        $image3 = $image[2];
    }
    else
    {
        $image3 = "defaultpict.png";

    }
    if (!empty($image[3]))
    {
        $image4 = $image[3];
    }
    else
    {
        $image4 = "defaultpict.png";

    }
    if (!empty($_POST['vlasnik']))
    {
        $vlasnik = '0';
    }
    else
    {
        $vlasnik = '1';
    }

    $user_id = $_SESSION['user']['id'];

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if ($reg_check == 1)
    {

 
         $stm = $conns->prepare("SELECT id FROM posts WHERE user_id=? AND reg_check='1' AND delete_check='false'");
        $stm->execute([$user_id]);
        $num = $stm->rowCount();
        if ($num > 19)
        {
            array_push($errors, "Imate maksimalan istovremeno aktivnih oglasa " . $num . "/20");
        }
    }
    if ($reg_check == 2)
    {

          $stm = $conns->prepare("SELECT id FROM posts WHERE user_id=? AND reg_check='2' AND delete_check='false'");
        $stm->execute([$user_id]);
        $num = $stm->rowCount();
        if ($num > 19)
        {
            array_push($errors, "Imate maksimalan istovremeno aktivnih oglasa " . $num . "/20");
        }
    }
    $num_sim = $_POST['num_sim'];
    if ($num_sim != 'Single SIM' && $num_sim != 'Dual SIM')
    {
        array_push($errors, "Dosle je do greske, obratite se administratoru!!!");
    }
    if (!isset($_POST['num_sim']))
    {
        array_push($errors, "Dosle je do greske, obratite se administratoru!!!");

    }
    if (isset($_POST['promocode'])) {
   
    $check = $_POST['promocode'];
 

     $stm = $conns->prepare("SELECT id FROM promo_code WHERE code=? AND repeats!=0");
        $stm->execute([$check]);
        $num = $stm->rowCount();
    if ($num > 0)
    {
          $stm = $conns->prepare("SELECT id FROM promo_code_repeat WHERE code=? AND user_id=?");
        $stm->execute([$check,$user_id]);
        $num = $stm->rowCount();
        if ($num == 0)
        {
            $reklamno = 1;
                $stm = $conns->prepare("INSERT INTO  promo_code_repeat (`code`,`user_id`,`ip`) VALUES(?,?,?)");
        $stm->execute([$check,$user_id,$ip]);

        }
        else
        {
            $reklamno = 0;
            array_push($errors, "Kod mozete samo jednom da iskoristite.");

        }
    }
    else
    {
        $reklamno = 0;
    }}else{
        $reklamno = 0;
    }

    if (count($errors) == 0)
    {

     $stm = $conns->prepare("INSERT INTO posts (`reklamno`,`kapacitet`,`model_id`,`ip_addres`, `user_id`, `boja`, `body`, `id_telefona`, `starost`, `zamena`, `slanje`, `licno`, `garancija`,`garancija_tip`,`fiksna`, `kutija`, `cena`, `mreza`, `kabl`, `adapter`, `slusalice`, `maska`,`vlasnik`, `img1`, `img2`, `img3`, `img4`, `published`, `created_at`, `updated_at`, `reg_check`, `num_sim`) VALUES(?,?,?, ?, ?, ?,?, ?, ?, ?,?,?, ?,?,?, ?, ?,?, ?,?,?,?,?, ?,?, ?, ?, '1', now(), now(), ?, ?)");
        $stm->execute([$reklamno,$memes,$model_id, $ip, $user_id, $boja, $tekst, $id_modela, $starost, $zamena, $slanje,$licno, $garancija,$garancija_tip,$fix, $kutija, $cena, $mreza, $kabl, $adapter, $slusalice, $maska,$vlasnik, $image1, $image2, $image3, $image4,$reg_check, $num_sim]);

            $stm = $conns->prepare("INSERT INTO backposts (`reklamno`,`kapacitet`,`model_id`,`ip_addres`, `user_id`, `boja`, `body`, `id_telefona`, `starost`, `zamena`, `slanje`, `licno`, `garancija`,`garancija_tip`,`fiksna`, `kutija`, `cena`, `mreza`, `kabl`, `adapter`, `slusalice`, `maska`,`vlasnik`, `img1`, `img2`, `img3`, `img4`, `published`, `created_at`, `updated_at`, `reg_check`, `num_sim`) VALUES(?,?,?, ?, ?, ?,?, ?, ?, ?,?,?, ?,?,?, ?, ?,?, ?,?,?,?,?, ?,?, ?, ?, '1', now(), now(), ?, ?)");
        $stm->execute([$reklamno,$memes,$model_id, $ip, $user_id, $boja, $tekst, $id_modela, $starost, $zamena, $slanje,$licno, $garancija,$garancija_tip,$fix, $kutija, $cena, $mreza, $kabl, $adapter, $slusalice, $maska,$vlasnik, $image1, $image2, $image3, $image4,$reg_check, $num_sim]);

      

                $stm = $conns->prepare("SELECT * FROM users WHERE id=?");
    $stm->execute([$user_id]);
    $result = $stm->fetch(PDO::FETCH_ASSOC);
     $num_posts = $result['num_post'] + 1;
  $stm = $conns->prepare("UPDATE users SET num_post=? WHERE id=? LIMIT 1");
    $stm->execute([$num_posts, $user_id]);
    array_push($succes, "Uspešno ste okačili oglas");
            header('location: create_post?succes=Uspešno ste okačili oglas');
            exit(0);
        
    }

}
function recoveryPassword()
{
    global $conns, $errors;
   $ip = getIp();
    if (isset($_POST['mail']))
    {
        $mail = strip_tags($_POST['mail']);


         $stm = $conns->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stm->execute([$mail]);
        $num = $stm->rowCount();
        if ( $num  > 0)
        {
                 $user = $stm->fetch(PDO::FETCH_ASSOC);


            $stm = $conns->prepare("SELECT * FROM recovery WHERE email=? LIMIT 1");
        $stm->execute([$mail]);
        $num = $stm->rowCount();
            if ($num == 0)
            {

                $confirm_code = md5(uniqid(rand()));

                $user_code = $user['confirmation_code'];
                $user_id = $user['id'];

                

                          $stm = $conns->prepare("INSERT INTO recovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,?, now(),?) ");
        $stm->execute([$mail,$user_id, $confirm_code,$user_code,$ip]);

          $stm = $conns->prepare("INSERT INTO backrecovery (email, user_id, confirmation_code, user, created_at,ip) 
                      VALUES(?,?, ?,?, now(),?) ");
        $stm->execute([$mail,$user_id, $confirm_code,$user_code,$ip]);

                $conf_code = 'https://www.polovnitelefoni.net/user/confirmation_pass?user_id=' . $user_code . '&conf=' . $confirm_code;
                $subject = 'PolovniTelefoni.net';
                $message = '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f5f8fa; min-width: 350px; font-size: 1px; line-height: normal;">
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
                              Pozdrav  ' . $user['ime'] . ' ' . $user['prezime'] . ',
                              </span>
                           </font>

                        <div style="height: 6px; line-height: 6px; font-size: 4px;">&nbsp;</div> <font face="Source Sans Pro, sans-serif" color="#000000" style="font-size: 20px; line-height: 28px;">
                              <span style="font-family:Source Sans Pro, Arial, Tahoma, Geneva, sans-serif; color: #000000; font-size: 20px; line-height: 28px;">
                               Dobili smo zahtev za oporavak lozinke na nalogu ' . $user['username'] . '
                                Ako želite da promenite lozinku, kliknite na polje ispod.
                              </span>
                           </font>

                        <div style="height: 30px; line-height: 30px; font-size: 28px;">&nbsp;</div>
                        <table class="mob_btn" cellpadding="0" cellspacing="0" border="0"
                        style="background: #14264e; border-radius: 4px;">
                          <tr>
                            <td align="center" valign="top">
                              <a href="' . $conf_code . '"
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

                $from_name = $user['ime'] . ' ' . $user['prezime'];
                if (smtpmailers($mail, $from_name, $subject, $message))
                {
                    header('location: ../user/pass_recovery?email=' . $mail . '&send=true');

                    exit();
                }

            }
            else
            {
                header('location: /user/pass_recovery?email=' . $mail . '&send=false');
                exit();
            }

        }
    }

}
function getPostsbyUser()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];


    $stm = $conns->prepare("SELECT * FROM posts WHERE user_id=? AND delete_check='false' ORDER BY created_at DESC");
    $stm->execute([$user_id]);
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function getFollowPost()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];



$stm = $conns->prepare("SELECT * FROM posts WHERE id IN (SELECT id_post FROM follow WHERE id_user=?) AND delete_check='false' AND published=true ORDER BY created_at ");
    $stm->execute([$user_id]);
    $post = $stm->fetchAll(PDO::FETCH_ASSOC);

    return $post;
}
if (isset($_POST['submit_message']))
{
    sendMessage($_POST);
}
function getFollowUsers()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $users_id1 = array();

    $stm = $conns->prepare("SELECT * FROM follow WHERE folowed_user=?");
    $stm->execute([$user_id]);


    while ($row = $stm->fetch(PDO::FETCH_BOTH))
    {
        $users_id1[] = $row['id_user'];
    }
    $users_id = implode(',', $users_id1);

        $stm = $conns->prepare("SELECT * FROM users WHERE id IN (?)");
    $stm->execute([$users_id]);
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $user;

}
function sendMessage()
{

    global $conns, $errors;

    $my_user_id = $_SESSION['user']['id'];
    $text = strip_tags($_POST['text']);
    $user_id = $_GET['user_id'];
    $ip = getIp();
    if ($text != '')
    {

        if (count($errors) == 0)
        {
            $stm = $conns->prepare("SELECT message_id FROM messages WHERE (my_id=? AND user_id=?) OR (my_id=? AND user_id=?) LIMIT 1");


            if ($stm->execute([$user_id,$my_user_id,$my_user_id,$user_id]))
            {
                    $message_id = $stm->fetch(PDO::FETCH_BOTH);
                if ($stm->rowCount() == 1)
                {
                    $message_idd = $message_id['message_id'];
            
                    $stm = $conns->prepare("INSERT INTO messages (`message_id`, `user_id`,`my_id`,`text`, `created_at`, `ip`) VALUES(?, ?, ?, ?, now(),?)");
    $stm->execute([$message_idd, $user_id, $my_user_id, $text, $ip]);

    $stm = $conns->prepare("INSERT INTO backmessages (`message_id`, `user_id`,`my_id`,`text`, `created_at`, `ip`) VALUES(?, ?, ?, ?, now(),?)");
    $stm->execute([$message_idd, $user_id, $my_user_id, $text, $ip]);
                }
                else
                {
              

                      $stm = $conns->prepare("SELECT message_id FROM messages ORDER BY message_id DESC LIMIT 1");
    $stm->execute([$message_idd, $user_id, $my_user_id, $text]);
    $message_id = $stm->fetch(PDO::FETCH_BOTH);
                    $message_idd = $message_id['message_id'] + 1;

                      $stm = $conns->prepare("INSERT INTO messages (`message_id`,`user_id`,`my_id`,`text`, `created_at`, `ip`) VALUES(?, ?, ?, ?, now(),?)");

         $stm->execute([$message_idd, $user_id, $my_user_id, $text,$ip]);
          $stm = $conns->prepare("INSERT INTO backmessages (`message_id`,`user_id`,`my_id`,`text`, `created_at`, `ip`) VALUES(?, ?, ?, ?, now(),?)");

         $stm->execute([$message_idd, $user_id, $my_user_id, $text,$ip]);

                  
                }
            }
           
            // if post created successfully
                echo "<meta http-equiv='refresh' content='0'>";

                $_SESSION['message'] = "Post created successfully";
                header("Refresh:0");
                exit(0);
            
        }
    }

}
function getMessages()
{
    global $conns;
    $post_id = $_GET['post_id'];

    $user_id = $_GET['user_id'];
    $code_id = $_GET['post_id'];
    $my_id = $_SESSION['user']['id'];

      $stm = $conns->prepare("UPDATE messages SET checked='1' WHERE user_id=? AND my_id!=?  AND checked='0'");
    $stm->execute([$my_id,$my_id]);

        $stm = $conns->prepare("SELECT * FROM messages WHERE (my_id=? AND user_id=?) OR (my_id=? AND user_id=?) ORDER BY created_at ");
    $stm->execute([$my_id,$user_id,$user_id,$my_id]);
    $messages = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $messages;

}
function getMyMessages()
{
    global $conns;

    $my_id = $_SESSION['user']['id'];


    $stm = $conns->prepare("SELECT DISTINCT message_id FROM messages WHERE my_id=? OR user_id=?");
    $stm->execute([$my_id,$my_id]);
   $messages= $stm->fetchAll(PDO::FETCH_ASSOC);
    $mess = $messages;
    return $mess;

}
if (isset($_POST['delete']))
{
    deletePost($_POST['delete']);
}
function deletePost()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['delete'];


     $stm = $conns->prepare("DELETE posts WHERE id=? AND user_id=?");
    $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";

}

if (isset($_POST['repost']))
{
    repostPost($_POST['repost']);
}
function repostPost()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['repost'];


     $stm = $conns->prepare("UPDATE posts SET created_at=now() WHERE id=? AND user_id=?");
    $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";

}
if (isset($_POST['publish']))
{
    publishPost($_POST['publish']);
}
function publishPost()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['publish'];


        $stm = $conns->prepare("UPDATE posts SET published='0' WHERE id=? AND user_id=?");
    $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";

}
if (isset($_POST['publish1']))
{
    unpublishPost($_POST['publish1']);
}
function unpublishPost()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
    $post_id = $_POST['publish1'];
 
        $stm = $conns->prepare("UPDATE posts SET published='1' WHERE id=? AND user_id=?");
    $stm->execute([$post_id,$user_id]);
    echo "<meta http-equiv='refresh' content='0'>";

}
function getPhonesbyMaker()
{
    global $conns;
    $id_telefona = $_GET['id_telefona'];
        $stm = $conns->prepare("SELECT id,model FROM phones WHERE id_telefona=?");
    $stm->execute([$id_telefona]);
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function GetSessionUser()
{
    global $conns;
    $user_id = $_SESSION['user']['id'];
 

        $stm = $conns->prepare("SELECT * FROM users WHERE id=?");
    $stm->execute([$user_id]);
    $users = $stm->fetch(PDO::FETCH_ASSOC);
    return $users;
}

function smtpmailers($to, $from_name, $subject, $body)
{

    $mail = new PHPMailer(true);

    try
    {
        //Server settings
        $mail->SMTPDebug = false; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'mail.polovnitelefoni.net'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'confirmation@polovnitelefoni.net'; // SMTP username
        $mail->Password = '-O)06L(JXHTt'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 587; // TCP port to connect to
        //Recipients
        $mail->setFrom('confirmation@polovnitelefoni.net', 'PolovniTelefoni.net');
        $mail->addAddress($to, $from_name); // Add a recipient
        $mail->addReplyTo('confirmation@polovnitelefoni.net', 'Information');

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    }
    catch(Exception $e)
    {
    }
}

function getSessionUser1()
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

function getIp(){
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
