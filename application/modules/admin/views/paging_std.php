<?php $page_link=$this->pagination->create_links(); ?>

<!--<div class="row pagination_bar box_quote">-->
<div class="rows well well-sm">
    <div class="col-md-4 col-lg-4">
            <div style="vertical-align:middle;line-height:25px">
            <?php 
                $to_page=$this->pagination->cur_page * $this->pagination->per_page;
                $from_page=($to_page-$this->pagination->per_page+1);
                if($from_page>$to_page):
                    $from_page=1;
                    $to_page=$from_page;
                endif;
                $total_rows=$this->pagination->total_rows;
                if($to_page>1):
                    echo "Displaying : ".$from_page." - ".$to_page." of ". 
                            $this->pagination->total_rows." entries";
                endif;
                if($to_page<=1):
                    echo "Displaying : 1 of ". 
                            $this->pagination->total_rows." entries";		
                endif;		
            ?>
             </div>
    </div><!-- end span 6-->
    
    
    <div class="col-md-8 col-lg-8">

        <span class="pull-right">
        <?php
        $arrPerPageSelect=array(
                3=>3,
                10=>10,
                25=>25,
                50=>50,
                -1=>"All"
            );
            $pp=$perPage;
        ?>
        Rows/page:<?=form_dropdown("pp_select",$arrPerPageSelect,$pp,"id='pp_select' class='input-mini'")?>	
        <input type="hidden" id="pp" name="pp" value="" />
        </span>

        <span class="pull-right">
            <div style="margin-top:-23px; margin-right:10px">
            <?php echo $page_link; ?>
            </div>
        </span>

	</div><!-- end span 8-->
<div class="clearfix" style="height:24px"></div>
</div><!-- end class well -->



<script>
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href*='"+act_link+"']").parent("li").addClass("active");
	
		$(".pagination .active a").click(function(e){
			e.preventDefault();
		});
		
		$("#pp_select").change(function(){
			var pp=parseInt($(this).find("option:selected").val());
			if(pp<0){
				location=document.URL.split("?")[0];
				return false;
			}
			get_query();
		});
		
		$("#frm-search").submit(function(e){
			e.preventDefault();
			get_query();
		});
	});
	
	
	function get_query(){
			var q =$("#q").val()||"";
			var perPage=$("#pp_select option:selected").val();
			$("#pp").val(perPage);
			var pp =$("#pp").val()||"";
			
			
			var data=[];
			if(q){
				data.push("q="+q);
			}
			
			if((pp)&&(pp!=25)){
				data.push("pp="+pp);
			}
			var param='';
			if(data){
				param="?"+data.join("&");
			}
			var url=document.URL.split("?")[0];
			location=url+param;
	}
</script>