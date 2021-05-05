<?php
include '../config.php';
global $conns;
    $selStudent = $_POST['theOption'];

    $stm = $conns->prepare("SELECT * FROM phones WHERE id_telefona=?");
    $stm->execute([$selStudent]);
 $num_rows_returned = $stm->rowCount();

    $r = '<select class="send"
     id="id_send" name="model">
        <option value="0">Izaberi model</option>
    ';
if ($num_rows_returned > 0) {
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $r = $r . '<option value="' .$row['id']. '">' . $row['model'] . '</option>';
        }
    } else {
        $r = '<p>No student by that name on staff</p>';
    }
    echo $r;
    ?>
    <script type="text/javascript">
  
        
                  $('#id_send').change(function() {
                    var sel_stud = $('#id_send').val();
                    $.ajax({
                        type: "POST",
                        url: "selector3.php",
                        data: 'theOption=' + sel_stud,
                        success: function(whatigot) {
                            $('#LaDIV1').html(whatigot);
                        } 
                    }); 
                }); 
           
    </script>