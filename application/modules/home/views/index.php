<div style="background:#ddd;">
<!-- Carousel
================================================== -->
<div id="dslider" class="carousel slide">
  <div class="carousel-inner">
  	<?php if (is_array($slider_list)) { ?>
    <?php 
		foreach($slider_list as $k=>$v) {
			$split = preg_split("/#/",$v['others']);
			$active = ($k<1)?" active":"";
	?>
    <div class="item<?=$active;?>">
      <img src="assets/image/pages/<?=$v['image'];?>" alt="">
      <div class="container">
        <div class="carousel-caption" style="max-width:1000px">
          <?php if ($v['title']) { ?><h1><?=$v['title'];?></h1><? } ?>
          <?php if ($v['clip']) { ?><p class="lead"><?=$v['clip'];?></p><? } ?>
          <?php if ($split[1]) { ?><a class="btn btn-primary" href="<?=$split[1];?>"><?=$split[0];?></a><? } ?>
        </div>
      </div>
    </div>
    <?php
		}}
	?>
  </div>
  <a class="carousel-control left hidden-xs" href="#dslider" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right hidden-xs" href="#dslider" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->
</div>

<div class="section hilite" style="">
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-sm-12">
            <div class="tickerhead" style="padding:5px 0px;">
                <div class="tickerspacer2" title="Ticker">INFORMASI</div>
                <div class="tag-lalulintas" id="lalulintaslist">
                <ul style="height: 125px;" class="list-unstyled">
                    <li class="tickerlist"><strong>Indonesia: Medan 5%, Yogyakarta 10%, Bandung 10%, DKI Jakarta 2%</strong></li>
                    <?php 
						if (is_array($scroller_list)) { 
						foreach($scroller_list as $k=>$v) {
					?>
                    <li class="tickerlist"><strong><?=$k?></strong> (<strong><?=$v['Total']?></strong>) &bull; TEREGISTRASI: <strong><?=$v['Teregistrasi']?></strong> &bull; TERVERIFIKASI: <strong><?=$v['Terverifikasi']?></strong> &bull; TERSERTIFIKASI: <strong><?=$v['Tersertifikasi']?></strong></li>
                    <? }} ?>
                </ul>
                </div>
            </div>
        </div>
    	<div class="col-md-4">
        	<? $url = 'http://'.$_SERVER['HTTP_HOST'];  $uri=$_SERVER['REQUEST_URI']; ?>
			<? $style = ($page_title)?'padding:20px 0 10px':'padding:3px 0 0;' ?>
            <style>
            .rrssb-icon i {
                font-size:18px; color:#fff; line-height:30px
            }
            </style>
                <div class="share-container clearfix" style="background:transparent; margin:-10px 0 -15px ">
                    <span class="label" style="color:#fff">PENCARIAN:</span>
                    <div class="row">
                    	<div class="col-md-9">
                        	<form id="search_form" class="search_form" action="search" method="get">
                    		<div class="form-group has-success has-feedback" style="margin-bottom:0; margin-top:2px">
                              <input style="background:#BF3330; color:#ccc; border:1px solid transparent" type="text" class="form-control" id="q" name="q" aria-describedby="inputSuccess2Status">
                              <span class="glyphicon glyphicon-search form-control-feedback" style="color:#CCCCCC; cursor:pointer" id="q_button" aria-hidden="true"></span>
                            </div>
                            </form>
                    	</div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>


