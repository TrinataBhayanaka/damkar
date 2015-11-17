<html>
<head>
    <title>HTML to PDF Converter - Repeat Table Head on Each PDF Page</title>
    <style type='text/css'>
        thead
        {
            display: table-header-group;
        }
        .style1
        {
            width: 62px;
        }
        .style2
        {
            width: 88px;
        }
		
		@page {
			margin-top: 4cm;
			margin-bottom: 2.0cm;
			margin-left: 2.3cm;
			margin-right: 1.7cm;
			margin-header: 8mm;
			margin-footer: 8mm;
			header: html_myheader;
			footer: html_myfooter;
			background-color:#ffffff;
			}
		@page :first {
			margin-top: 6cm;
			margin-bottom: 2cm;
			header: html_myheader;
			footer: _blank;
			resetpagenum: 1;
			/*background-gradient: linear #FFFFFF #FFFF44 0 0.5 1 0.5;
			background: #ccffff url(bgbarcode.png) repeat-y fixed left top;*/
		}
    </style>
</head>
<body style="">
	  
<htmlpageheader name="myheader">
   <?=$this->load->view("test_pdf/test_header");?>
 </htmlpageheader>


<htmlpagefooter name="myfooter">
    <?=$this->load->view("test_pdf/test_footer");?>
</htmlpagefooter>
<!--<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />-->


    <table style="border: 1px solid #000000; padding: 1px; margin: 1px; width: 950px;
        font-family: Verdana; font-size: 12px;border-collapse:collapse"  border="1px" table-repeat-header="1">
        <thead>
            <tr>
                <th class="style2" style="text-align: center">
                    <img height="48px" src="img/usericon.jpg" /><br />
                    Employee ID
                </th>
                <th>
                    National ID Number
                </th>
                <th>
                    Contact ID
                </th>
                <th>
                    Manager ID
                </th>
                <th class="style1">
                    Employee Function
                </th>
                <th>
                    <img height="48px" src="img/calendar.jpg" /><br />
                    Birth Date
                </th>
                <th>
                    <img height="48px" src="img/clock.jpg" /><br />
                    Hire Date
                </th>
                <th>
                    Vacation Hours
                </th>
                <th>
                    Sick Leave Hours
                </th>
                <th>
                    Modified Date
                </th>
                <th style="background-color: #cecece">
                    Marital Status
                </th>
                <th style="background-color: #cecece">
                    Gender
                </th>
                <th style="background-color: #cecece">
                    Salaried Flag
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="style2" style="text-align: center">
                    1
                </td>
                <td>
                    14417807
                </td>
                <td>
                    1209
                </td>
                <td>
                    16
                </td>
                <td class="style1">
                    Production Technician - WC60
                </td>
                <td>
                    5/15/1972
                </td>
                <td>
                    7/31/1996
                </td>
                <td>
                    21
                </td>
                <td>
                    30
                </td>
                <td>
                    7/31/2004
                </td>
                <td style="text-align: center">
                    M
                </td>
                <td style="text-align: center">
                    M
                </td>
                <td style="text-align: center">
                    0
                </td>
            </tr>
            <? for($i=0;$i<=100;$i++):?>
           	<? if($i>99):
		   		$dataterakhir[]=$val;
		   	  	
				continue;
			  endif;
           	?>
            <tr>
                <td class="style2" style="text-align: center">
                    2
                </td>
                <td>
                    253022876
                </td>
                <td>
                    1030
                </td>
                <td>
                    6
                </td>
                <td class="style1">
                    Marketing Assistant
                </td>
                <td>
                    6/3/1977
                </td>
                <td>
                    2/26/1997
                </td>
                <td>
                    42
                </td>
                <td>
                    41
                </td>
                <td>
                    7/31/2004
                </td>
                <td style="text-align: center">
                    S
                </td>
                <td style="text-align: center">
                    M
                </td>
                <td style="text-align: center">
                    0
                </td>
            </tr>
           
		   <? endfor;?> 
           
           
        </tbody>
    </table>
    
    
    <div style="float:right;margin-top:100px">
    	<? echo $data_terakhir?>
        
        INI TANDA TANGAN
    </div>
    
</body>
</html>