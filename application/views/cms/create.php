<h3>Create Post</h3>
<?= form_open_multipart('cms/create', 'class=form'); ?>
<div class="flex-container">
    <div class="flex-container flex-column">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>
        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="programming">Programming</option>
            <option value="devlogs">Devlogs</option>
            <option value="tips">Tips</option>
            <option value="projects">Projects</option>
            <option value="learnings">Learnings</option>
        </select>
    </div>
    <div class="flex-container flex-column">
        <div class="flex-container" name="image-container">
            <input type="file" name="image" id="image" multiple="multiple">
            <span class="span-button">Add Image</span>
        </div>
        <div class="flex-container flex-column">
            <label for="images">Image Files</label>
            <textarea id="images" name="images" readonly></textarea>
        </div>
    </div>
</div>
<label for="blog-preview">Preview Content</label>
<textarea name="blog-preview" id="blog-preview">
</textarea>
<label for="blog-content">Content</label>
<textarea name="blog-content" id="blog-content" required>
</textarea>
<input type="submit" value="Add Post">
<?= form_close() ?>
<script>
    const uploadButton = document.querySelector('span[class="span-button"]');
    uploadButton.addEventListener("click", function() {
        console.log('Uploading...')
        uploadButton.innerHTML = 'Uploading...';
        let imageFiles = document.querySelector("#images");
        let conn = new XMLHttpRequest();
        let formData = new FormData();
        let files = image.files;
        for (let i = 0; i < files.length; ++i) {
            let file = files[i];
            if (!/image.*/.test(file.type)) {
                continue;
            }
            formData.append(i, file, file.name);
            let fileName = "images/" + file.name + "\n";
            if (!imageFiles.value.includes(fileName)) {
                imageFiles.value += fileName;
            } else continue;
        };
        conn.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                uploadButton.innerHTML = 'Add Image';
                console.log('Upload Success')
            }
        };
        conn.open('POST', '<?= base_url() ?>cms/upload_image', true);
        conn.send(formData);
    });

    function saveFormData() {
        let titleData = document.querySelector('#title');
        let previewData = document.querySelector('#blog-preview');
        let contentData = document.querySelector('#blog-content');
        let imageData = document.querySelector('#images');

    }
</script>