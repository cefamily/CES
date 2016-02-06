// JavaScript Document
$(document).ready(function(e) {
var teamid;
	$(".team_iteam").click(function(){
			$("#groupdrop").html($(this).html());
			teamid=$(this).attr("teamid");
		});
});