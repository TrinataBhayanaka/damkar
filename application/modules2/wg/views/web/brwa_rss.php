<div class="row" style="margin-bottom:20px">
        <div class="col-md-12">
          <?php if ($title) { ?><h3>Sindikasi Berita&nbsp;<span><i class="fa fa-rss-square" style="color:orange"></i></span></h3><? } ?>
				<?php if (is_array($rss)) { ?>
                  <?php 
                    $i=0;
                    foreach($rss as $k=>$v) { 
                        if ($i<=5) {
                  ?>
                    <!--media-->
                      <div class="media">
                        <div class="media-left" style="width:100px;">
                            <div class="media-left" style="width:90px; height:40px;text-align:center; vertical-align:middle; background:#f8f8f8; border-right:1px solid #eee; padding-right:0">
                            <?=$v['src']?>
                            </div>
                        </div> 
                        <div class='media-body'>
                            <div style="color:grey; font-size:small"><?=date("d-m-Y h:i",$k);?></span></div>
                            <div>
                                <h5 class="media-heading"><a href="<?=$v['link'];?>" target="_blank" class="news-title"><?=$v['title'];?></a></h5>
                            </div>
                        </div>
                     </div>
                     <!--end media-->
                  <? } $i++; } ?>
                <? } ?>
		</div>
    </div>