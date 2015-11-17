<div class="row" style="margin-bottom:20px">
        <div class="col-md-12">
          <?php if ($title) { ?><h3 class="rightsub" style="border-bottom:0px solid #0a3e73">Berita</h3><? } ?>
          <?php if (is_array($list)) { ?>
          <?php 
		  	foreach($list as $k=>$v) { 
		  		$image = ($v['image'])?$v['image']:"blank.png";
				$category = ($v['category']==2)?'<small><span class="label label-important">Pengumuman</span></small>':'';
		  ?>
          <!--media-->
          <div class="media" style="padding-bottom:0px; margin-top:5px">
            <!--<div class="media-left" style="width:50px">
                <img src="assets/image/news/<?=$image;?>" class="avatar media-object" alt="<?=$v['image_title'];?>" style=" width:40px;height:40px;margin:1px" />
            </div>   -->
            <div class='media-body' style="width:100%">
                <div class="pull-left" style="color:grey"><small><?=$v['date_formatted'];?></small></div><br />
            	<!--<?=$category;?>-->
                <div>
                    <h5 class="media-heading"><a href="news/read/<?=$v['idx'];?>" class="news-title"><?=$v['title'];?></a></h5>
                </div>
            </div>
         </div>
         <!--end media-->
         <? }} ?>
      </div>
    </div>