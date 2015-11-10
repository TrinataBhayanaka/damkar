<style>
.article h1 {
	font-size:large
}
</style>
<div class="subheader">
    <div class="container subheader-inner">
    	<h1>Articles</h1>
    </div>
</div>
<div class="container article" style="margin-bottom:20px">
<div class="row-fluid">
<div class="span8 content-page">
    	<ul class="breadcrumb" style="margin-left:0; margin-top:-10px">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="articles">Articles</a> <span class="divider">/</span></li>
            <li class="active">Read</li>
        </ul>
    <?php
		$others = preg_split("/#/",$data['others']);
		$author = str_replace("Author: ","",$others[0]);
		$ref = preg_split("/;/",$others[1]);
	?>
    <div class="row-fluid">
        <div class="span12">
          <h3 class="sub" style="border-bottom:2px solid #aaa"><?=$data['title'];?></h3>
           <div class="pull-left" style="color:grey"> <?=$data['date_formatted'];?>, <?=$others[0];?></div><br />
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
          <?php 
		  if (is_array($data)) {  
		  		$image_image = '<div  style="float:left;margin:10px 15px 15px 2px;">';
				$image_image .= '<span id="canvas_view"><canvas width="200" height="200" style="background-image:url(assets/image/pages/'.$data['image'].')"></canvas></span>';
				if ($data['image'] && $data['image_src']) $image_image .= '<div style="border-bottom:1px solid #ddd; width:196px; padding:2px; height:20px"><em style="font-size:x-small; color:#666; float:right">('.$data['image_src'].')</em></div>';
				if ($data['image'] && $data['image_title']) $image_image .= '<div style="width:196px; padding:2px; font-size:11px">'.$data['image_title'].'</div>';
				$image_image .= '</div>';
		  ?>
          <div class="row-fluid">
                <div class="span12">
                    </p>
                    <br />
                    <p>
                    <?=$image_image;?>
                    <?=$data['content'];?>
                    </p>
                    
                    <p style="border-top:1px solid #ccc; margin-top:40px">
                    <?php if (is_array($ref)) { ?>
                    Reference/Source
                    <ul style="margin-left:20px">
                    <?php
							foreach($ref as $k=>$v) {
					?>
                    	<li><?=$v;?></li>
                    <?php
							}} 
					?>
                    </p>
                </div>
            </div>
            <h3 class="sub" style="padding:2px; border-bottom:1px solid #aaa">Other Articles</h3>
 				<? modules::load('wg/web')->article_pages(false,$data["idx"]);?>
         <? } ?>
      </div>
    </div>
    <br />
</div><!--end span8-->
<div class="span4 right-page">
  <!-- AddThis Button BEGIN --
    <div class="addthis_toolbox addthis_default_style" style="width:350px; margin-bottom:50px">
    <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4d9b20db5979ef32" class="addthis_button_compact">Share</a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_5"></a>
    <span class="addthis_separator">|</span>
    <a class="addthis_button_facebook_like" fb:like:action="recommend" fb:like:layout="button_count"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4d9b20db5979ef32"></script>
    !-- AddThis Button END -->
	<div style="height:15px"></div>
	<? modules::load('wg/web')->incident();?>
    <? modules::load('wg/web')->right_menu();?>
    <? modules::load('wg/web')->news_pages();?>
</div>
</div>
<? modules::load('wg/comments')->comments_add($data["idx"],4);?>
<? modules::load('wg/comments')->comments_list2($data["idx"],4);?>
</div>
