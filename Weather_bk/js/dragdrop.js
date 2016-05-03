(function () {
	var filesUpload = document.getElementById("fileselect"),
		fileList = document.getElementById("file-list");
		
	function uploadFile (file) {
		var li = document.createElement("li"),
			div = document.createElement("div"),			
			reader,
			xhr,
			fileInfo;
			
		li.appendChild(div);
		
		// Present file info and append it to the list of files
		fileInfo = "<div class=\"neutral\">File: <strong>" + file.name + "</strong> with the size <strong>" + parseInt(file.size / 1024, 10) + "</strong> kb is in queue.</div>";
		div.innerHTML = fileInfo;
		
		fileList.appendChild(div);
	}
	
	function traverseFiles (files) {
		if (typeof files !== "undefined") {
			for (var i=0, l=files.length; i<l; i++) {
				uploadFile(files[i]);
			}
		}
		else {
			fileList.innerHTML = "<div class=\"neutral\">Your browser does not support Multiple File Upload, but you can still upload your file. We recommend you to upload to a more modern browser, like <a href=\"http://google.com/chrome\" target=\"_blank\">Google Chrome</a> for example.<div>";
		}	
	}
	
	filesUpload.addEventListener("change", function () {
		traverseFiles(this.files);
	}, false);
	
	dropArea.addEventListener("dragleave", function (evt) {
		var target = evt.target;
		
		if (target && target === dropArea) {
			this.className = "";
		}
		evt.preventDefault();
		evt.stopPropagation();
	}, false);
	
	dropArea.addEventListener("dragenter", function (evt) {
		this.className = "over";
		evt.preventDefault();
		evt.stopPropagation();
	}, false);
	
	dropArea.addEventListener("dragover", function (evt) {
		evt.preventDefault();
		evt.stopPropagation();
	}, false);
	
	dropArea.addEventListener("drop", function (evt) {
		traverseFiles(evt.dataTransfer.files);
		this.className = "";
		evt.preventDefault();
		evt.stopPropagation();
	}, false);										
})();