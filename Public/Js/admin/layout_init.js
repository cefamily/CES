// JavaScript Document
$(document).ready(function(e) {
    $("#navbar_admin>li").removeClass("active");
	$("#navbar_admin>li").eq(item_index).addClass("active");
	if(admintype<3){
		$("#navbar_admin>li").eq(3).addClass("disenable");
		$("#navbar_admin>li").eq(4).addClass("disenable");
	}
});