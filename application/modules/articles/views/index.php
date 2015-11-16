<div style="background:#4a7dab; margin-top:0px; border-bottom:1px solid #ddd; padding:15px">
<div class="container">
	<div class="row">
    	<div class="col-md-8">
        	<h1 class="page-title2">Artikel</h1>
        </div>
    	<div class="col-md-4">
        	<ul class="breadcrumb">
              	<li><a href="">Home</a></li>
                <li><a href="articles">Artikel</a></li>
                <li class="active">Indeks</li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container pages">
    <div class="row">
    	<div class="col-md-8">
        	<h3>Indeks</h3>
            <?php if (is_array($news_list)) { ?>
			  <?php 
                foreach($news_list as $k=>$v) { 
                    $image = ($v['image'])?'assets/image/pages/'.$v['image']:"assets/images/blank.png";
                    $category = ($v['category']==2)?'<span class="label label-important">Pengumuman</span>':'';
              ?>
              <!--media-->
              <div class="media ">
                <div class="pull-left" style="width:100px">
                    <img src="<?=$image;?>" class="avatar media-object" alt="BRWA" style=" width:90px;height:90px;margin:1px" />
                </div>   
                <div class='media-body'>
                    <div class="pull-left" style="color:grey"> <i class="icon-time"></i> <?=$v['date_formatted'];?></div><br />
                    <?=$category;?>
                    <div>
                        <h5 class="media-heading"><a href="articles/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
                        <div><?=$v['clip'];?>...</div>   
                        <a href="news/read/<?=$v['idx'];?>" class="news">read more &raquo;</a>                   
                    </div>
                </div>
             </div>
             <!--end media-->
             <? }} ?>
             <br />
             <div class="table-nav table-nav-border-top">
                <div class="pull-left text">Displaying : <?=$data_start;?> - <?=$data_end;?> of <?=$total_rows;?> entries</div>            
                <div class="pull-right"><?=$paging;?></div>
                <!--<div class="pull-right"><?=$perpage;?></div>
                <div class="pull-right">Rows/page: </div>-->
            </div>
             <? modules::load('wg/web')->social_ftg('BRWA - '.$this->page_title,true);?>
    	</div>
        <div class="col-md-4">
			<? modules::load('wg/web')->brwa_rss(1);?>
			<? modules::load('wg/web')->news_pages(1,false,3);?>
            <? modules::load('wg/web')->other_links();?>
        </div>
	</div>
</div>
