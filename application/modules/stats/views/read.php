<div style="background:#4a7dab; margin-top:0px; border-bottom:1px solid #ddd; padding:15px">
<div class="container">
	<div class="row">
    	<div class="col-md-8">
        	<h1 class="page-title2">Berita BRWA</h1>
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
        <div class="col-md-4">
        </div>
    </div>
</div>
</div>
<div class="container pages" style="margin-bottom:20px">
<div class="row">
<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
          <h3 class="title"><?=$data['title'];?></h3>
           <div class="pull-left" style="color:grey; margin-top:-15px"> <?=$data['date_formatted'];?>, <?=$data['author'];?></div><br />
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
          <?php 
		  if (is_array($data)) {  
		  		if ($data['image']) {
					$image_image = '<div  style="float:left;margin:10px 10px 10px 2px;">';
					$image_image .= '<span id="canvas_view"><img width="300" height="300" src="assets/image/news/'.$data['image'].'" /></span>';
					if ($data['image'] && $data['image_src']) $image_image .= '<div style="border-bottom:1px solid #ddd; width:196px; padding:2px; height:20px"><em style="font-size:x-small; color:#666; float:right">('.$data['image_src'].')</em></div>';
					if ($data['image'] && $data['image_title']) $image_image .= '<div style="width:196px; padding:2px; font-size:11px">'.$data['image_title'].'</div>';
					$image_image .= '</div>';
				}
		  ?>
          <div class="row">
                <div class="col-md-12">
                    <p>
                    <?=$image_image;?>
                    <?=$data['content'];?>
                    </p>
					<? modules::load('wg/web')->social_ftg('BRWA - Berita: '.$data['title']);?>
                </div>
            </div>
              <h3 class="sub" style="padding:2px; border-bottom:1px solid #aaa">Berita Lain</h3>
 				<? modules::load('wg/web')->news_pages(false,$data["idx"]);?>

         <? } ?>
      </div>
    </div>
    <br />
</div><!--end span8-->
<div class="col-md-4">
    <? modules::load('wg/web')->brwa_wa();?>
    <? modules::load('wg/web')->article_pages(1);?>
</div>
</div>
<div class="row">
<div class="col-md-8 content-page">
<? //modules::load('wg/comments')->comments_add($data["idx"],4);?>
<? //modules::load('wg/comments')->comments_list2($data["idx"],4);?>
</div>
</div>
</div>
