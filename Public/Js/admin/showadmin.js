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
					location.reload();
				}else{
					alert(data);
				}
				
				},
			error:function(ex){
				$('body').html(ex.responseText);
				
				}
			});	
		});
		
	$(".deladmin").click(function(){
		var a=confirm('您真的要移除此用户的管理权限吗？');
		if(!a) return;
		var userid=$(this).attr('uid');
		$.ajax({
			url:path+"/deladmin_ajax",
			type:"POST",
			dataType:"JSON",
			data:{"userid":userid},
			success: function(data){
				if(data=="OK"){
					alert('移除成功');
					location.reload();
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