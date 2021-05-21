<h3>Create Post</h3>
<?= form_open_multipart('cms/create', 'class=form'); ?>
<label for="title">Title</label>
<input type="text" name="title" id="title" required>
<textarea>
</textarea>
<input type="submit" value="Add Post">
<?= form_close() ?>