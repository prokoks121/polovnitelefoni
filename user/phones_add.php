 <?php
include '../config.php';

global $conns;
if (isset($_POST['search_val'])) {
	
	$ser_vals = $_POST['search_val'];



    $stm = $conns->prepare("SELECT marka,model,id FROM phones WHERE id_telefona=? ORDER BY datum DESC");
    $stm->execute([$ser_vals]);

$num = $stm->rowCount();
$r='<select class="comse1" name="model" style="    width: 215px;    padding: 5px 20px 5px 5px;
    margin-left: 23px;
    margin-bottom: 10px;">
      <option value="0" disabled="disabled" selected>Izaberi model</option>';
if ($num > 0) {
 while ($all = $stm->fetch(PDO::FETCH_ASSOC)) {
            $r = $r . '<option value="'.$all['id'] .'">'. $all['model'] .'</option>';
        }

}
$r = $r."</select>";
echo $r;

}



 
?>
