// JavaScript Document
$(document).ready(function(e) {
    $("#add").click(function(){
		var name=prompt("请输入要添加的组名");
		$.ajax({
			url:path+"/addTeam_ajax",
			type:"POST",
			dataType:"JSON",
			data:{"teamname":name},
			success: function(data){
					if(data=="OK"){
						alert("添加成功");
						window.location=path+"/showlist";
					}else{
						alert(data);
					}
				},
			error:function(ex){
				console.log(ex);
			}
			});
		
		});
	$(".del").click(function(){
		var teamid=$(this).attr("tid");
		var tname=$(this).attr("tname");
		var text=prompt("请输入要删除的组名,用于确认删除");
		
		if(text==tname){
				$.ajax({
			url:path+"/deleteTeam_ajax",
			type:"POST",
			dataType:"JSON",
			data:{"teamid":teamid},
			success: function(data){
					if(data=="OK"){
						alert("删除成功");
						location.reload();
					}else{
						alert(data);
					}
				},
			error:function(ex){
				alert('发生未知错误,请联系管理解决');
				console.log(ex);
			}
			});	
		}else{
			alert("验证失败，取消操作");
		}
		});
		
		$("#addmember").click(function(){
			$("#modal1").modal('hide');
			var userid=$("#userid").val();
			$.ajax({
				url:path+"/addMember_ajax",
				type:"POST",
				dataType:"JSON",
				data:{"userid":userid,"teamid":teamid},
				success:function(data){
					if(data=="OK"){
						alert("添加成功");
						location.reload();
					}else{
						alert(data);
					}
					},
				error:function(ex){
				alert('发生未知错误,请联系管理解决');
				console.log(ex);
			}
				
				});
			
			});
			
		$(".delmember").click(function(){
			var userid=$(this).attr("uid");
			var a=confirm("您真的要移除此成员吗？");
			if(!a) return;
			
			$.ajax({
				url:path+"/delMember_ajax",
				type:"POST",
				dataType:"JSON",
				data:{"userid":userid,"teamid":teamid},
				success:function(data){
					if(data=="OK"){
						alert("删除成功");
						location.reload();
					}else{
						alert(data);
					}
					},
				error:function(ex){
				alert('发生未知错误,请联系管理解决');
				console.log(ex);
			}
				
				});
			});
		
		$("#addadmin").click(function(){
			$("#modal2").modal('hide');
			var adminid=$("#adminid").val();
			$.ajax({
				url:path+"/addTeamAdmin_ajax",
				type:"POST",
				dataType:"JSON",
				data:{"adminid":adminid,"teamid":teamid},
				success:function(data){
					if(data=="OK"){
						alert("添加成功");
						location.reload();
					}else{
						alert(data);
					}
					},
				error:function(ex){
				alert('发生未知错误,请联系管理解决');
				$('body').html(ex.responseText);
				console.log(ex);
			}
				
				});
			
			});
			
		$(".deladmin").click(function(){
		var adminid=$(this).attr("uid");
			var a=confirm("您真的要移除此成员的管理权限吗？");
			if(!a) return;
			
			$.ajax({
				url:path+"/delTeamAdmin_ajax",
				type:"POST",
				dataType:"JSON",
				data:{"adminid":adminid,"teamid":teamid},
				success:function(data){
					if(data=="OK"){
						alert("操作成功");
						location.reload();
					}else{
						alert(data);
					}
					},
				error:function(ex){
				alert('发生未知错误,请联系管理解决');
				console.log(ex);
			}
				
				});
			});
});