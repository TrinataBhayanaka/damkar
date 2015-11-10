
<div class="ui-layout-center" id="maped" style="background-color:#fff; z-index:0; border:0px solid #ccc; border-left:0; border-right:0">
    <!--<div class="data_close" title="Close"></div>-->
    <div class="north_arrow"></div>
    <div id="map_legend"><div style="margin-bottom:5px; border-bottom:1px solid #ccc; padding:2px">Jumlah Wilayah Adat</div></div>
    <div id="map_attribute"></div>
    <div class="ti" id="coords" style=""></div>
    <div class="shadow_vert"></div>
    <div id="top-layouts" style="position:absolute; z-index:750; top:0; right:0">
    	<div class="floating-button" style="padding:10px">
    	<a href="#zoomin" title="Perbesar Tampilan Peta"><span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span></a>
        <a href="#zoomout" title="Perkecil Tampilan Peta"><span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-minus fa-stack-1x fa-inverse"></i>
            </span></a>
        <a id="ov-button" href="#" title="On/Off Peta Kecil"><span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-eye-slash fa-stack-1x fa-inverse"></i>
            </span></a>
        </div>
        <div style="position:absolute; z-index:650; top:200px; right:30px">
        <ul class="nav nav-pills pull-right">
          <!--<li id="loader" class="olControlLoader">Loading...</li>-->
          <li role="presentation" class="dropdown" title="Ganti Peta Dasar">
            <img id="bm" src="assets/images/base-osm.jpg" style="border:3px solid #fff" class="img-roundeds dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" />
            <ul id="select_map" class="dropdown-menu" role="menu">
            	<li title="Peta OSM"><img data-map="osm" src="assets/images/s-base-osm.jpg" style="border:3px solid #fff; display:none" class="img-roundeda"></li>
                <li title="Peta Google"><img data-map="gmap" src="assets/images/s-base-gmap.jpg" style="border:3px solid #fff" class="img-roundeda"></li>
                <li title="Peta Google Hybrid"><img data-map="ghyb" src="assets/images/s-base-ghyb.jpg" style="border:3px solid #fff" class="img-roundeda"></li>
              <!--<li><a href="#" data-map="osm">OSM Map</a></li>
              <li><a href="#" data-map="gmap">Google</a></li>-->
            </ul>
          </li>
        </ul>
        </div>
      <!--<-->
      </div>
    <div id="box-data" class="box-data" style="position:absolute; z-index:1001; top:41px; left:20px; width:400px; height: auto; background:transparent">
    
    <ul class="nav nav-tabs" id="myTab" style="margin:0; background:transparent; margin-top:-42px">
        <li class="active"><a href="#brwa">
        <img class="desaturate" src="assets/image/logo-blank.png" style="height:16px; margin:2px 0;">
        </a></li>
        <li><a href="#nav">&nbsp;<i class="fa fa-search"></i>&nbsp;</a></li>
        <li><a href="#data_search">&nbsp;<i class="fa fa-list-ul"></i>&nbsp;</a></li>
    </ul>
    
    <div class="tab-content" id="data_box" style=" background:transparent;margin:0; padding:0px">
    	<div class="tab-pane active" id="brwa">
        	<div style="height:99px; overflow:hidden;">
             <img src="assets/images/logo_app_bg.png" border="0" title="<?=$title;?>" />
             </div> 
             <div class="copyright">Copyright &copy; <?=date("Y");?> BRWA</div>
             <div id="data-stats-total"></div>
        </div>
        <div class="tab-pane" id="nav">
            <form id="fdata" class="form-horizontal">
            
        	<!--panel collapse: start-->
        	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" style="position:relative; padding-top:10px">
                  <!-- Appended Input-->
                      <span style="position:absolute; right:20px; top:15px">&times;</span>
                      <input id="search_key" class="form-controls" placeholder="Search" type="text">
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" data-title="Administratif:" href="#acc_administratif" aria-expanded="true" aria-controls="acc_administratif">
                      Administratif: <span class="acctext">Indonesia</span>
                    </a>
                  </h4>
                </div>
                <div id="acc_administratif" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <?php
                            $arrPropinsi=m_lookup("propinsi2","kode_bps","nama");
                            $arrPropinsi1=array(""=>"Indonesia")+$arrPropinsi;
                        ?>
                        <!-- Select Basic -->
                            <?=form_dropdown("id_propinsi",$arrPropinsi1,0,"id='id_propinsi' class='form-control'");?>
                        
                        <!-- Select Basic -->
                            <span id="id_kabupaten_holder">
                            <?=form_dropdown("id_kabupaten",false,0,"id='id_kabupaten' class='form-control'");?>
                            </span>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" data-title="Status:" href="#acc_status" aria-expanded="false" aria-controls="acc_status">
                      Status:
                    </a>
                  </h4>
                </div>
                <div id="acc_status" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                  	<?php
                            //$mproses=m_lookup("wa_proses","id_proses","nama_proses");
							//$mproses[0]="In Progress";
							$mproses[1]="Teregistrasi";
							$mproses[2]="Terverifikasi";
							$mproses[3]="Tersertifikasi";
                        	foreach($mproses as $k=>$v) {
							?>
                            <div class="checkbox">
                              <label>
                                <input class="wa_status" name="id_status" type="checkbox" value="<?=$k;?>" data-label="<?=$v?>">
                                <?=$v;?>
                              </label>
                            </div>
                            <? } ?>
                  </div>
                </div>
              </div>
              <div id="button-block" style="background:#fff; position:absolute; width:100%; display:none">
              	<div class="btn-group btn-group-justifieds" role="group" aria-label="...">
                  <div class="btn-group" role="group">
                    <button id="myButton" type="button" class="btn" style="background:#fff"><i class="fa fa-search"></i> &nbsp;CARI </button>
                  </div>
                  <div class="btn-group" role="group">
                    <button id="myReset" type="button" class="btn" style="background:#fff"><i class="fa fa-remove"></i> &nbsp;RESET </button>
                  </div>
                </div>
              </div>
			
            </div>
			
            <!--container-->
            <div id="all-container">
                <div id="data-list-small"><a><i class="fa fa-list-ul"></i> &nbsp; Lihat Hasil Pencarian</a></div>
                <div id="data-container">
                    <div id="data-list"></div>
                    <div id="data-stats"></div>
                </div>
                <div id="detil-container">
                    <div id="data-detil"></div>
                    <div id="data-detil-stats">
                            <a href="" class="btns open_detil" style="background:#fff"><i class="fa fa-search"></i> &nbsp;Report Lengkap Wilayah Adat</a>
                    </div>
                </div>
            </div>
            <!--container: end-->
            <!--panel collapse: end-->
            </form>
        </div>
        <div class="tab-pane" id="data_search">
            <div style="overflow:hidden; background:#fff; padding:15px">
             About & Help
             </div> 
        </div>
    </div>
    </div>
    </div>
    
