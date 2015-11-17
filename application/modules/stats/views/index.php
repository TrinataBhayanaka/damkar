<link href="assets/css/style.new.statsbox.css" rel="stylesheet">
<link href="assets/js/plugins/chart/jqplot/jquery.jqplot.css" rel="stylesheet" />
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.enhancedLegendRenderer.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.logAxisRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.CanvasTextRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.CanvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.CanvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot1.0/plugins/jqplot.highlighter.js"></script>
<script type="text/javascript" src="assets/js/plugins/chart/jqplot1.0/plugins/jqplot.cursor.js"></script>
<script>
		//var p1 = [<?=($chart['In Progress']?$chart['In Progress']:0)?>];
		var p2 = [<?=($chart['Teregistrasi']?$chart['Teregistrasi']:0)?>];
		var p3 = [<?=($chart['Terverifikasi']?$chart['Terverifikasi']:0)?>];
		var p4 = [<?=($chart['Tersertifikasi']?$chart['Tersertifikasi']:0)?>];
		var pt = [<?=($chart2['total']?$chart2['total']:0)?>];
		
		var rekap = [];
		var rekap_stacked = [<?=($bar['value']?$bar['value']:0)?>];
		var rekap_series = [<?=($bar['text']?$bar['text']:0)?>];
		//var p1 = [["Teregistrasi",108],["Terverifikasi",56],["Sertifikasi",33]];
</script>
<style>
.jqplot-table-legend td {
	white-space:nowrap
}
</style>
<!-- Carousel
================================================== -->

<div class="subhead">
  <div class="container">
    <div class="subhead-caption" style="max-width:800px">
      <h1>Wilayah Adat</h1>
      <p class="lead">&nbsp;</p>
    </div>
  </div>
</div>
<?php $this->load->view('wa_menu',array("active"=>"stats"))?>
<?php //$this->load->view('user/wa/menu',array("active"=>"list"))?>

<div style="margin-top:30px; border-bottom:1px solid #ddd; padding:15px">
<div class="container">
	<div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats box">
                <span class="title">TOTAL WA</span>
                <span class="value"><?=$list['Indonesia']['Total']?></span>
                <span class="subtitle"><?=date("d-m-Y")?></span>
                <!--<div class="sparkline-box">
                    <div class="boxchart">5,6,7,2,0,-4,-2,4,5,6,7,-2,0,4,2</div>
                </div>	-->
                <!--<a href="" class="more">
                    <span>View More</span>
                    <i class="icon-chevron-right"></i>
                </a>	-->
                <br />
            </div>
        </div><!--/col-->
        <? $pct = ($list['Indonesia']['In Progress']/$list['Indonesia']['Total'])*100; ?>
       <!-- <div class="col-lg-2 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats warning box">
                <span class="title">IN PROGRESS</span>
                <span class="value"><?//=$list['Indonesia']['In Progress']?><!--<span class="sub">/</span>--></span>
                <!--<span class="subtitle"><?//=number_format($pct,2,",",".");?>%</span>
                <br />
            </div>-->
        <!--</div><!--/col-->
        
        <? $pct = ($list['Indonesia']['Teregistrasi']/$list['Indonesia']['Total'])*100; ?>
        <div class="col-lg-2 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats info box">
                <span class="title">TEREGISTRASI</span>
                <span class="value"><?=$list['Indonesia']['Teregistrasi']?></span></span>
                <span class="subtitle"><?=number_format($pct,2,",",".");?>%</span>
                <!--<div class="sparkline-box">
                    <div class="boxchart">5,6,7,2,0,-4,-2,4,5,6,7,-2,0,4,2</div>
                </div>	-->
                <!--<a href="" class="more">
                    <span>View More</span>
                    <i class="icon-chevron-right"></i>
                </a>	-->
                <br />
            </div>
        </div><!--/col-->

        <? $pct = ($list['Indonesia']['Terverifikasi']/$list['Indonesia']['Total'])*100; ?>
        <div class="col-lg-2 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats success box">
                <span class="title">TERVERIFIKASI</span>
                <span class="value"><span class="sup"></span><?=($list['Indonesia']['Terverifikasi'] == '' ? 0 : $list['Indonesia']['Terverifikasi']); ?><!--<span class="sub">/191</span>--></span>
                <span class="subtitle"><?=number_format($pct,2,",",".");?>%</span>
                <!--<div class="sparkline-box">
                    <ul class="sparkline-range weekly6">
                        <li>M</li>
                        <li>T</li>
                        <li>W</li>
                        <li>T</li>
                        <li>F</li>
                        <li>S</li>
                    </ul>
                    <div class="linechart2" data-resize="true" data-values="5,7,2,-4,-2,4" ></div>
                </div>	-->
                <!--<a href="" class="more">
                    <span>View More</span>
                    <i class="icon-chevron-right"></i>
                </a>-->
                <br />
            </div>
        </div><!--/col-->
        
        <? $pct = ($list['Indonesia']['Tersertifikasi']/$list['Indonesia']['Total'])*100; ?>
        <div class="col-lg-2 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats danger box">
                <span class="title">TERSERTIFIKASI</span>
                <span class="value"><?=$list['Indonesia']['Tersertifikasi']?><!--<span class="sub">/763</span>--></span>
                <span class="subtitle"><?=number_format($pct,2,",",".");?>%</span>
                <!--<div class="sparkline-box">
                    <ul class="sparkline-range monthly">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li>8</li>
                        <li>9</li>
                        <li>10</li>
                        <li>11</li>
                        <li>12</li>
                    </ul>
                    <div class="linechart2" data-resize="true" data-values="5,7,2,-4,-2,4,5,6,7,-2,4,2"></div>
                </div>	-->
                <!--<a href="" class="more">
                    <span>View More</span>
                    <i class="icon-chevron-right"></i>
                </a>-->
                <br />
            </div>
        </div><!--/col-->

        <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
            <div class="stats box">
                <span class="title">PENGAKUAN</span>
                <span class="value">0<!--<span class="sub">/135</span>--></span>
                <span class="subtitle">0</span>
                <!--<div class="sparkline-box">
                    <span class="bulletchart">18,2,4,-2,3,1,7,5</span>
                </div>	-->
                <br />
            </div>
        </div><!--/col-->

    </div><!--/row-->
