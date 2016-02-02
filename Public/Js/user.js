// JavaScript Document
$(document).ready(function(e) {
    $("#reg_btn").click(function(){
		var pwd1=$("#userpwd").val();
		var pwd2=$("#userpwd2").val();
		if(pwd1!==pwd2){
			alert("两次密码不一致");
			return false;
		}
		});
	$("#userform").submit(function(){
		var pwd1=$("#userpwd").val();
		$("#userpwd").val(CryptoJS.MD5(pwd1));
		});
	$("#randimg").click(function(e) {
        $(this).attr("src",rand);
    });
});