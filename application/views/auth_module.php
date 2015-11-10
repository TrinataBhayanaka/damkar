<? if($this->cms):?>
<script>
var right=<?=$this->cms->get_module_right_max($this->module)?>||0;
if(right==1){
	$(".right_full").addClass("disabled");
	$(".right_read").addClass("disabled");
	$(".right_write").addClass("disabled");
	//$(".right_full").remove();
	//$(".right_read").remove();
	//$(".right_write").remove();
}else if(right==2){
	$(".right_full").addClass("disabled");
	$(".right_write").addClass("disabled");
}else if(right==3){
	$(".right_full").addClass("disabled");
}else if(right==4){
		
}else{
	$(".right_full").addClass("disabled");
	$(".right_read").addClass("disabled");
	$(".right_write").addClass("disabled");
	$(".right_view").addClass("disabled");
}
</script>
<? endif;?>