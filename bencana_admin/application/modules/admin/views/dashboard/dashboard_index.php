<?php $teregistrasi=$this->conn->GetOne("select count(idx) as total from wa_data where doc_proses=1 and doc_status=4 and wa_data_status!= 99 ");?>
<?php $terverifikasi=$this->conn->GetOne("select count(idx) as total from wa_data where (doc_proses=2 and doc_status=5 and wa_data_status != 99)");?>
<?php $tersertifikasi=$this->conn->GetOne("select count(idx) as total from wa_data where (doc_proses=3 and doc_status=2 and wa_data_status!=99)");?>
<?php $tidakvaild=$this->conn->GetOne("select count(idx) from wa_data where wa_data_status=99");?>
<?php $total_wa=$this->conn->GetOne("select count(idx) from wa_data");?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

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
                <div id="demo-morris-donut" style="height:300px"></div>
            </div> 
            </div> 
        </div>
        
        <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header">
            <h3 class="box-title">Status Chart  <label style="font-size:12px;color:gray;margin:0 0 0 40px">Kejadian Bencana Alam 2011 - 2015</label></h3>
            </div>
            <div class="box-body chart-responsive">
                <div id="demo-morris-bar" style="height:300px"></div>
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
</section>
   <script>
   		$(document).ready(function() {
            Morris.Bar({
        element: 'demo-morris-bar',
        data: [
            { y: '2011', a: 100, b: 90, c: 80, d: 70 },
            { y: '2012', a: 75,  b: 65, c: 55, d: 45 },
            { y: '2013', a: 20,  b: 15, c: 10, d: 5 },
            { y: '2014', a: 50,  b: 40, c: 30, d: 20},
            { y: '2015', a: 75,  b: 95, c: 85, d: 65 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'd'],
        labels: ['Tsunami', 'Gempa Bumi', 'Tornado', 'Banjir'],
        gridEnabled: false,
        gridLineColor: 'transparent',
        barColors: ['#177bbb'],
        resize:true,
        hideHover: 'auto'
    });


    Morris.Donut({
        element: 'demo-morris-donut',
        data: [
            {label: "Jumlah Bencana", value: 4},
            {label: "Luka Berat", value: 12},
            {label: "Luka Ringan", value: 30},
            {label: "Meninggal", value: 20}
        ],
        colors: [
            '#00C0EF',
            '#00A65A',
            '#F39C12',
            '#DD4B39'
        ],
        resize:true
    });

        })
   </script>

               