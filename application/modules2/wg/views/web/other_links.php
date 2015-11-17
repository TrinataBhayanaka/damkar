<div class="row" style="margin-bottom:20px">
    <div class="col-md-12">
    <h3>Tautan</h3>
      <ul>
      <?php if (is_array($footer_link_list)) { ?>
      <?php foreach($footer_link_list as $k=>$v) { ?>
      <li><a style="padding:5px" href="linkdir/get_link/<?=$v['idx'];?>" target="_blank"><?=$v['name'];?></a></li>
      <?php }} ?>
    </ul>
  </div>
</div>
