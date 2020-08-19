
var sendAjaxbtn=document.getElementById('sendAjax');
sendAjaxbtn.addEventListener('click', function() {
	var form = $('#createUserForm');
	var data = $("#createUserForm").serialize();
	//console.log(data);

var itemsPost={data:data,responseType: 'json'};
axios.post($(form).attr("action"), data)
         .then(function(res) {
var aca="pepepe";
          /* if(res.status==201) {
             mensaje.innerHTML = ' El Post ha sido guardado bajo el id: ' + res.data.id;
           }*/
         })
         .catch(function(err) {
           console.log(err);
         })
         .then(function() {
var aca="aaaaaaaaa";
         //  loading.style.display = 'none';
         });



	return false;
});
