<!-- REVOLUTION SLIDER -->
  <div class="slider fullwidthbanner-container roundedcorners">
    <!--
      Navigation Styles:
      
        data-navigationStyle="" theme default navigation
        
        data-navigationStyle="preview1"
        data-navigationStyle="preview2"
        data-navigationStyle="preview3"
        data-navigationStyle="preview4"
        
      Bottom Shadows
        data-shadow="1"
        data-shadow="2"
        data-shadow="3"
        
      Slider Height (do not use on fullscreen mode)
        data-height="300"
        data-height="350"
        data-height="400"
        data-height="450"
        data-height="500"
        data-height="550"
        data-height="600"
        data-height="650"
        data-height="700"
        data-height="750"
        data-height="800"
    -->
    <div class="fullwidthbanner" data-height="600" data-shadow="0" data-navigationStyle="preview2">
      <ul class="hide">
        <?php 
          if (is_array($slider_list)) { 
            foreach($slider_list as $k=>$v) {
        ?>
        <!-- SLIDE  -->
        <li data-transition="random" data-slotamount="1" data-masterspeed="1000" data-saveperformance="off" data-title="Slide <?=$k+1;?>">

          <img src="assets/themes/tmpl-byu/assets/images/1x1.png" data-lazyload="assets/image/pages/<?=$v['image'];?>" alt="" data-bgfit="cover" data-bgposition="center bottom" data-bgrepeat="no-repeat" />

          <div class="overlay dark-1"><!-- dark overlay [1 to 9 opacity] --></div>

          <div class="tp-caption customin ltl tp-resizeme large_bold_white"
            data-x="center"
            data-y="205"
            data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
            data-speed="800"
            data-start="1200"
            data-easing="easeOutQuad"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.01"
            data-endelementdelay="0.1"
            data-endspeed="1000"
            data-endeasing="Power4.easeIn" style="z-index: 10;">
            <?=$v['title'];?>
          </div>

          <div class="tp-caption customin ltl tp-resizeme small_light_white font-lato"
            data-x="center"
            data-y="295"
            data-customin="x:0;y:150;z:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
            data-speed="800"
            data-start="1400"
            data-easing="easeOutQuad"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.01"
            data-endelementdelay="0.1"
            data-endspeed="1000"
            data-endeasing="Power4.easeIn" style="z-index: 10; width: 100%; max-width: 750px; white-space: normal; text-align:center; font-size:20px;">
            <?=$v['clip'];?>
          </div>

        </li>
        <?php
          }}
        ?>

      </ul>

      <div class="tp-bannertimer"><!-- progress bar --></div>
    </div>
  </div>
  <!-- /REVOLUTION SLIDER -->


  <section>
    <div class="container">

      <h3 class="page-header weight-300 margin-top-100">
        <a href="#" data-toggle="tooltip" title="view more"><i class="fa fa-plus-square-o"></i></a> 
        <strong>Artikel</strong> Terbaru 
      </h3>

      <!-- THREE COLUMNS -->
      <div class="row">

      <?php 
        if (is_array($article_list)) { 
          foreach($article_list as $k=>$v) {
            $image = ($v['image'])?$v['image']:"blank.png";
            $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
      ?>
        <div class="col-md-4">

          <!-- article item -->
          <div class="item-box">
            <figure>
              <a class="item-hover" href="articles/read/<?=$v['idx'];?>">
                <span class="overlay color2"></span>
                <span class="inner">
                  <span class="block fa fa-plus fsize20"></span>
                  <strong>READ</strong> ARTICLE
                </span>
              </a>
              <img alt="" class="img-responsive" src="assets/image/pages/<?=$image;?>" width="263" height="147" />
            </figure>
            <div class="item-box-desc">
              <h4><?=$v['title'];?></h4>
              <small><?=$v['date_formatted'];?></small>
              <p><?=substr($v['clip'],0,100)."...";?></p>
            </div>
          </div>
          <!-- /article item -->

        </div>
      <?php
        }}
      ?>

      </div>
      
      <div class="row">

        <!-- first column -->
        <div class="col-md-6">

          <h3 class="page-header weight-300">
            <a href="#" data-toggle="tooltip" title="view more"><i class="fa fa-plus-square-o"></i></a>
            <strong>Berita</strong> Terkini
          </h3>

          <?php 
            if (is_array($news_list)) { 
              foreach($news_list as $k=>$v) {
                $image = ($v['image'])?$v['image']:"blank.png";
                $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
                      
          ?>

          <h4><a href="news/read/<?=$v['idx'];?>"><?=$v['title'];?></a></h4>
          <p>
            <?=substr($v['clip'],0,150)."...";?>
            <small class="block"><?=$v['date_formatted'];?></small>
          </p>

          <hr class="half-margins" /><!-- separator -->

          <?php
            }}
          ?>

        </div>

        <!-- second column -->
        <div class="col-md-6">

        <h3 class="page-header weight-300">
          <a href="#" data-toggle="tooltip" title="view more"><i class="fa fa-bar-chart"></i></a> 
          <strong>Statistik</strong> Bencana 2015  
        </h3>

        <div id="demo-morris-donut" style="height:312px"></div>

        </div>
      </div>

    </div>
  </section>

  <div class="text-center margin-top-30 margin-bottom-30">
    <div class="owl-carousel nomargin" data-plugin-options='{"items":6, "singleItem": false, "autoPlay": true}'>
      
      <?php 
        if (is_array($partner_list)) { 
          foreach($partner_list as $k=>$v) {
            $image = ($v['image'])?$v['image']:"foot_1.jpg";
      ?>
      <div>
        <a href="linkdir/get_link/<?=$v['idx'];?>" target="_blank">
          <img class="img-responsive" src="assets/image/pages/<?=$image?>" alt="">
        </a>
      </div>
      <?php
        }}
      ?>
      
    </div>
  </div>

<script type="text/javascript">
  $(document).ready(function() {

    Morris.Donut({
      element: 'demo-morris-donut',
      data: [
        {label: "Kebakaran", value: 12},
        {label: "Tornado", value: 30},
        {label: "Tsunami", value: 20}
      ],
      colors: [
        '#BF3030',
        '#269926',
        '#1D7373'
      ],
      resize:true
    });

  });
</script>