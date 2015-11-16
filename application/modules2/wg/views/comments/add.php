<br><br>
<div class="row-fluid">
<div class="span12">
<div id="addCommentContainer">
    <h4 class="heading">Add Comment</h4>
    <form id="frm_comment" method="post" action="wg/comments/comments_add_save/">
    	<input type="hidden" name="token" id="token" value="<?=generate_key("comments");?>" />
    	<input type="hidden" name="category" id="category" value="<?=$data_comment["category"]?>"/>
        <input type="hidden" name="post_id" id="post_id" value="<?=$data_comment["post_id"]?>"/>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" >
        <div>
        	<!--<label for="name">Your Name</label>
        	<input type="text" name="name" id="name" />

            <label for="email">Your Email</label>
            <input type="text" name="email" id="email" />

            <label for="body">Comment Body</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>-->
            
            <div class="formSep">
				<div class="row-fluid">
                    <div class="span6">
                        <label>Name<span class="f_req">*</span></label>
                        <input type="text" class="span12" name="name" id="name">
                       <!-- <span class="help-block">help block</span>-->
                    </div>
                    <div class="span6">
                        <label>Email<span class="f_req">*</span></label>
                        <input type="text" class="span12" name="email" id="emailx">
                    </div>
                    
				</div>
			</div>
            <div class="formSep">
            <div class="row-fluid">
                <div class="span12">
            			<label for="url">Website (not required)</label>
            			<input type="text" class="span12" name="url" id="urlx" />
				</div>
            </div></div>
            <div class="formSep">
            <div class="row-fluid">
                <div class="span12">
            			<label for="body">Comment Body</label>
            			<textarea class="span12" name="body" id="body" cols="20" rows="5"></textarea>
				</div>
            </div></div>
            
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