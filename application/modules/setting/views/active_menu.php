<script>
	$(function(){
		var act_link="<?=substr(trim($this->module), 0, -1);?>";	
		/*$(".tab-content #ops").addClass("tabopen").addClass("active")*/
		$(".menu-bar").find("a[href*='"+act_link+"']").parents("li:last").find("a:first").addClass("active");
		$("#tabber li a[href='#setting']").closest("li").addClass("tabopen");
		$("#tabber li a[href='#setting']").closest("li").addClass("active");
		//$("#tabber").find("li.active").removeClass("tabopen active");
		$("#mn_setting").parent().addClass("tabopen active");
		$("#setting").addClass("tabopen active")
		
		var currLink=window.location.pathname;
		var removeStr=currLink.split("<?=$this->module?>")[1];
		currLink=act_link+"/"+removeStr;
		var arrCurrLink=currLink.split("/");
		//arrCurrLink.shift();
		//arrCurrLink.shift()
		currLink=arrCurrLink.join("/");
		currLink = currLink.replace(/^\/|\/$/g, '');
		
		$("#setting").find("a[href*='"+currLink+"']").not(".nav > li > a").prepend("<i class='icon-ok'></i>");
		$("#setting").find("a[href*='"+currLink+"']").addClass("active");
		$("#mb-separator").addClass("pengaturan");
	});
	
</script>

