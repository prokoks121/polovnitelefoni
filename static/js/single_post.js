
  
	$(document).ready(function(){
		$("#imgdiv").click(function(){
			$("#img1").css({"display":"none"});
			$("#img2").css({"display":"none"});
			$("#img3").css({"display":"none"});
			$("#img4").css({"display":"none"});
			$("#imgdiv").css({"display":"none"});
	});
	$("#slika1").click(function(){
$("#img1").css({"display":"block","position": "fixed","top": "50%","left": "50%","transform": "translate(-50%, -50%)",});
$("#imgdiv").css({"position": "fixed","width": "100%","height": "100%","background-color": "rgba(0, 0, 0, 0.66)","display":"block","z-index":"10"});
});
	$("#slika2").click(function(){
$("#img2").css({"display":"block","position": "fixed","top": "50%","left": "50%","transform": "translate(-50%, -50%)"});
$("#imgdiv").css({"position": "fixed","width": "100%","height": "100%","background-color": "rgba(0, 0, 0, 0.66)","display":"block","z-index":"10"});
});
	$("#slika3").click(function(){
$("#img3").css({"display":"block","position": "fixed","top": "50%","left": "50%","transform": "translate(-50%, -50%)"});
$("#imgdiv").css({"position": "fixed","width": "100%","height": "100%","background-color": "rgba(0, 0, 0, 0.66)","display":"block","z-index":"10"});
});
	$("#slika4").click(function(){
$("#img4").css({"display":"block","position": "fixed","top": "50%","left": "50%","transform": "translate(-50%, -50%)"});
$("#imgdiv").css({"position": "fixed","width": "100%","height": "100%","background-color": "rgba(0, 0, 0, 0.66)","display":"block","z-index":"10"});
});
});

