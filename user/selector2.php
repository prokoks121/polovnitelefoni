<?php
include '../config.php';
global $conns;
if ($_POST["theOption"] != "" ) {

    $selStudent = $_POST["theOption"];
 
if (is_array($selStudent)) {
    $selStudent1 = implode(", ", $_POST["theOption"]);
   
}else{
   $selStudent1 = $selStudent;
}


  $stm = $conns->prepare("SELECT * FROM phones WHERE id_telefona IN (?) ORDER BY id_telefona ASC, datum DESC");
    $stm->execute([$selStudent1]);

   $num_rows_returned = $stm->rowCount();
    $r = '
    ';
   if ($num_rows_returned > 0) {
        while ($row =$stm->fetch(PDO::FETCH_ASSOC)) {
            $r =$r .  '<label  style="margin-top: 1px;margin-bottom: 0px !important;padding: 5px 0px 5px 10px;font-size: 17px;"   class="lael"><p style="margin-left: 30px;">'.$row['model'].'
    </p><input id="datum3"  class="intcheck custom-select-option-checkboxs" type="checkbox" name="toys1[]" onchange="toggleFillColor(this);" value="'.$row['id'].'">
      <span style="width: 20px;height: 20px ; margin-top: 5px;margin-left: 10px;" id="datum3" class="checkmark"></span>
</label></div>';
                         
        }
    } else {
        $r = '<p>No student by that name on staff</p>';
    }
 
echo $r;
}else{
    echo "";
}
?>
