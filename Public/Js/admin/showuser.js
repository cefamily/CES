// JavaScript Document
$(document).ready(function(e) {

});

function admin_init(){
	var strdata=teamname.split(' | ');
	var i;
	for(i=0;i<strdata.length;i++){
		$("#admin_team").append("<span class='label label-primary'>"+strdata[i]+"</span>");
	}
}