</div>
</div>
<div class="container" style="margin-bottom:20px">
<div class="row">
<div class="col-md-12 content-page">
    
     
     <!-- piet -->
    <div class="row">
        <div class="col-md-7">
          <!-- pie -->
            <div class="row">
                <!--<div class="col-md-6">
                  <h3 class="sub" style="border-bottom:2px solid #aaa">In Progress</h3>
                  <div id="pie1" style="height:180px; width:180px"></div>
                </div>-->
                <div class="col-md-12">
                  <h3 class="sub" style="border-bottom:2px solid #aaa">Teregistrasi</h3>
                  <div id="pie2" style="height:180px; width:180px"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <h3 class="sub" style="border-bottom:2px solid #aaa">Terverifikasi</h3>
                  <div id="pie3" style="height:180px; width:180px"></div>
                </div>
                <div class="col-md-6">
                  <h3 class="sub" style="border-bottom:2px solid #aaa">Tersertifikasi</h3>
                  <div id="pie4" style="height:180px; width:180px"></div>
                </div>
             </div>
             <!--/pie-->
        </div>
        <div class="col-md-5">
          <h3 class="sub" style="border-bottom:2px solid #aaa">Total / Propinsi</h3>
          <div id="piet" style="height:300px; width:300px; margin-top:15%"></div>
        </div>
     </div>
     <!--/piet-->
     
     <!-- bar -->
    <div class="row">
        <div class="col-md-12">
          <h3 class="sub" style="border-bottom:2px solid #aaa">Rekapitulasi Wilayah Adat/Propinsi</h3>
          <div id="chart-rekap" style="height:500px;width:100%;"></div>
        </div>
     <!--/bar-->
    </div>
 </div> <!--col-->
</div><!--end span8-->
</div>

