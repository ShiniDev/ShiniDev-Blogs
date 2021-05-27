const uploadButton = document.querySelector('span[class="span-button"]');
uploadButton.addEventListener("click", function () {
	let imageFiles = document.querySelector("#images");
	let conn = new XMLHttpRequest();
	let formData = new FormData();
	let files = images.files;
	for (let i = 0; i < files.length; ++i) {
		let file = files[i];
        if (!/image.*/test(file.type)){
            continue;
        }
        formData.append(i,file,file.name);
        imageFiles.value += file.name + "\n";
	};
    conn.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    conn.open('POST');
});
