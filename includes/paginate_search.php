<?php
$errors = [];

global $errors;
        $a1 = array('54','102','150','198');
$a[0] = array('54','108','144','198');
$a[1] = array('56','104','152','200');
$a[2] = array('56','98','154','196');
$a[3] = array('54','102','150','198');
$a[4] = array('50','100','150','200');


if (isset($_COOKIE['zoom'])) {
  $zoom = $_COOKIE['zoom'];
}else{
    $zoom = '83';}
    $ids = array('55.1', '62', '70.9', '83', '100');
    for ($i=0; $i < 5 ; $i++) { 
        if ($ids[$i] == $zoom) {
           $a1 = $a[$i];
        }
    }
if (isset($_GET['num_post'])) {


        if ($_GET['num_post'] != 0 && $_GET['num_post'] != 1 && $_GET['num_post'] != 2 && $_GET['num_post'] != 3 ) {
            $num_row2 = 2;
        }else{
                $num_row2 = $_GET['num_post'];
        }
}else{
    $num_row2 = 2;
}
$num_row = $a1[$num_row2];

$num_rows = $postss;
$num_pag = ceil($num_rows / $num_row);

if (isset($_GET['page_id']) && !empty($_GET['page_id'])) {

$get_num = $_GET['page_id'];
}else{
  $get_num = 1;
}

if ($get_num > $num_pag) {
array_push($errors, "Broj oglasa pri pretrazi 0");
$num_pages=0;

}else{

if ($num_pag < 8) {
    $num_pages = $num_pag;
    $i = 1;
}else{
    if ($get_num < 6) {
   $num_pages = 8;
   $i = 1;
}
    if ($num_pag - 5 < $get_num) {
    $num_pages = $num_pag;
   $i = $num_pag - 8;
}else{


if ($get_num  >= 6) {
    $i = $get_num - 4;
    $num_pages = $get_num + 4;
}}}}

 ?>
<div style="      display: table;
    margin: 0px auto;" href="#" ><a class="left_pagin paginate"  id="1"><i class="fas fa-angle-double-left"></i></a>


    <div id="demo" style=" display: inline-table;"></div>

     <a  id="<?php echo $num_pag ?>" class="right_pagin paginate"><i class="fas fa-angle-double-right"></i></i></a>

 </div>
 <script type="text/javascript">
  $(document).ready(function () {

    
var num_pages = <?php echo $num_pages; ?>;
var num_i = <?php echo $i; ?>;
    var text = "";
    var i;
    for (i = num_i; i <= num_pages; i++) {
        text += "<a style='cursor:pointer;' class='paginate click_pgon' id='"+ i +"'>" + i + "</a>";
    }
    document.getElementById("demo").innerHTML = text;

var get_num = "#" + <?php echo $get_num; ?>;
$(get_num).css({"background-color":"#14264e","color":"white"});


 
    $(".paginate").on('click',function () {
        var href = window.location.href.substring(0, window.location.href.indexOf('?'));
        var qs = window.location.href.substring(window.location.href.indexOf('?')+1, window.location.href.length);
        
        var newParam = 'page_id=' + $(this).attr("id");
        if (qs.indexOf('page_id=') == -1) {
            if (window.location.href.indexOf('?') == -1) {
                qs = ''
            }
            else {
                qs = qs + '&'
            }
            qs = qs + newParam;

        }
        else {
            var start = qs.indexOf("page_id=");
            var end = qs.indexOf("&", start);
            if (end == -1) {
                end = qs.length;
            }
            var curParam = qs.substring(start, end);
            qs = qs.replace(curParam, newParam);
        }
        window.location.replace(href + '?' + qs);
       
       
    });
    });

 </script>