</div>
<script>
var gcColor = ["#268dea","#50b576","#ff8c00","#fb3e46","#3366cc","#109618","#dc3912","#ff9900","#990099","#0099c6","#ccc","#dd4477","#66aa00","#b82e2e","#316395","#dddddd"];
var gcColor5 = ["#268dea","#50b576","#ff8c00","#fb3e46","#3366cc","#ccc"];
var gcColor10 = ["#268dea","#50b576","#ff8c00","#fb3e46","#3366cc","#109618","#dc3912","#ff9900","#990099","#0099c6","#ccc"];
var option = {
	seriesColors: gcColor,
	gridPadding:{top:5,left:0,right:15,bottom:5},
	seriesDefaults:{
		renderer:$.jqplot.PieRenderer,
		shadow: false,
		rendererOptions: { sliceMargin: 1, padding: 8, showDataLabels: true, dataLabelFormatString: "<font style='color:#fff;font-size:9px'>%d%</font>" }
	},
	grid: {
		background: 'rgba(57,57,57,0.0)',
		drawBorder: false,
		shadow: false,
		gridLineColor: '#999',
		gridLineWidth: 1
	},
	legend:{
		show:true,
		background:'transparent',
		border:'1px',
		location:'e',
		rendererOptions: {
			numberRows: 40
		}, 
		marginTop: '15px',
		placement: 'outside'
	},
	highlighter: {
		show: true,
		formatString: "%s %s",
		tooltipLocation: 'auto',
		useAxesFormatters: false
	}
};
var chartPadding = {top:35,bottom:35,right:35};
var chartGrid = {
	background: '#fff',
	drawBorder: false,
	shadow: false,
	gridLineColor: '#ddd',
	gridLineWidth: 1
};
var chartLegend	= {
	renderer: $.jqplot.EnhancedLegendRenderer,
	show: true,
	location:'nw',
	rendererOptions: {
		numberRows:1
	}
};	
var chartHighlighter = {
	show:false,
	showTooltip: false,
	showMarker:false,
	tooltipAxes:'xly',
	useAxesFormatters :true,
	formatString:'%s<br><strong>%s</strong>: %s',// formatString order = tooltipAxes order
	tooltipLocation:'auto'
}
var chartCursor = {
	show:true,
	showTooltip:true,
	tooltipLocation:'auto',
	followMouse:true,
	showVerticalLine:true,
	showCursorLegend:false,
	intersectionThreshold:10,
	showTooltipDataPosition:true,
	useAxesFormatters:true,
	tooltipAxes:'ly',
	tooltipFormatString:'<span style="color:#fff;">%s: <strong>%s</strong></span>',// formatString order = tooltipAxes order
	tooltipSeparator:',',
	tooltipOffset:15,
	showHighlight:true,
	snapToData:true
}
$(document).ready(function () {
	option.seriesColors=gcColor5;
//plotpie1 = $.jqplot('pie1', [p1], option);
	plotpie2 = $.jqplot('pie2', [p2], option);
	plotpie3 = $.jqplot('pie3', [p3], option);
	plotpie4 = $.jqplot('pie4', [p4], option);
	
	option.seriesColors=gcColor10;
	plotpiet = $.jqplot('piet', [pt], option);
	
	var plot1 = $.jqplot('chart-rekap', rekap_stacked, {
		stackSeries: true,
		// seriesColors: ["#f0ad4e","#268dea","#50b576","#fb3e46"],
		seriesColors: ["#268dea","#50b576","#fb3e46"],
		gridPadding:{top:35,bottom:135,right:35},
		grid: chartGrid,
		legend: chartLegend,
		seriesDefaults:{
			renderer:$.jqplot.BarRenderer,
            rendererOptions: {
				 barMargin: 30,
				//fillToZero: true,
				//barWidth:barWidth,
				//barPadding:-barWidth
			},
			shadow:false,
			pointLabels: {show: true}
		},
		series:[
				//{label:'In Progress'},
				{label:'Teregistrasi'},
				{label:'Terverifikasi'},
				{label:'Tersertifikasi'}
		],
		//axesDefaults: chartAxesDefault,
		axes: {
		  xaxis: {
		  	tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
			tickOptions: {
			  angle: -45,
			  fontSize: '9pt'
			},
			renderer: $.jqplot.CategoryAxisRenderer,
			ticks: rekap_series
		  },
		  yaxis: {
			//padMax:2  
			//renderer: $.jqplot.LogAxisRenderer
		  }
		},
		highlighter: chartHighlighter,
		cursor: chartCursor
	  });
});
</script>