<?
	$right = (cek_array($this->right_page))?true:false;
?>
<div style="background:#4a7dab; margin-top:0px; border-bottom:1px solid #ddd; padding:15px">
<div class="container">
	<div class="row">
    	<div class="col-md-8">
        	<h1 class="page-title2"><?=$this->page_title?></h1>
        </div>
    	<div class="col-md-4">
        	<? if (cek_array($this->breadcrumb)) { ?>
            <ul class="breadcrumb">
              <? foreach ($this->breadcrumb as $k=>$v) { ?>
              <? if ($v=='#') { ?>
              <li class="active"><?=$k?></li>
              <? } else { ?>
              <li><a href="<?=$v?>"><?=$k?></a></li>
              <? } ?>
              <? } ?>
            </ul>
            <? } ?>
        </div>
        <!--<div class="col-md-4">
			<div style="color:#ddd; line-height:34px"><label>Pengguna baru? Register</label> <a href="user/register" class="btn btn-success">disini</a></div>
        </div>-->
    </div>
</div>
</div>
<div class="container pages">
	<!--<div class="row">
    	<div class="col-md-12">
          <h1 class="page-title"><?=$this->page_title?></h1>
    	</div>
	</div>-->
    <div class="row">
    	<div class="col-md-<?=$right?'8':'12'?> ">
            	<?=$data['content']?>
                <? modules::load('wg/web')->social_ftg('BRWA - '.$this->page_title,true);?>
    	</div>
        <? if ($right) {  ?>
        <div class="col-md-4">
                <?=$list[0]['content'];?>
        </div>
        <? } ?>
	</div>
</div>

<br />

<script>  
$(document).ready(function () {
//	$("a[href='pages/about']").parent().addClass("active");
})
</script>
<style>
strong {
	font-weight: bold; 
}

em {
	font-style: italic; 
}

table {
	border-collapse: separate;
	box-shadow: inset 0 1px 0 #fff;
	line-height: 20px;
	text-align: left;
}	
td {
	padding: 5px 10px;
	border-bottom:1px solid rgba(204,204,204,1);
	position: relative;
	transition: all 300ms;
}


</style>
