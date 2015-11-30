<section class="page-header">
  <div class="container">

    <h1><?=$this->page_title?></h1>

    <!-- breadcrumbs -->
    <ol class="breadcrumb">
      <? foreach ($this->breadcrumb as $k=>$v) { ?>
        <? if ($v=='#') { ?>
          <li class="active"><?=$k?></li>
          <? } else { ?>
          <li><a href="<?=$v?>"><?=$k?></a></li>
        <? } ?>
      <? } ?>
    </ol><!-- /breadcrumbs -->

  </div>
</section>



<?
	//$right = (cek_array($this->right_page))?true:false;
?>

<section>
  <div class="container">

  <div class="row">
    <div class="col-md-<?=$right?'8':'12'?> ">

     <?php $data['content']?>
      <? modules::load('wg/web')->social_ftg('BRWA - '.$this->page_title,true);?>

    </div>
    <? if ($right) {  ?>
      <div class="col-md-4">
        <?=$list[0]['content'];?>
      </div>
    <? } ?>
  </div>

  </div>
</section>




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
