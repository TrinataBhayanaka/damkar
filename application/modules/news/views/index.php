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

        <?php if (is_array($news_list)) { 
          foreach($news_list as $k=>$v) { 
              $image = ($v['image'])?$v['image']:"blank.png";
              $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
        ?>

        <!-- POST ITEM -->
        <div class="blog-post-item"><!-- .blog-post-item-inverse = image right side [left on RTL] -->

          <!-- IMAGE -->
          <figure class="blog-item-small-image margin-bottom-20">
            <img class="img-responsive" src="assets/image/pages/<?=$image;?>" alt="">
          </figure>

          <div class="blog-item-small-content">

            <h2><a href="news/read/<?=$v['idx'];?>"><?=$v['title'];?></a></h2>

            <ul class="blog-post-info list-inline">
              <li>
                <a href="#">
                  <i class="fa fa-clock-o"></i> 
                  <span class="font-lato"><?=$v['date_formatted'];?></span>
                </a>
              </li>
            </ul>

            <p><?=$v['clip'];?>...</p>

            <a href="news/read/<?=$v['idx'];?>" class="btn btn-reveal btn-default">
              <i class="fa fa-plus"></i>
              <span>Read More</span>
            </a>
          
          </div>

        </div>
        <!-- /POST ITEM -->

        <?php
          }}
        ?>

        <!-- PAGINATION -->
        <div class="text-left">
          <!-- Pagination Default -->
          <ul class="pagination nomargin">
            <li><a href="#">&laquo;</a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
          <!-- /Pagination Default -->
        </div>
        <!-- /PAGINATION -->

      </div>

      <div class="col-md-3 col-sm-3">

        <!-- INLINE SEARCH -->
        <div class="inline-search clearfix margin-bottom-30">
          <form action="" method="get" class="widget_search">
            <input type="search" placeholder="Start Searching..." id="s" name="s" class="serch-input">
            <button type="submit">
              <i class="fa fa-search"></i>
            </button>
          </form>
        </div>
        <!-- /INLINE SEARCH -->

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
