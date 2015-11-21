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

<section>
  <div class="container">

    <div class="row">

      <div class="col-md-9 col-sm-9">

        <h1 class="blog-post-title"><?=$data['title'];?></h1>
        <ul class="blog-post-info list-inline">
          <li>
            <a href="#">
              <i class="fa fa-clock-o"></i> 
              <span class="font-lato"><?=$data['date_formatted'];?></span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-user"></i> 
              <span class="font-lato"><?=$data['author'];?></span>
            </a>
          </li>
        </ul>

        <p class="dropcap"><?=$data['content'];?></p>

        

        <? modules::load('wg/web')->social_ftg('Kebencanaan - Berita: '.$data['title']);?>

        <h4 class="page-header margin-bottom-10 size-20">
          <span>Berita</span> Lain
        </h4>
        <? modules::load('wg/web')->news_pages(false,$data["idx"]);?>
      </div>

      <div class="col-md-3 col-sm-3">

      <!-- INLINE SEARCH -->
      <div class="inline-search clearfix margin-bottom-30">
        <form action="#" method="get" class="widget_search">
          <input type="search" placeholder="Start Searching..." id="s" name="s" class="serch-input">
          <button type="submit">
            <i class="fa fa-search"></i>
          </button>
        </form>
      </div>
      <!-- /INLINE SEARCH -->

      <!-- FEATURED VIDEO -->
      <h3 class="hidden-xs size-16 margin-bottom-10"> VIDEO</h3>
      <div class="hidden-xs embed-responsive embed-responsive-16by9 margin-bottom-60">
        <? modules::load('wg/web')->brwa_wa();?>
      </div>

      <hr />

      <!-- JUSTIFIED TAB -->
      <div class="tabs nomargin-top hidden-xs margin-bottom-60">

        <h3 class="hidden-xs size-16 margin-bottom-10">ARTIKEL</h3>

        <!-- tabs content -->
        <div class="tab-content margin-bottom-60 margin-top-30">

          
          <div id="tab_1" class="tab-pane active">
            <? modules::load('wg/web')->article_pages(1,false,3);?>
          </div>
          

        </div>

      </div>
      <!-- JUSTIFIED TAB -->

      <!-- side navigation -->
      <div class="side-nav margin-bottom-60 margin-top-30">

        <div class="side-nav-head">
          <button class="fa fa-bars"></button>
          <h4>TAUTAN</h4>
        </div>
        <ul class="list-group list-group-bordered list-group-noicon uppercase">
          <? modules::load('wg/web')->other_links();?>
        </ul>
        <!-- /side navigation -->

      
      </div>

      </div>

    </div>

  </div>
</section>