</div>
<!--<div class="ui-layout-north">
    <ul class="nav nav-pills">
      <li role="presentation"><a href="#">Home</a></li>
      <li role="presentation"><a href="#">Profile</a></li>
      <li role="presentation"><a href="#">Messages</a></li>
    </ul>
</div>-->
<div id="map_detil_box">
<div style="position:absolute; background:#4a7dab; height:36px; width:100%; z-index:1001">
	<div class="container">
      <a href="" class="btn btn-danger" id="detail-close"><i class="icon-remove icon-white"></i> Close</a>
      </div><!-- /navbar-inner -->
    <iframe id="map_detil" style="border:0; width:100%" frameborder="0"></iframe>
</div>
</div>
<div id="map_loading_box"></div>
<div id="throbber" class="olControlLoadingPanel"></div>
<style>

.ui-layout-content {
	overflow:		auto; /* add scrolling to content-divs (panel-wrappers) */
	border-top:		0 !important; /* tab-buttons above this DIV already has a border-bottom */
}
.ui-layout-pane-west {
	padding:	0;
	overflow:	hidden;
	-moz-border-radius:		0;
	-webkit-border-radius:	0;
}
.ui-layout-pane-west .ui-tabs-nav {
	/* don't need border or rounded corners - tabs 'fill' the pane */
	border-top:		0;
	border-left:	0;
	border-right:	0;
	padding-bottom:	0 !important;
	-moz-border-radius:		0;
	-webkit-border-radius:	0;
}
.olControlLoader {
	float:left;
	width:136px;
	height:36px;
	padding-left:36px;
	line-height:36px;
	color:#FFCC66;
	display:none; 
	background: url(public/images/ajax-loader.gif) 10px 10px no-repeat;
}
.olControlLoadingPanel {
	position:absolute; 
	bottom:1px; left:0; 
	width:100%; height:100%; 
	display:none; 
	z-index:1005; 
	border-top:1px solid #ddd; 
	background:#fff url(public/images/ajax-loader.gif) center no-repeat;
	filter: alpha(opacity=0);
	-moz-opacity:0.0;
    -khtml-opacity: 0.0;
    opacity: 0.0;
}
.olControlAttribution {
    font-size: smaller; 
    left: 30px; 
    bottom: 20px; 
    position: absolute; 
    display: block;
}
.olControlScale {
   display: block;
   position: absolute;
   left: 50px;
   bottom: 45px;
   font-size: xx-small;
}
.olControlScaleLineBottom {
   border: solid 2px black;
   border-bottom: none;
   margin-top:-1px!important;
   text-align: center;
   display:none;
}
.olControlOverviewMapContainer {
    position: absolute;
    top: 50px;
    right: 10px;
	height: 124px;
	z-index:1;
}
div.olControlZoom {
    position: absolute;
    top: 80px;
    left: 30px;
    background: rgba(255,255,255,0.3);
    border-radius: 4px;
    padding: 1px;
}
div.olControlZoom a {
	background: #ccc; /* fallback for IE - IE6 requires background shorthand*/
    background: rgba(120,120,120, 0.5);
}
div.olControlZoom a:hover {
	background: #aaa; /* fallback for IE - IE6 requires background shorthand*/
    background: rgba(60,60,60, 0.5);
}
.olControlOverviewMapElement {
	margin-top:0px;
    padding: 1px/* 0 8px 8px*/;
    background-color: #fff;
	z-index:1
}
.olControlOverviewMapMinimizeButton {
    left: -2px;
    bottom: 14px;
    cursor: pointer;
}    
.olControlOverviewMapMaximizeButton {
    right: 2px;
    top: 2px;
    cursor: pointer;
}
.olControlOverviewMapExtentRectangle {
    overflow: hidden;
    background-image: url("img/blank.gif");
    cursor: move;
    border: 1px solid red;
}
.olImageLoadError {
    background: transparent/* url(public/images/missing-tile-256x256.png) no-repeat*/ !important;
	border:none !important;
}
.olControlAttribution {
	text-shadow: 1px 1px 1px #fff, -1px 1px 1px #fff, 1px -1px 1px #fff;
}
.olLayerGoogleV3.olLayerGoogleCopyright {
    right: 0 !important;
}
.olLayerGoogleV3.olLayerGooglePoweredBy {
    bottom: 40px !important;
	left:360px !important
}
.olPopup {
	background:transparent!important;
	padding:0px!important;
	margin:0px!important;
}
.olPopupContent {
	position:relative;
	top:0; left:0;
	background:#fff;
	background:transparent!important;
	margin:0px!important;
	padding:5px;
}
.small_legend {
	width:7px; height:7px;display:inline-block;
}
/* MAP DETAIL */
#map_detil_box {
	position:absolute; bottom:1px; left:0; width:100%; display:none; z-index:1005; background:#fff; border-top:0px solid #ddd
}
#map_loading_box {
	position:absolute; bottom:1px; left:0; width:100%; display:none; z-index:1005; background:#777; border-top:0px solid #ddd
	filter: alpha(opacity=50);
	-moz-opacity:0.5;
    -khtml-opacity: 0.5;
    opacity: 0.5;
}
.data_close {
	position:absolute; cursor:pointer; background:transparent url(assets/images/open-left.png); top:1px; margin-left:-3px; height:41px; width:30px; z-index:1003
}
.copyright {
	font-size:11px;
	text-indent:10px;
	background-color:#ddd;
	padding:5px 2px;
	/*position:absolute; bottom:0; width:100%; height:30px; line-height:30px; border-top:1px solid #ccc*/
}
.shadow_horz {
	position:absolute; background:transparent url(assets/images/bg_trans_hr.png) repeat-x; top:36px; height:15px; width:100%; z-index:1000;
}
.shadow_vert {
	position:absolute; background:transparent url(assets/images/bg_trans_vr.png) repeat-y; height:100%; width:15px; z-index:1002;
}
.navfilter{
	margin:10px; padding:5px 5px 10px 5px; background:#f0f0f0;border-radius: 5px; border:1px solid #e4e4e4;
}
.north_arrow {
    position: absolute;
    background: url("assets/images/default.png") repeat-x scroll 0% 0% transparent;
    left: 10px;
    top: 46px;
    height: 64px;
    width: 64px;
    z-index: 900;
}
#coords {
    position: absolute;
    left: 25px;
    bottom: 5px;
    z-index: 900;
	
	font-size:normal; color:#fff; text-shadow: 1px 1px 2px #000, -1px 1px 2px #000, 1px -1px 2px #000;
}
.themeTitle {
	font-size:16px;
	text-transform:uppercase;
	font-weight:normal;
	padding:10px 10px 10px 20px;
	border-bottom:1px solid #aaa;
	color:#555;
	background-color:#ddd;
}
#map_legend {
    position: absolute;
    right: 10px;
    bottom: 20px;
    z-index: 900;
	background:#fff;
	opacity:0.7;
	max-width:380px;
}
#map_attribute {
    position: absolute;
    left: 30px;
    bottom: 50px;
    z-index: 1000;
	opacity:0.7;
	max-width:180px;
	font-size:x-small;
}