<div class="section" style="padding-bottom:100px">
<div class="container">
    <div class="row">
    	<div class="col-md-8">
        	<div class="row">
                <div class="col-md-6">
                	<h3 class="title"><a href="news">BERITA </a></h3>
                	<?php 
						if (is_array($news_list)) { 
						//$news_first = array_shift($news_list);
					?>
                    	<!--<div>
                            <h4 class="media-heading"><a href="news/read/<?=$news_first['idx'];?>" class="news-title"><?=$news_first['title'];?></a></h4>
                            <img src="assets/image/news/<?=$news_first['image']?>" class="img-thumbnail" style="width:100%" />
                           	<?=$news_first['clip']?>
                        </div>-->
					  <?php 
                        foreach($news_list as $k=>$v) { 
                            $image = ($v['image'])?$v['image']:"blank.png";
                            $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
                      ?>
                      <!--media-->
                      <div class="media">
                        <!--<div class="media-left" style="width:100px;">
                            <img src="assets/image/news/<?=$image;?>" class="avatar media-object img-polaroid" alt="2013" style=" width:90px;height:90px;margin:1px" />
                        </div>-->   
                        <div class='media-body'>
                            <?=$category;?>
                            <div style="color:grey"><?=$v['date_formatted'];?></div>
                            <div>
                                <h5 class="media-heading"><a href="news/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
                                <?=substr($v['clip'],0,150)."...";?>
                            </div>
                        </div>
                     </div>
                     <!--end media-->
         			<? }} ?>
                    
                    <!-- RSS -->
                	<h3 class="title"><a href="">SINDIKASI BERITA</a> &nbsp;<span><i class="fa fa-rss-square" style="color:orange"></i></span></h3>
                    <div id="rss_container">
                    </div>
					<!--<?php if (is_array($rss)) { ?>
                      <?php 
                        foreach($rss as $k=>$v) { 
                      ?>
                          <div class="media">
                            <div class='media-body'>
                                <div style="color:grey"><?=$k;?> &bull; <span>[<?=$v['src']?>]</span></div>
                                <div>
                                    <h5 class="media-heading"><a href="<?=$v['link'];?>" target="_blank" class="news-title"><?=$v['title'];?></a></h5>
                                </div>
                            </div>
                         </div>
                      <? } ?>
                      <? } ?>-->
                    <!-- end RSS -->
                </div>
                <div class="col-md-6">
                	<h3 class="title"><a href="articles">ARTIKEL </a></h3>
                	<?php 
						if (is_array($article_list)) { 
						//$news_first = array_shift($news_list);
					?>
                    	<!--<div>
                            <h4 class="media-heading"><a href="news/read/<?=$news_first['idx'];?>" class="news-title"><?=$news_first['title'];?></a></h4>
                            <img src="assets/image/news/<?=$news_first['image']?>" class="img-thumbnail" style="width:100%" />
                           	<?=$news_first['clip']?>
                        </div>-->
					  <?php 
                        foreach($article_list as $k=>$v) { 
                            $image = ($v['image'])?$v['image']:"blank.png";
                            $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
                      ?>
                      <!--media-->
                      <div class="media">
                        <div class="media-left" style="width:100px;">
                            <img src="assets/image/pages/<?=$image;?>" class="avatar media-object img-polaroid" alt="2013" style=" width:90px;height:90px;margin:1px" />
                        </div>   
                        <div class='media-body'>
                            <?=$category;?>
                            <div style="color:grey"><?=$v['date_formatted'];?></div>
                            <div>
                                <h5 class="media-heading"><a href="articles/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
                                <?=substr($v['clip'],0,100)."...";?>
                            </div>
                        </div>
                     </div>
                     <!--end media-->
         			<? }} ?>
                </div>
            </div>
        	
        </div>
        <div class="col-md-4">
				<h3 class="title"><a href="articles">STATISTIK KASUS BENCANA 2015 &nbsp;</a></h3>
          		
        </div>
    </div>
</div>
</div>

<?php 
	if (is_array($partner_list)) { 
?>
<div class="section" style="border:1px solid #ddd; border-width:1px 0 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<? foreach ($partner_list as $k=>$v) { ?>
                <a href="linkdir/get_link/<?=$v['idx'];?>" target="_blank" class="friend_link" title="<?=$v['name']?>"><img class="desaturates" src="assets/image/pages/<?=$v['image']?>" style="height:40px" /></a>
				<? } ?>
            </div>
        </div>
    </div>
</div>
<? } ?>

<script>
  $(function () {
	$('#myCarousel').carousel();
	$('#lalulintaslist').realm({
		slideShow:true,
		slideEffect: 'slide-vertical', //pilihan
		slideInterval: 5000,
		onHoverStop:false,
		continuous:true,
		showControlBar:false,
		showData:false,
		showNumberBar:false,
		onSlideEnd:function() {  }
	});    
	$('#newsTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	}).focus(function() {
		$(this).blur();
	});
	
	$("#rss_container").html("Loading Sindikasi...");
	$("#rss_container").load('wg/web/brwa_rss');
  })
</script>