<div id="breadcrumbs" class="breadcrumbs-fixed">
<ul class="breadcrumb">
        <li><a href="admin/">Home</a> <span class="divider">/</span></li>
        <li><a href="<?=$this->module?>">Account Manager</a> <span class="divider">/</span></li>
        <li><a href="<?=$this->module?>user_list">Users</a> <span class="divider">/</span></li>
        <li class="active">Delete</li>
    </ul>
</div>

<div style="padding:40px 25px">
<div class="page-header">
	<h1>User <small> Delete </small></h1>
</div>
<br>

<?=message_box();?>

<div class="row-fluid">
<div class="span12">
	
	Are You sure to delete user data:<br>
    <form method="post" action="<?php echo $this->module?>user_delete/<?php echo $data["id"]?>" >
    <input type="hidden" name="act"  value="delete" />
    <table class="table table-condensed table-bordered" style="max-width:500px">
    	<thead class="box_quote">
    	<tr>
        	<th width="200px">User Name</th>
            <th width="200px">First Name</th>
            <th width="200px">Last Name</th>
            <th width="200px">Email</th>
           
        </thead>
        <tr>
        	<td><?php echo $data["username"]?></td>
            <td><?php echo $data["first_name"]?></td>
            <td><?php echo $data["last_name"]?></td>
            <td><?php echo $data["email"]?></td>
        </tr>
    </table>
    
    <div class="form-actions">
        	<button class="btn btn-warning" type="submit"><i class="icon-book icon-white"></i> Ya </button>
        	<a class="btn" href="<?php echo $this->agent->referrer()?>" class="btn btn-warning "><i class="icon-refresh"></i> Back To User List</a>
        </div>
    </form>
    
</div></div><!-- /row-->

<script>
	$(function(){
		var act_link="<?=$this->module?>";		
		$(".sdb_h_active").next().find("a[href$='"+act_link+"']").parent("li").addClass("active");
	})
</script>