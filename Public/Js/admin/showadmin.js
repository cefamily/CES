// JavaScript Document
$(document).ready(function(e) {
    $("#addadmin").click(function(){
		$("#modal2").modal('hide');
		var userid=$("#adminid").val();
		$.ajax({
			url:path+"/addadmin_ajax",
			type:"POST",
			dataType:"JSON",
			data:{"userid":userid},
			success: function(data){
				if(data=="OK"){
					alert('添加成功');
				}else{
					alert(data);
				}
				
				},
			error:function(ex){
				$('body').html(ex.responseText);
				
				}
			});	
		});
});