#accordion {
	position:relative;
	z-index:1000;
	box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.2);
}
#search_key {
	background:transparent; padding:2px; border:1px solid transparent; width:100%
}
#search_key:focus {
	border-bottom-color:#ccc!important;
	box-shadow:none
}
#data-container{
	position:relative;
	background:#fff;
	margin-top:5px;
	box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.2);
}
#data-list{
	background:#fff;
	max-height:350px;
	overflow: auto;
}
#data-list-small{
	position:relative;
	z-index:900;
	background:#fff;
	display:none;
	margin-top:-5px;
	padding: 10px 15px 3px;
	cursor:pointer;
}
#data-stats, #data-stats-total{
	background:#fff;
	border-top:1px solid #ccc;
	margin-top:0px;
	padding: 10px 25px 10px 15px;
	font-size:.9em;
}

.floating-button a {
	color:#999;
	outline:none;
}
.floating-button a:hover,.floating-button a.active {
	color:#555;
}
.floating-button i.fa-stack-1x {
	font-size:.9em
}
.floating-button i.fa-stack-1x:hover {
	font-size:1.2em
}
/*detil*/
#detil-container{
	position:relative;
	background:#fff;
	margin-top:5px;
	box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.2);
}
#data-detil{
	background:#fff;
	max-height:350px;
	overflow: auto;
}
#data-detil-stats{
	background:#fff;
	border-top:1px solid #ccc;
	margin-top:0px;
	padding: 10px 15px;
}

