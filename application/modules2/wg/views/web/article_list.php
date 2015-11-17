<div class="row" style="margin-bottom:20px">
        <div class="col-md-12">
          <?php if ($title) { ?><h3>Artikel</h3><? } ?>
		  <?php if (is_array($list)) { ?>
          <?php 
		  	foreach($list as $k=>$v) { 
		  		$image = ($v['image'])?$v['image']:"blank.png";
				$category = ($v['category']==2)?'<small><span class="label label-important">Pengumuman</span></small>':'';
		  ?>
          <!--media-->
          <div class="media" style="padding-bottom:0px; width:100%">
            <div class='media-body'>
                <div class="pull-left" style="color:grey"><small><?=$v['date_formatted'];?></small></div><br />
            	<!--<?=$category;?>-->
                <div>
                    <h5 class="media-heading"><a href="articles/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
                </div>
            </div>
         </div>
         <!--end media-->
         <? }} ?>
      </div>
    </div>