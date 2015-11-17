<!--<ul class="nav nav-list">
    <li class="active"><a href="<?=$this->module?>">All</a></li>
    <?php if(cek_array($arrCategory)):?>
	<?php foreach($arrCategory as $x=>$val):?>
    <li><a href="<?=$this->module?>index/<?=$val["idx"]?>"><?php echo $val["category"]?> <span  style="vertical-align:top;right:10px;font-weight:bold">(<?=$val["total"]?>)</span></a>
    </li>
                    
    <?php endforeach;?>
    <?php endif;?>
</ul>
-->
<? $allCatTotal=$total?>
<ul class="span12">
	<li style="display:inline-block;margin-left:10px;margin-bottom:20px;min-width:300px">
        	<div class="cat-heading" style="font-size:1.1em;font-weight:bold;">
            <a href="<?=$this->module?>"><i class="icon-folder-close icon-white"></i>   All Categories <span>( <?=$allCatTotal?> )</span></a>
            </div>
            <div class="cat-content">
            	All Categories
            </div>
    </li>
	<? foreach($arrCategory as $x=>$val):?>
    	<li style="display:inline-block;margin-left:10px;margin-bottom:20px;min-width:300px">
        	<div class="cat-heading" style="font-size:1.1em;font-weight:bold;">
            <a class='a_cat_link' href="<?=$this->module?>index/" data-cat_id="<?=$val["idx"]?>"><i class="icon-folder-close icon-white"></i>  <?=$val["category"]?> <span>(<?=$val["total"]?>)</span></a>
            </div>
            <div class="cat-content" style="height:auto;">
            	<?=$val["description"]?>
            </div>
        </li>
    <? endforeach;?>
</ul>

<script>
	$(function(){
		$(".a_cat_link").click(function(e){
			e.preventDefault();
			$("#cat_id").val($(this).data("cat_id"));
			get_query();
		});
	});
</script>