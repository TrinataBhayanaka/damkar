<?php $teregistrasi=$this->conn->GetOne("select count(idx) as total from wa_data where doc_proses=1 and doc_status=4 and wa_data_status!= 99 ");?>
<?php $terverifikasi=$this->conn->GetOne("select count(idx) as total from wa_data where (doc_proses=2 and doc_status=5 and wa_data_status != 99)");?>
<?php $tersertifikasi=$this->conn->GetOne("select count(idx) as total from wa_data where (doc_proses=3 and doc_status=2 and wa_data_status!=99)");?>
<?php $tidakvaild=$this->conn->GetOne("select count(idx) from wa_data where wa_data_status=99");?>
<?php $total_wa=$this->conn->GetOne("select count(idx) from wa_data");?>

<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        4
                                    </h3>
                                    <p>
                                         Jumlah Kejadian Bencana
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
                                        <!--53<sup style="font-size: 20px">%</sup>-->
                                        12
                                    </h3>
                                    <p>
                                        Jumlah Korban Luka Berat
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-document-text"></i>
                                </div>
                                <a class="small-box-footer" href="#">
                                    <i class="fa"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        30
                                    </h3>
                                    <p>
                                        Jumlah Korban Luka Ringan
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
                                        20
                                    </h3>
                                    <p>
                                        Jumlah Korban Meninggal
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
                <h3 class="box-title">Status Chart  <label style="font-size:12px;color:gray;margin:0 0 0 40px">Jumlah Korban Bencana</label></h3>
            </div>
            <div class="box-body chart-responsive">
                <div id="demo-morris-donut" style="height:212px"></div>
            </div> 
            </div> 
        </div>
        
        <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Status Chart  <label style="font-size:12px;color:gray;margin:0 0 0 40px">Kejadian Bencana Alam 2011 - 2015</label></h3>
            </div>
            <div class="box-body chart-responsive">
                <div id="demo-morris-bar" style="height:212px"></div>
            </div> 
            </div>
        <!-- GRAFIK LEFT 1 
        	<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="area-chart" style="height: 300px;"></div>
            </div> 
            </div> 
            -->
            
            <!-- GRAFIK LEFT 1 
        	<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div> 
            </div>--> 
            
            
            <!-- GRAFIK LEFT 1 -->
        	<!--<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div> 
            </div> -->
            
            <!-- GRAFIK LEFT 1 -->
        	<!--<div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Area Chart</h3>
            </div>
            <div class="box-body chart-responsive">
            <div class="chart" id="stacked" style="height: 300px;"></div>
            </div> 
            </div> -->
        
        	
        </div>

   </div>
   <script>
   		$(document).ready(function() {
            Morris.Bar({
        element: 'demo-morris-bar',
        data: [
            { y: '1', a: 100, b: 90 },
            { y: '2', a: 75,  b: 65 },
            { y: '3', a: 20,  b: 15 },
            { y: '5', a: 50,  b: 40 },
            { y: '6', a: 75,  b: 95 },
            { y: '7', a: 15,  b: 65 },
            { y: '8', a: 70,  b: 100 },
            { y: '9', a: 100, b: 70 },
            { y: '10', a: 50, b: 70 },
            { y: '11', a: 20, b: 10 },
            { y: '12', a: 40, b: 90 },
            { y: '13', a: 70, b: 30 },
            { y: '14', a: 50, b: 50 },
            { y: '15', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        gridEnabled: false,
        gridLineColor: 'transparent',
        barColors: ['#177bbb', '#afd2f0'],
        resize:true,
        hideHover: 'auto'
    });


    Morris.Donut({
        element: 'demo-morris-donut',
        data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
        ],
        colors: [
            '#a6c600',
            '#177bbb',
            '#afd2f0'
        ],
        resize:true
    });

        })
   </script>

               