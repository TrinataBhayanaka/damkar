
<div class="ui-layout-center" id="maped" style="background-color:#fff; z-index:0; border:0px solid #ccc; border-left:0; border-right:0">
    <!--<div class="data_close" title="Close"></div>-->
    <div class="north_arrow"></div>
    <div id="map_legend"></div>
    <div id="map_attribute"></div>
    <div class="ti" id="coords" style=""></div>
    <div class="shadow_vert"></div>
    <div class="menu_bar">
      <div id="top-layouts">
      <nav class="navbar navbar-default" role="navigation">
      <div class="containers">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--<a class="navbar-brand" href="#" style="padding:5px 30px 0 100px; position:relative"><img src="assets/image/logo-blank.png" border="0" title="<?=$title;?>" style="width:150px" /></a>-->
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav main-menu">
              <li id="loader" class="olControlLoader">Loading...</li>
              <li role="presentation"><a href="#"><i class="fa fa-plus"></i></a></li>
              <li role="presentation"><a href="#"><i class="fa fa-minus"></i></a></li>
              <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                  Default <span class="caret"></span>
                </a>
                <ul id="select_map" class="dropdown-menu" role="menu">
                  <li><a href="#" data-map="osm">OSM Map</a></li>
                  <li><a href="#" data-map="gmap">Google</a></li>
                </ul>
              </li>
              <li role="presentation"><a href="#"><i class="fa fa-eye"></i></a></li>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
      </div>
      </div>
  	</div>
    <div id="box-data" class="box-data" style="position:absolute; z-index:1001; top:60px; left:0px; width:350px; height: auto; background:#fff">
    
    <ul class="nav nav-tabs" id="myTab" style="margin:0; background:transparent; margin-top:-42px">
        <li class="active"><a href="#nav">&nbsp;<i class="fa fa-search"></i>&nbsp;</a></li>
        <li><a href="#data_search">&nbsp;<i class="fa fa-list-ul"></i>&nbsp;</a></li>
    </ul>
    <div class="tab-content" id="data_box" style=" background:#fff;margin:0; padding:0px">
        <div class="tab-pane active" id="nav">
            <form id="fdata" class="form-horizontal">
            
        	<!--panel collapse: start-->
        	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <!-- Appended Input-->
                      <span style="position:absolute; right:20px; top:15px">&times;</span>
                      <input id="search_key" class="form-control" placeholder="Search" type="text">
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#acc_administratif" aria-expanded="true" aria-controls="acc_administratif">
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
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#acc_status" aria-expanded="false" aria-controls="acc_status">
                      Status
                    </a>
                  </h4>
                </div>
                <div id="acc_status" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                  	<?php
                            $mproses=m_lookup("wa_proses","id_proses","nama_proses");
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
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#acc_fisik" aria-expanded="false" aria-controls="acc_fisik">
                      Kondisi Fisik
                    </a>
                  </h4>
                </div>
                <div id="acc_fisik" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <?php 	
                                $kfisik=m_lookup("wa_kondisi_fisik","idx","kondisi_fisik",""," order by order_num asc "); 
                            	foreach($kfisik as $k=>$v) {
							?>
                            <div class="radio">
                              <label>
                                <input class="kfisik" name="id_kondisi_fisik" type="radio" value="<?=$k;?>" data-label="<?=$v?>">
                                <?=$v;?>
                              </label>
                            </div>
                            <? } ?>
                  </div>
                </div>
              </div>
            </div>
			<button style="margin-top:5px; text-align:left" type="button" id="myButton" data-loading-text="Loading..." class="btn btn-primary btn-block" autocomplete="off">
              SUBMIT
            </button>
            <!--panel collapse: end-->
            </form>
        </div>
        <div class="tab-pane" id="data_search">
        <div id="data-list" style="height:300px; width:inherit; display:nones;overflow:auto"></div>
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
<div style="position:absolute; background:#aaa; height:36px; width:100%; z-index:1001">
	<div id="top-layouts" class="navbar navbar-inverse ">
      <div class="navbar-inner">
        <div class="container-fluid">
            <ul class="nav lat-subnav">
              <li style="border-color:#bbb; border-left:1px solid #bbb"><a href="" id="detail-back"><i class="icon-reply icon-white"></i> Back</a></li>
              <li style="border-color:#bbb"><a href="" id="detail-close"><i class="icon-remove icon-white"></i> Close</a></li>
              <li style="border-color:#bbb"><a href="" id="detail-print"><i class="icon-print icon-white"></i> Print</a></li>
            </ul>
            <ul class="nav lat-subnav pull-right">
              <li style="border-right:0; padding-left:0" title="Select Basemap" class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dd-basemap-o-parent"><i class="icon-globe icon-white"></i> <span>Default</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="dd-basemap-o" rel="local">Default</a></li>
                  <li><a href="#" class="dd-basemap-o" rel="gmap">Google</a></li>
                  <li><a href="#" class="dd-basemap-o" rel="ghyb">Hybrid</a></li>
                </ul>
              </li>
            </ul>
        </div>
      </div><!-- /navbar-inner -->
    </div><!-- /navbar -->
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
    left: 140px; 
    bottom: 20px; 
    position: absolute; 
    display: block;
}
.olControlScale {
   display: block;
   position: absolute;
   right: 180px;
   bottom: 45px;
   font-size: small;
}
.olControlScaleLine {
   display: block;
   position: absolute;
   right: 220px;
   bottom: 45px;
   font-size: xx-small;
   line-height:12px
}
.olControlOverviewMapContainer {
    position: absolute;
    bottom: 0px;
    right: -2px;
	height: 168px;
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
    padding: 2px/* 0 8px 8px*/;
    background-color: #fff;
	z-index:1
}
.olControlOverviewMapMinimizeButton {
    left: -1px;
    top: -1px;
    cursor: pointer;
}    
.olControlOverviewMapMaximizeButton {
    right: 1px;
    bottom: 5px;
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
	background-color:#eee;
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
    background: url("assets/image/logo-blank.png") repeat-x scroll 0% 0% transparent;
    left: 135px;
    bottom: 46px;
    height: 64px;
    width: 204px;
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
    left: 20px;
    bottom: 30px;
    z-index: 900;
	background:#fff;
	opacity:0.7;
	max-width:380px;
}
#map_attribute {
    position: absolute;
    right: 170px;
    bottom: 10px;
    z-index: 1000;
	opacity:0.7;
	max-width:180px;
	font-size:x-small;
	line-height:normal;
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
   
   $( "#box-data" ).hover(
	function() {
		//$("#data-list").slideDown();
	}, function() {
		//$("#data-list").slideUp();
	}
	);
	
	
	$("#select_map li>a").click(function(e){
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
					if ($(this).val()!="") text.push($(this).text());
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
	$('#myButton').on('click', function () {
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
		
		test(prop,kab,status,fisik,key);
		
		$btn.button('reset');
		return false;
	  });
})
</script>