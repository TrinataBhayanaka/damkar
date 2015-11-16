<div class="row-fluid">
<div class="span6">
<div id="addCommentContainer">
    <h4 class="heading">Add Comment</h4>
    <form id="frm_comment" method="post" action="<?=$this->module?>comments_add_save/">
    	<input type="text" name="category" id="category" value="<?=$data_comment["category"]?>"/>
        <input type="text" name="post_id" id="post_id" value="<?=$data_comment["post_id"]?>"/>
        <div>
        	<label for="name">Your Name</label>
        	<input type="text" name="name" id="name" />

            <label for="email">Your Email</label>
            <input type="text" name="email" id="email" />

            <label for="body">Comment Body</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
			<div class="form-actions">
            <input id="com_add_save" type="submit" id="submit" value="Submit" />
            </div>
        </div>
    </form>
    
    
</div>

</div></div>

<!--<form class="well span6" id="frm_comment" method="post" action="<?=$this->module?>comments_add_save/">
  <div class="row-fluid">
		<div class="span4">
			<label>Name</label>
			<input type="text" placeholder="Name" id="name" name="name" class="span12">
			<label>Email Address</label>
			<input type="text" placeholder="Your email address" id="email" name="email" class="span12">
        </div>
		<div class="span8">
			<label>Body</label>
			<textarea rows="4" class="input-xlarge span12" id="body" name="body"></textarea>
		</div>
	
		 <input id="com_add_save" type="submit" name="com_add_save" value="Submit" />
	</div>
</form></div>-->