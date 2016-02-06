// JavaScript Document
$(document).ready(function(e) {
var teamid;
	$(".team_iteam").click(function(){
			$("#groupdrop").html($(this).html());
			teamid=$(this).attr("teamid");
		});
	$("#resetpwd").click(function(){
		if(!confirm("您真的要重置此用户的密码吗？")) return;
		
		var restpwd=Math.round((Math.random()*10000)+1000);
		var md5var=CryptoJS.MD5((String)(restpwd)).toString();
		$.ajax({
			url:path+"/resetpwd_ajax",
			type:"POST",
			dataType:"JSON",
			data:{"userid":$("#userid").val(),"pwd":md5var},
			success:function(data){
				console.log(data);
				if(data=="OK"){
					$("#pwdbox").empty();
					$("#pwdbox").append("<div class='alert alert-info'>密码已经重置为"+restpwd+"</div>");					
				}else if(data=="TYPE_ERR"){
					$(this).html("您的权限不足")
				}else{
					$(this).html("重置失败，请重试")
				}
			},
			error:function(ex){
				console.log(ex);
			}
			});
	});
});