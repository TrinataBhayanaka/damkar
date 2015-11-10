<!--<div class="row-fluid">
<div class="span12">-->
<div id="addCommentContainer">
    <h4 class="heading">Reply Comment</h4>
    <form id="frm_comment_reply" method="post" action="<?=$this->module?>comments_reply_save/">
    	<input type="hidden" name="token" id="token" value="<?=generate_key("comments");?>" />
    	<input type="hidden" name="category" id="category" value="<?=$data_comment["category"]?>"/>
        <input type="hidden" name="post_id" id="post_id" value="<?=$data_comment["post_id"]?>"/>
        <input type="hidden" name="parent_id" id="parent_id" value="<?=$data_comment["parent_id"]?>"/>
        
        <div>
        	<div class="formSep">
				<div class="row-fluid">
                    <div class="span4">
                        <label>Name<span class="f_req">*</span></label>
                        <input type="text" class="span12" name="name" id="name">
                       <!-- <span class="help-block">help block</span>-->
                    </div>
                    <div class="span4">
                        <label>Email<span class="f_req">*</span></label>
                        <input type="text" class="span12" name="email" id="emailx">
                    </div>
                    <div class="span4">
                    	 <label for="url">Website (not required)</label>
            			<input type="text" class="span12" name="url" id="urlx" />
                    </div>
				</div>
			</div>
           
            <!--<label for="name">Your Name</label>
        	<input type="text" name="name" id="name" />
            <label for="email">Your Email</label>
            <input type="text" name="email" id="email" />

            <label for="url">Website (not required)</label>
            <input type="text" name="url" id="url" />
-->
			<div class="formSep">
            <div class="row-fluid">
                <div class="span8">
            			<label for="body">Comment Body</label>
            			<textarea class="span12" name="body" id="body" cols="20" rows="5"></textarea>
				</div>
            </div></div>
            <div class="form-actions">
            <input id="com_reply_save" type="submit" id="submit" value="Submit" />
            </div>
        </div>
    </form>
</div>

<!--</div></div>-->
