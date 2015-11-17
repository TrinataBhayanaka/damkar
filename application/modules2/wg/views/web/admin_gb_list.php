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
                    <div><i class="icon-comment-alt"></i> &nbsp;<span style="font-weight:bold"><?=$v['name'];?></span></div>
                    <div class='media-body' style="padding-left:15px; margin-left:5px; border-left:1px solid #ddd">
                        <!--<?=$category;?>-->
                        <div>
                            <small style="color:#555"><?=$v['comments'];?></small>
                        </div>
                        <div style="color:#bbb"><small><?=$v['date_formatted'];?></small></div>
                    </div>
                 </div>
            </li>
             <!--end media-->
             <? }} ?>
        </ul>
</div>