.content-sub-nav {
	background:#ddd;
	border-top:1px solid #d4d4d4
}
/**/
.map_search_detil {
	padding:2px;
	padding-left:10px;
	background:#eee;
}
#select_map li {
	background:transparent;
}
#select_map li>img, #bm {
	cursor:pointer;
}
#select_map li>img:hover, #bm:hover {
	border:3px solid #ddd!important
}
#select_map {
    min-width: inherit!important;
    padding: 0px;
	margin:2px 2px 2px 0
}
</style>
<script>
$(document).ready(function () {
	$('#myTab a:first').tab('show');
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
    });
	
	$("#id_propinsi").change(function(){
		var kd = $(this).val();
		//test(kd);
	});
	
	$("#id_propinsi").change(function(){
   		var id_propinsi = $(this).val();
		var nm_propinsi = $("#id_propinsi option:selected").text();
		$("#id_kabupaten_holder").load("<?=$this->module;?>get_kab_kota/"+id_propinsi+"/?time="+new Date().getTime(),function(){
			//getgeoCode(nm_propinsi);
			//test(id_propinsi);
			$("#id_kabupaten").change(function(){
				var nm_address = nm_propinsi+" "+$("#id_kabupaten option:selected").text();
				//getgeoCode(nm_address);
				//alert(id_propinsi+":"+$("#id_kabupaten option:selected").val());
				//test(id_propinsi,$("#id_kabupaten option:selected").val());
		   });
		});
   });
   
	var timer;
	$('#accordion').bind('mouseenter',
	function() { //hover
        clearTimeout(timer);
		$("#button-block").slideDown('fast');
		$("#all-container").css('opacity',0.5);
    }).bind('mouseleave', function(){
		clearTimeout(timer);
		timer = setTimeout(function(){
		$("#button-block").slideUp('fast');
		$("#all-container").css('opacity',1);
		}, 1000);
	});	
	
	$('#all-container').bind('mouseenter', function(){
		$(this).css('opacity',1);
		$("#button-block").slideUp('fast');
	});
	
	
	$("#select_map li>img").click(function(e){
		var src = $(this).attr("src");
		$("#select_map li>img").show();
		$("#bm").attr('src',src.replace('s-',''));
		$(this).hide();
		changeBaseMap($(this).data("map"));
		e.preventDefault();
	});
	
	$('#accordion').on('hidden.bs.collapse', function () {
		var collapse = $(this).find(".collapse");
		collapse.each(function(){
			var openid = $(this).attr('id');
			var heading = $("#"+openid).prev().find("h4>a");
			var text = new Array();
			
			if (openid=='acc_administratif') {
				var param = $("#"+openid).find('.form-control :checked');
				param.each(function(){
					if ($(this).val()!="" || $(this).text()=='Indonesia') text.push($(this).text());
				});
				heading.html("Administratif: "+"<span class='acctext'>"+text+"</span>");
			}
			else{
				var param = $("#"+openid).find('input:checked');
				param.each(function(){
					text.push($(this).data('label'));
				});
				heading.html((openid=='acc_status'?"Status: ":"Kondisi Fisik: ")+"<span class='acctext'>"+text+"</span>");
			}
		});
	});
	$('#accordion').on('shown.bs.collapse', function () {
		var openid = $(this).find(".collapse.in").attr('id');
		var heading = $("#"+openid).prev().find("h4>a");
		
		heading.text((openid=='acc_administratif'?"Administratif: ":openid=='acc_status'?"Status: ":"Kondisi Fisik: "));
	});
	$("#data-list-small").click(function(e){
		dataShow();
		e.preventDefault();
	});
	$("[href='#zoomin']").click(function(e){
		map.zoomIn();
		e.preventDefault();
	});
	$("[href='#zoomout']").click(function(e){
		map.zoomOut();
		e.preventDefault();
	});
	$('#myButton').on('click', function () {
		$("#button-block").hide();
		$("#fdata").submit();
	  });
	  $("#fdata").submit(function(e){
	  	var $btn = $('#myButton').button('loading');
	  	$('#accordion .in').collapse('hide');
		
		var key = $("#search_key").val();
		var prop = $("#id_propinsi").val();
		var kab  = $("#id_kabupaten").val();
		
		var status = new Array();
		$(".wa_status").each(function(){
			if ($(this).is(":checked")) status.push($(this).val());
		});
		var fisik = new Array();
		$(".kfisik").each(function(){
			if ($(this).is(":checked")) fisik.push($(this).val());
		})
		
		getData(prop,kab,status,fisik,key);
		
		$btn.button('reset');
		return false;
	  });
	 $('#myReset').on('click', function () {
		var key = $("#search_key").val("");
		var prop = $("#id_propinsi").val("");
		var kab  = $("#id_kabupaten").val("");
		
		$(".panel-title").find("a").each(function(){
			$(this).html($(this).data("title"));
		});
		
		var status = new Array();
		$(".wa_status").each(function(){
			if ($(this).is(":checked")) $(this).attr("checked",false);
		});
		var fisik = new Array();
		$(".kfisik").each(function(){
			if ($(this).is(":checked")) $(this).attr("checked",false);
		})
		
		$("#fdata").submit();
	});
	
	$("#ov-button").click(function(e){
		if ($(this).find("i").hasClass("fa-eye-slash")) {
			ovControl.minimizeControl();
			$(this).find("i").removeClass("fa-eye-slash").addClass("fa-eye");
		}
		else {
			ovControl.maximizeControl();
			$(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
		}
		e.preventDefault();
	})
})
</script>