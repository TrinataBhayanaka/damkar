<div class="footer">
  
 
  	
        <div class="row" style="margin-top:-25px;">
          <div class="col-md-8"></div>
          <div class="col-md-4 copyright">
            &copy; Copyright <?=date("Y");?> <a href="http://brwa.or.id"><b>Kebencanaan</b></a>, All rights reserved.  
          </div>
        </div>
   
  
</div>
</body>
</html>
<script>
$(document).ready(function () {
	var act_link="<?=$this->page_active?>";
	$(".main-menu>li").find('a[href="'+act_link+'"]').parents("li").addClass("active");
	
	$("#q_button").click(function(){
		$("#search_form").submit();
	});
});
</script>
<script src="assets/js/jquery-rrss.js"></script>