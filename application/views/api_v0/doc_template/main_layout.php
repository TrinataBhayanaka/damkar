<?=$this->load->view("api_v0/doc_template/header");?>

	  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Documentation</a>
            </div>
            <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav" id="tabs">
               	  <li><a href="#api_documentation" data-toggle="tab">API Documentation</a></li>
                  <li><a href="#components" data-toggle="tab">Components</a></li>
                  <!--<li><a href="#about" data-toggle="tab">About</a></li>-->
               </ul>
            </div>
            <!--/.nav-collapse -->
         </div>
      </div>
      
      <div class="content container tab-content">
         <div class="tab-pane active" id="home">
            <?php //echo $content_home;?>
            <!--
            <div class="jumbotron">
               <h1>Some Framework</h1>
               <p>This is a template for a documentation website for a programming framework or library. It includes a template for components description with a navigation list.</p>
               <p><a href="#" class="btn btn-primary btn-lg" role="button">Download &darr;</a></p>
            </div>
            -->
         </div>
         
         <div class="tab-pane" id="api_documentation">
         	 <div class="row">
               <!--<div class="col-sm-3">
                  <div class="list-group">
                     <a href="#propinsi" class="list-group-item">Propinsi</a>
                     <a href="#kabupaten" class="list-group-item">Kabupaten</a>
                  </div>
               </div>-->
               <!-- /.col-sm-4 -->
               <div class="col-sm-12">
               		<!-- <h3>API Documentation</h3>
                  	 <p class="lead">List API in TOPONIMI Batas Wilayah</p>
                  	--> 
                     <h3>API Documentation</h3>
                       
                        <table class="table table-bordered table-hover table-striped table-condensed">
                          <thead>
                            <tr>
                              <th style="width: 150px;">REST API</th>
                              <th>Feature</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="#batas_wilayah">Propinsi</a></td>
                              <td>Data Batas Wilayah Propinsi</td>
                            </tr>
                            
                            <tr>
                              <td><a href="#propinsi">Kabupaten</a></td>
                              <td>Data Batas Wilayah Kabupaten</td>
                            </tr>
                            
                          </tbody>
                       </table>
                     
                     <hr>
                     
                     <div id="propinsi" class="content section">
                     	<h4>Service Data Batas Wilayah Propinsi</h4>
                        
                  		 <table class="table table-bordered table-hover table-striped table-condensed">
                          <thead>
                            <tr>
                              <th style="width:400px">Data</th>
                              <th>Description</th>
                              <th>Test URL</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>/GET toponimi/api_v0/batas_wilayah/propinsi/</a></td>
                              <td>Data Batas Wilayah Propinsi </td>
                              <td><a href="<?=base_url()?><?=$this->module?>propinsi/"><?=$this->base_url?><?=$this->module?>propinsi/</a>
                              </td>
                            </tr>
                            
                            <tr>
                              <td>/GET toponimi/api_v0/batas_wilayah/propinsi/[:id_propinsi]</a></td>
                              <td>Pencarian data batas propinsi berdasarkan id_propinsi (kode bps) </td>
                              <td><a href="<?=base_url()?><?=$this->module?>propinsi/11"><?=$this->base_url?><?=$this->module?>propinsi/11</a>
                              </td>
                            </tr>
                       
                            </tbody>
                            </table>
                        	
                        
                     </div>
                     <div id="kabupaten" class="content section">
                  		<h4>Service Data Batas Wilayah Kabupaten</h4>
                        
                  		 <table class="table table-bordered table-hover table-striped table-condensed">
                          <thead>
                            <tr>
                              <th style="width:400px">Data</th>
                              <th>Description</th>
                              <th>Test URL</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>/GET toponimi/api_v0/batas_wilayah/kabupaten/</a></td>
                              <td>Data Batas Wilayah Kabupaten </td>
                              <td><a href="<?=base_url()?><?=$this->module?>kabupaten/"><?=$this->base_url?><?=$this->module?>kabupaten/</a>
                              </td>
                            </tr>
                            
                            <tr>
                              <td>/GET toponimi/api_v0/batas_wilayah/kabupaten/[:id_propinsi]</a></td>
                              <td>Pencarian data batas kabupaten berdasarkan id_kabupaten(kode bps) </td>
                              <td><a href="<?=base_url()?><?=$this->module?>kabupaten/"><?=$this->base_url?><?=$this->module?>kabupaten/<?=$this->conn->GetOne("select id_kabupaten_1 from ".$this->model_kabupaten->tbl)?></a>
                              </td>
                            </tr>
                       
                            </tbody>
                            </table>
                        	
                          
                          
                          
                     </div>
                     
                      <hr>
                      <div class="content">
                         <p>End of batas wilayah api</p>
                      </div>
               </div>
               </div><!-- END ROEW-->
         </div>
         
         
         <div class="tab-pane" id="components">
            <?=$this->load->view("api_v0/doc_template/content_component");?>
         </div>
         <div class="tab-pane" id="about">
            <h1>About</h1>
            <p class="lead">This section is for about and resources.</p>
         </div>
      </div>
      <!-- /.container -->


<?=$this->load->view("api_v0/doc_template/footer");?>