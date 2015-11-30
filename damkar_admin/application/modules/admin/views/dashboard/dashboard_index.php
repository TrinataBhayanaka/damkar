
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    <?=$jumlahPersonel?>
                </h3>
                <p>
                     Jumlah Personel
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-document"></i>
            </div>
            <a class="small-box-footer" href="#">
                <i class="fa"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    <?=$jumlahPNS?>
                </h3>
                <p>
                    Jumlah PNS
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-document-text"></i>
            </div>
            <a class="small-box-footer" href="#">
                <i class="fa"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>
                    <?=$jumlahPNS?>
                </h3>
                <p>
                    Jumlah NON PNS
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-information-circled"></i>
            </div>
            <a class="small-box-footer" href="#">
                <i class="fa"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                   <?=$jumlahSertifikasi?>
                </h3>
                <p>
                    Jumlah Personel Bersertifikasi
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-clipboard"></i>
            </div>
            <a class="small-box-footer" href="#">
                <i class="fa"></i>
            </a>
        </div>
    </div><!-- ./col -->
    
</div>
                    
   <div class="formSep"></div>
   
   <div class="row">
   		<div class="col-md-6">
        	<!-- GRAFIK LEFT 1 -->
        	<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Chart Status Kerja Personel</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="donat" style="height: 300px;"></div>
            </div> 
            </div> 
        </div>
        
        <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Chart Status Personel Bersertifikasi</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="donat-right" style="height: 300px;"></div>
            </div> 
            </div>
        <!-- GRAFIK LEFT 1 
            -->
        	<!-- <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="area-chart" style="height: 300px;"></div>
            </div> 
            </div>  -->
            
            <!-- GRAFIK LEFT 1 --> 
        	<!-- <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div> 
            </div> -->
            
            
            <!-- GRAFIK LEFT 1 -->
        	<!-- <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div> 
            </div>  -->
            
            <!-- GRAFIK LEFT 1 -->
        <!-- 	<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="stacked" style="height: 300px;"></div>
            </div> 
            </div>  -->
        
        	
        </div>

   </div>
   <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
   <script>
   		$(function(){
			//DONUT CHART
                var donut = new Morris.Donut({
                    element: 'donat',
                    resize: true,
                    colors: ["#3c8dbc", "#00a65a", "#FF9900"],
                    data: [
                        {label: "Jumlah Personel", value: <?=$jumlahPersonel?>},
                        {label: "Jumlah PNS", value: <?=$jumlahPNS?>},
						{label: "Jumlah Non PNS", value: <?=$jumlahNonPNS?>},
                    ],
                    hideHover: 'auto'
                });
				var donut = new Morris.Donut({
                    element: 'donat-right',
                    resize: true,
                    colors: ["#3c8dbc","#FF0000","#669999"],
                    data: [
                        {label: "Jumlah Personel", value: <?=$jumlahPersonel?>},
                        {label: "Jumlah Bersertifikasi", value: <?=$jumlahSertifikasi?>},
						{label: "Jumlah Belum Pelatihan", value: <?=$jumlahBSertifikasi?>},
					
                    ],
                    hideHover: 'auto'
                });
		});
		
		
		var data = [
		  { y: '2014', a: 50, b: 90},
		  { y: '2015', a: 65,  b: 75},
		  { y: '2016', a: 50,  b: 50},
		  { y: '2017', a: 75,  b: 60},
		  { y: '2018', a: 80,  b: 65},
		  { y: '2019', a: 90,  b: 70},
		  { y: '2020', a: 100, b: 75},
		  { y: '2021', a: 115, b: 75},
		  { y: '2022', a: 120, b: 85},
		  { y: '2023', a: 145, b: 85},
		  { y: '2024', a: 160, b: 95}
		],
		config = {
		  data: data,
		  xkey: 'y',
		  ykeys: ['a', 'b'],
		  labels: ['Total Income', 'Total Outcome'],
		  fillOpacity: 0.6,
		  hideHover: 'auto',
		  behaveLikeLine: true,
		  resize: true,
		  pointFillColors:['#ffffff'],
		  pointStrokeColors: ['black'],
		  lineColors:['gray','red']
	  };
	  
		config.element = 'area-chart';
		Morris.Area(config);
		config.element = 'line-chart';
		Morris.Line(config);
		config.element = 'bar-chart';
		Morris.Bar(config);
		config.element = 'stacked';
		config.stacked = true;
		Morris.Bar(config);
		
		
		Morris.Donut({
		  element: 'pie-chart',
		  data: [
			{label: "Friends", value: 30},
			{label: "Allies", value: 15},
			{label: "Enemies", value: 45},
			{label: "Neutral", value: 10}
		  ]
		});
   	
   </script>

               