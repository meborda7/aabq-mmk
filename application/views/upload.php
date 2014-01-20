<form enctype="multipart/form-data" action="<?php echo base_url() . "home/do_upload"; ?>" method="POST">
	<input type="file" name="file[]" multiple />
	<input type="submit">
</form>