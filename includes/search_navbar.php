<?php
include '../config.php';

global $conns;
$lista = array();
if (isset($_POST['search_val'])) {
	$ser_val = '';
	$ser_vals = $_POST['search_val'];
	$sers = explode(' ', $ser_vals);
for ($i=0; $i < count($sers); $i++) { 
	if ($i != count($sers)-1) {
		array_push($lista, "%".$sers[$i]."%");
		$ser_val = $ser_val . " model LIKE ? AND ";
	}else{
		$ser_val = $ser_val . " model LIKE ? ";
				array_push($lista, "%".$sers[$i]."%");

	}
 	
 } 

 $stm = $conns->prepare("SELECT marka,model,id FROM phones WHERE $ser_val ORDER BY marka DESC, model DESC");
        $stm->execute($lista);
$num = $stm->rowCount();

$r='';
if ($num > 0) {
 while ($all = $stm->fetch(PDO::FETCH_ASSOC)) {
            $r = $r . "<a href='./single-phone/". $all['marka']."/" .$all['model']."?phone_id=" .$all['id']."' class='pretrazeno' style='text-align: left;
    font-size: 13px;
    padding: 8px 15px;'>". $all['marka']." " .$all['model']."</a>";
        }

}
echo $r;

}



 
?>
