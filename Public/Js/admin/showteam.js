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
						window.location=path+"/showlist";
					}else{
						alert(data);
					}
				},
			error:function(ex){
				console.log(ex);
			}
			});	
		}else{
			alert("验证失败，取消操作");
		}
		});
});