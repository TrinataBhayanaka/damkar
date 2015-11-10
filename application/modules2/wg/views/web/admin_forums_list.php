<div class="box" style="padding:0 10px">
        <ul style="margin-left:0">
            <?php if (is_array($list)) { ?>
              <?php 
                foreach($list as $k=>$v) { 
                    $image = ($v['image'])?$v['image']:"blank.png";
                    $category = ($v['category']==2)?'<small><span class="label label-important">Pengumuman</span></small>':'';
              ?>
              <!--media-->
              <li style="list-style:none">
                <div class="media" style="padding-bottom:10px; margin-top:5px">
                    <div><i class="icon-comment-alt"></i> &nbsp;<span><a href="<?=$v['topic_url'];?>" target="_blank"><?=$v['post_subject'];?></a></span></div>
                    <div class='media-body' style="padding-left:15px; margin-left:5px; border-left:1px solid #ddd">
                        <!--<?=$category;?>-->
                        <div style="color:#bbb; margin-bottom:10px"><small>by <a href="<?=$v['user_url'];?>" target="_blank"><?=$v['username'];?></a> &raquo; <?=$v['date_formatted'];?></small></div>
                        <div>
                            <span style="color:#555; line-height:normal"><?=$v['post_text'];?></span>
                        </div>
                    </div>
                 </div>
            </li>
             <!--end media-->
             <? }} ?>
        </ul>
</div>
