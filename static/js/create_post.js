$(document).ready(function(){
           $("#checkbox1").prop("checked", true);
           $("#checkbox1").attr("disabled", true);
           $("#checkbox2").attr("disabled", false);
           if ($('#reg_check').val() == 2) {
           $("#checkbox3").attr("disabled", false);}else{
             $("#checkbox3").attr("disabled", true);
           }









		  $('#checkbox7').prop("disabled", true);
                  $('#checkbox8').prop("disabled", true);
                   $('#checkbox9').prop("disabled", true);
                   $('#trajanje').prop("disabled", true);

		$("#checkbox4").click(function(){
            if($(this).prop("checked") == true){
                 $('#cenaa').prop("disabled", true);
                  $('#checkbox5').prop("disabled", true);
                   $('#checkbox5').not(this).prop('checked', false);
            }
            else if($(this).prop("checked") == false){
               $('#cenaa').prop("disabled", false);
               $('#checkbox5').prop("disabled", false);
              
            }
        });



		$("#checkbox1").click(function(){
            if($(this).prop("checked") == true){
               
                $('#checkbox3').not(this).prop('checked', false);
                                $('#checkbox2').not(this).prop('checked', false);

           $(this).attr("disabled", true);
           $("#checkbox2").attr("disabled", false);
                 if ($('#reg_check').val() == 2) {
           $("#checkbox3").attr("disabled", false);}else{
             $("#checkbox3").attr("disabled", true);
           }



            }
        });
        $("#checkbox2").click(function(){
            if($(this).prop("checked") == true){
               
                $('#checkbox1').not(this).prop('checked', false);
                                $('#checkbox3').not(this).prop('checked', false);  
  $(this).attr("disabled", true);
           $("#checkbox1").attr("disabled", false);
                if ($('#reg_check').val() == 2) {
           $("#checkbox3").attr("disabled", false);}else{
             $("#checkbox3").attr("disabled", true);
           }


            }
        });
        $("#checkbox3").click(function(){
        if ($('#reg_check').val() == 2) {
       


            if($("#checkbox3").prop("checked") == true){
               
                $('#checkbox2').not(this).prop('checked', false);
                                $('#checkbox1').not(this).prop('checked', false);  
                                  $(this).attr("disabled", true);
           $("#checkbox2").attr("disabled", false);
           $("#checkbox1").attr("disabled", false);

}
            }
        });



          $("#checkbox6").click(function(){

            if($(this).prop("checked") == false){
               
                 $('#checkbox7').prop("disabled", true);
                  $('#checkbox8').prop("disabled", true);
                   $('#checkbox9').prop("disabled", true);
                   $('#trajanje').prop("disabled", true);
                   $('#checkbox7').not(this).prop('checked', false);
                   $('#checkbox8').not(this).prop('checked', false);
                   $('#checkbox9').not(this).prop('checked', false);
          
                       
            }
              if($(this).prop("checked") == true){
                    $('#checkbox7').prop("disabled", true);
                    $('#checkbox8').prop("disabled", false);
                    $('#checkbox9').prop("disabled", false);
                     $('#trajanje').prop("disabled", false);
                      $('.trajanje').css({"margin-top": "82px"});
 $("#checkbox7").prop("checked", true);

      $("#checkbox7").attr("disabled", true);
           $("#checkbox7").attr("disabled", false);
           $("#checkbox9").attr("disabled", false);

                   $("#checkbox7").click(function(){
                    if($(this).prop("checked") == true){
               
                                 $('#checkbox8').not(this).prop('checked', false);
                                $('#checkbox9').not(this).prop('checked', false);  
                                $('#trajanje').animate({marginTop: "82px"},"slow");

                                       $(this).attr("disabled", true);
           $("#checkbox8").attr("disabled", false);
           $("#checkbox9").attr("disabled", false);



            }
        });
                    $("#checkbox8").click(function(){
                    if($(this).prop("checked") == true){
               
                $('#checkbox7').not(this).prop('checked', false);
                                $('#checkbox9').not(this).prop('checked', false);  
                                $('#trajanje').animate({marginTop: "118px"},"slow");
$(this).attr("disabled", true);
           $("#checkbox7").attr("disabled", false);
           $("#checkbox9").attr("disabled", false);
            }
        });
        $("#checkbox9").click(function(){
            if($(this).prop("checked") == true){
               
                $('#checkbox8').not(this).prop('checked', false);
                                $('#checkbox7').not(this).prop('checked', false);  
                                $('#trajanje').animate({marginTop: "150px"},"slow");
                                $(this).attr("disabled", true);
           $("#checkbox7").attr("disabled", false);
           $("#checkbox8").attr("disabled", false);

            }
        });
              }
        });
  
 $(function() {
                $('#send').change(function() {
                    var sel_stud = $('#send').val();
                    $.ajax({
                        type: "POST",
                        url: "selector.php",
                        data: 'theOption=' + sel_stud,
                        success: function(whatigot) {
                            $('#LaDIV').html(whatigot);
                        } 
                    }); 
                }); 

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
            });
 
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgId = '#preview-'+$(input).attr('class').split(' ')[1];
                $(imgId).attr('src', e.target.result);
                var iconid = '#icon-'+$(input).attr('class').split(' ')[1];
                   $(iconid).css({"display" : "block"});

            }

            reader.readAsDataURL(input.files[0]);
        }
      }


      $(".file--input").change(function(){
        readURL(this);
      });
      
$("#imageClear1").on('click', function() { 
    $("#file--input").val(''); 
    $("#preview-img1").attr("src","../static/images/upload.png");
    $("#icon-img1").css({"display" : "none"});
});$("#imageClear2").on('click', function() { 
  $("#preview-img2").attr("src","../static/images/upload.png");
  $("#icon-img2").css({"display" : "none"});
    $("#file--input1").val(''); 
});$("#imageClear3").on('click', function() { 
  $("#preview-img3").attr("src","../static/images/upload.png");
  $("#icon-img3").css({"display" : "none"});
    $("#file--input2").val(''); 
});$("#imageClear4").on('click', function() { 
  $("#preview-img4").attr("src","../static/images/upload.png");
  $("#icon-img4").css({"display" : "none"});
    $("#file--input3").val(''); 
});



 });