<div style="background:#ddd; border-bottom:1px solid #bbb;">
<!-- Carousel
================================================== -->
<div id="dslider" class="carousel slide">
	<?php if (is_array($slider_list)) { ?>
	<ol class="carousel-indicators">
    <?php 
		$num = count($slider_list);
		for($i=0;$i<$num;$i++) {
	?>
    <li data-target="#dslider" data-slide-to="<?=$i;?>"></li>
    <?php
		}}
	?>
    </ol>
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

<div class="section" style="background:#9bd8d7;border:1px solid #ddd; border-width:1px 0">
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-sm-12">
            <div class="tickerhead" style="padding:5px 0px;">
                <div class="tickerspacer2" title="Ticker">STATISTIK</div>
                <div class="tag-lalulintas" id="lalulintaslist">
                <ul style="height: 125px;" class="list-unstyled">
                    <li class="tickerlist"><strong>Jumlah Wilayah Adat</strong> Terdaftar maupun Treverifikasi.</li>
                    <li class="tickerlist"><strong>Aceh</strong> &bull; TEREGISTRASI: <strong>614</strong> &bull; TERVERIFIKASI: <strong>727</strong> WA</li>
                    <li class="tickerlist"><strong>Sumatera Barat</strong> &bull; TEREGISTRASI: <strong>455</strong> &bull; TERVERIFIKASI: <strong>143</strong> WA</li>
                    <li class="tickerlist"><strong>Riau</strong> &bull; TEREGISTRASI: <strong>727</strong> &bull; TERVERIFIKASI: <strong>348</strong> WA</li>
                    <li class="tickerlist"><strong>Jambi</strong> &bull; TEREGISTRASI: <strong>533</strong> &bull; TERVERIFIKASI: <strong>233</strong> WA</li>
                    <li class="tickerlist"><strong>Sumatera Selatan</strong> &bull; TEREGISTRASI: <strong>770</strong> &bull; TERVERIFIKASI: <strong>246</strong> WA</li>
                    <li class="tickerlist"><strong>Bengkulu</strong> &bull; TEREGISTRASI: <strong>440</strong> &bull; TERVERIFIKASI: <strong>155</strong> WA</li>
                </ul>
                </div>
            </div>
        </div>
    	<div class="col-md-4">
        	<span style="color:#ddd">Pengguna baru? Register <a href="user/register" class="btn btn-primary">disini</a></span>
        </div>
    </div>
</div>
</div>
<script>
  $(function () {
    $('#newsTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	}).focus(function() {
		$(this).blur();
	})
  })
</script>
<div class="section" style="padding-bottom:100px">
<div class="container">
    <div class="row">
    	<div class="col-md-8">
        	<ul class="nav nav-tabs" role="tablist" id="newsTab" style="margin-top:3px">
              <li role="presentation" class="active"><a href="#brwa" aria-controls="brwa" role="tab" data-toggle="brwa"><h4><i class="fa fa-th-large"></i>&nbsp; Berita BRWA</h4></a></li>
              <li role="presentation"><a href="#terkait" aria-controls="terkait" role="tab" data-toggle="terkait"><h4><i class="fa fa-rss"></i>&nbsp; Berita Terkait</h4></a></li>
            </ul>
           <div class="tab-content" style="margin-top:30px">
           		<div role="tabpanel" class="tab-pane active" id="brwa">
          			<?php if (is_array($news_list)) { ?>
					  <?php 
                        foreach($news_list as $k=>$v) { 
                            $image = ($v['image'])?$v['image']:"blank.png";
                            $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
                      ?>
                      <!--media-->
                      <div class="media">
                        <div class="media-left" style="width:100px">
                            <img src="assets/image/news/<?=$image;?>" class="avatar media-object img-polaroid" alt="2013" style=" width:90px;height:90px;margin:1px" />
                        </div>   
                        <div class='media-body'>
                            <?=$category;?>
                            <div style="color:grey"><?=$v['date_formatted'];?></div>
                            <div>
                                <h4 class="media-heading"><a href="news/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h4>
                                <?=$v['clip'];?>
                            </div>
                        </div>
                     </div>
                     <!--end media-->
         			<? }} ?>
         		</div>
                <div role="tabpanel" class="tab-pane" id="terkait">
                    <?php if (is_array($rss)) { ?>
                      <?php 
                        foreach($rss as $k=>$v) { 
                      ?>
                      	<!--media-->
                          <div class="media">
                            <div class="media-left" style="width:100px;">
                            	<div class="media-left" style="width:90px; height:90px;text-align:center; vertical-align:middle; border:1px solid #eee">
                                <?=$v['src']?>
                                </div>
                            </div>   
                            <div class='media-body'>
                                <div style="color:grey"><?=$k;?></div>
                                <div>
                                    <h4 class="media-heading"><a href="<?=$v['link'];?>" target="_blank" class="news-title"><?=$v['title'];?></a></h4>
                                    <?=$v['description'];?>
                                </div>
                            </div>
                         </div>
                         <!--end media-->
                      <? } ?>
                      <? } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <h3 style="border-bottom:2px solid #ccc">Wilayah Adat</h3>
          		<? modules::load('wg/web')->incident();?>
				<? //modules::load('wg/web')->other_links();?>
                <? //modules::load('wg/web')->article_pages(1);?>
        </div>
    </div>
</div>
</div>

<div class="section" style="border:1px solid #ddd; border-width:1px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="http://www.climateandlandusealliance.org" target="_blank" class="friend_link" title="CLUA"><img class="desaturate" src="assets/images/logo_en.gif" style="height:40px" /></a>
                <a href="http://www.aman.or.id" target="_blank" class="friend_link" title="AMAN.OR.ID"><img class="desaturate" src="assets/images/Logo_AMAN_NEW.png" style="height:40px" /></a>
                <a href="http://www.redd-indonesia.org" target="_blank" class="friend_link" title="REDD"><img class="desaturate" src="assets/images/redd.png" style="height:40px" /></a>
                <a href="http://www.dinamof.co.id" target="_blank" class="friend_link" title="DMI"><img class="desaturate" src="assets/images/dinamof-profile2.png" style="height:40px" /></a>
                <a href="http://www.gerainusantara.com" target="_blank" class="friend_link" title="GeraiNusantara"><img class="desaturate" src="assets/images/logo-gerai-nusantara.jpg" style="height:40px" /></a>
            </div>
        </div>
    </div>
</div>


