<div class="row-fluid">
<div class="span12">
<div id="addCommentContainer">
    <h4 class="heading">Add Comment</h4>
    <form id="frm_comment_reply" method="post" action="<?=$this->module?>comments_reply_save/">
    	<input type="text" name="category" id="category" value="<?=$data_comment["category"]?>"/>
        <input type="text" name="post_id" id="post_id" value="<?=$data_comment["post_id"]?>"/>
        <input type="text" name="parent_id" id="parent_id" value="<?=$data_comment["parent_id"]?>"/>
        
        <div>
        	<label for="name">Your Name</label>
        	<input type="text" name="name" id="name" />

            <label for="email">Your Email</label>
            <input type="text" name="email" id="email" />

            <label for="url">Website (not required)</label>
            <input type="text" name="url" id="url" />

            <label for="body">Comment Body</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
			<div class="form-actions">
            <input id="com_reply_save" type="submit" id="submit" value="Submit" />
            </div>
        </div>
    </form>
</div>

</div></div>