// JavaScript Document
/**
* JQuery分页插件
* 作者:呆萌
* 最后编辑日期：2016年2月4日01:07:16
* github:democyann
*/

(function($){
	$.fn.Jpager=function(options){
		var defaults={
			url:'',
			view:3	
			}
		var opts = $.extend(defaults, options);
		
		opts.view=opts.view<3?3:opts.view;
		
		var count =parseInt($(this).attr('count'));
		var now =parseInt($(this).attr('now'));
		var temp;
		if(count<opts.view){
			temp=count;
		}else{
			temp=opts.view;
			}
		
		$(this).append("<li><a href='"+opts.url+"/page/1"+"'>1&laquo;</a></li>");
		if(now<opts.view){
			var i;
			for(i=1;i<=temp;i++){
				if(i==now){
					$(this).append("<li class='active'><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
				}else{
					$(this).append("<li><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
				}
			}
			if(count>opts.view){
				$(this).append("<li><a href='"+opts.url+"/page/"+i+"'>...</a></li>");
			}
			
		}else{
			if(count>opts.view){
				if(now>(count-opts.view)){
					$(this).append("<li><a href='#'>...</a></li>");
					var i;
					for(i=count-opts.view;i<=count;i++){
						if(i==now){
							$(this).append("<li class='active'><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
						}else{
							$(this).append("<li><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
						}
					}
				}else{
						$(this).append("<li><a href='#'>...</a></li>");
						var i;
						for(i=now-1;i<now+opts.view;i++){
							if(i==now){
								$(this).append("<li class='active'><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
							}else{
								$(this).append("<li><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
							}
						}
						$(this).append("<li><a href='#'>...</a></li>");
				}				
			}else{
				var i;
				for(i=1;i<=temp;i++){
				if(i==now){
					$(this).append("<li class='active'><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
				}else{
					$(this).append("<li><a href='"+opts.url+"/page/"+i+"'>"+i+"</a></li>");
				}
			}
			}
		}
		
		
		$(this).append("<li><a href='"+opts.url+"/page/"+count+"'>&raquo;"+count+"</a></li>");
		}
})(jQuery);