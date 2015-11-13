<div class="row">
    <div class="col-sm-12 col-lg-12">
        <!-- start: page header -->
        <div class="page-header">
            <div class="row"> 
                <div class="col-md-12">
                    <h1><?=$this->module_title?><small> </small></h1>
                </div><!-- col -->
              </div><!-- row-->
        </div><!-- end: page-header -->
        
        <!-- start: breadcrumbs -->
         <ul class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class='icon-home blue'></i> Home</a> <span class="divider"></span></li>
            <li><a href="<?=$this->module?>"><?=$this->module_title?></a> <span class="divider"></span></li>
        	<li class="active">View</li>
         </ul>
        <!-- end: breadcrumbs -->
        
   </div><!-- cols -->
</div> <!-- row -->
<? $id=$this->encrypt_status==TRUE?encrypt($data["idx"]):$data["idx"];?>
<div class="row topbar box_shadow">
    <div class="col-md-12">
    	<ul class="tab-bar grey-tab">
                <li>
                    <a href="<?=$this->module?>listview/">
                        <span class="block text-center">
                            <i class="icon-list"></i> 
                        </span>
                        Daftar <?=$this->module_title?>
                    </a>
                </li>
                <li>
                    <a href="<?=$this->module?>add/">
                        <span class="block text-center">
                            <i class="icon-plus"></i> 
                        </span>
                        Input <?=$this->module_title?>
                    </a>
                </li>
                
                 <li class="active">
                    <a href="javascript:void(0)">
              
                        <span class="block text-center">
                            <i class="icon-search"></i> 
                        </span>
                        View <?=$this->module_title?>
                    </a>
                </li>
                
                 <li>
                    <a href="<?=$this->module?>edit/<?=$id?>">
                  		<span class="block text-center">
                            <i class="icon-pencil"></i> 
                        </span>
                        Edit <?=$this->module_title?>
                    </a>
                </li>
               
                <li class="pull-right">
                    <a class='red' onclick="return confirm('Anda yakin akan menghapus data ini?');" href="<?=$this->module?>del/<?=$id?>">
                        <span class="block text-center">
                            <i class="icon-remove red"></i> 
                        </span>
                        Delete <?=$this->module_title?>
                    </a>
                </li>
                
            </ul>
       
    	
    </div>
</div>


<div class="row">
	<div class="col-sm-12">
    <h5 class="heading">Entitas</h5>
    <table>
    	<tr><td style="width:200px" class="strong"><?=$data["name"]?></td></tr>
    </table>
   
    </div>
</div>

<?=loadFunction("colorbox");?>
<script>
$(function(){
	$(".file[href$=jpg],.file[href$=jpeg],.file[href$=png],.file[href$=bmp]").colorbox();
});
</script>