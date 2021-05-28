<h3>Update Post</h3>
<?= form_open_multipart('cms/update/' . $id, 'class=form'); ?>
<div class="flex-container form-top-container">
    <div class="flex-container flex-column">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $res['title'] ?>" required>
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
            <span class="span-button" id="upload-button">Add Image</span>
        </div>
        <div class="flex-container flex-column">
            <label for="images">Image Files</label>
            <textarea id="images" name="images" readonly></textarea>
        </div>
    </div>
</div>
<label for="blog-preview">Preview Text</label>
<textarea name="blog-preview" id="blog-preview" required><?= $res['preview'] ?></textarea>
<div class="flex-container flex-space-between">
    <label for="blog-content">Content</label>
    <span class="span-button" id="markup-button">Markup Help</span>
</div>
<textarea name="blog-content" id="blog-content" required><?= $res['content'] ?></textarea>
<div class="error-box">
    <!-- Error Here -->
    <?php if ($hasError)
    { ?>
        <div class="error-msg">Post exists</div>
    <?php } ?>
</div>
<div class="flex-container flex-position-right">
    <div class="flex-container" id="clear-container">
        <!-- <span class="span-button" id="clear-button">Clear Everything</span> -->
        <a onclick="return confirm('Are you sure?')" href="<?= base_url() ?>cms/lists" id="cancel-button" name="cancel">Cancel</a>
    </div>
    <span class="span-button" id="preview-button">Preview</span>
    <input type="submit" value="Update Post">
</div>
<?= form_close() ?>
<div id="preview-container">
</div>
<script>
    let uploadButton = document.querySelector('#upload-button');
    let previewButton = document.querySelector('#preview-button');
    let markupButton = document.querySelector('#markup-button');
    // let clearButton = document.querySelector('#clear-button');
    let categorySelect = document.querySelector('#category');
    let titleData = document.querySelector('#title');
    let previewData = document.querySelector('#blog-preview');
    let contentData = document.querySelector('#blog-content');
    let imageData = document.querySelector('#images');
    let categoryData = document.querySelector('#category');
    let preview = false;
    window.onload = function() {
        // console.log('Select Option Changed!');
        categorySelect.value = '<?= $res['category'] ?>';
    };
    // clearButton.addEventListener("click", function() {
    //     categorySelect.value = 'programming';
    //     titleData.value = '';
    //     previewData.value = '';
    //     contentData.value = '';
    //     imageData.value = '';
    //     saveFormData();
    // });
    markupButton.addEventListener("click", function() {
        alert('<BURL> - base_url of the server, use this when referring to inner resource\n\teg.<img href="<BURL>images/test.png">');
    });
    previewButton.addEventListener("click", function() {
        let previewContainer = document.querySelector('#preview-container');
        if (!preview) {
            previewButton.innerText = "Hide Preview";
            previewContainer.innerHTML = "<h1>" + titleData.value + "</h1>";
            previewContainer.innerHTML += contentData.value.replaceAll(/(\r\n|\n|\r)/gm, "").replaceAll("<BURL>", "<?= base_url() ?>");
            preview = true;
        } else {
            previewButton.innerText = "Preview";
            previewContainer.innerHTML = null;
            preview = false;
        }

    });
    uploadButton.addEventListener("click", function() {
        uploadButton.innerHTML = 'Uploading...';
        let imageFiles = document.querySelector("#images");
        let conn = new XMLHttpRequest();
        let formData = new FormData();
        let files = image.files;
        for (let i = 0; i < files.length; ++i) {
            let file = files[i];
            //Checks if the file is an image
            if (!/image.*/.test(file.type)) {
                continue;
            }
            formData.append(i, file, file.name);
            //Checks if the file is already listed
            let fileName = "images/" + file.name + "\n";
            if (!imageFiles.value.includes(fileName)) {
                imageFiles.value += fileName;
            } else continue;
        };
        conn.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                uploadButton.innerHTML = 'Add Image';
            }
        };
        conn.open('POST', '<?= base_url() ?>cms/upload_image', true);
        conn.send(formData);
    });
</script>