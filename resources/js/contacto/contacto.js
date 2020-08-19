var btnsend=document.getElementById('btnsend');
btnsend.addEventListener('click', function() {

var form= $("#contactoform");
var data= $(form).serialize();
$(".error").html("");
$("#btnsend").attr("disabled","disabled");
$("#message").html("");
axios.post(form.attr("action"),data)
	.then(function(res){
		if(!res.data.sucess){
			$.each(res.data.errors,function(i,v){
				$("#error"+i).html(v);

			})
		} else {
			$("#message").html("mensaje enviado correctamente");
		}
		
	})
	.catch(function(){})
	.then(function(){
		$("#btnsend").removeAttr("disabled");
	});
return false;
});
