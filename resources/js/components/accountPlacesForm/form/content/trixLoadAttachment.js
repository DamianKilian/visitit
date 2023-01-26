function trixLoadAttachment(attachment) {
    uploadFile(attachment.file, progressCallback, successCallback);

    function progressCallback(progress) {
        attachment.setUploadProgress(progress);
    }

    function successCallback(attributes) {
        attachment.setAttributes(attributes);
    }
}

function uploadFile(file, progressCallback, successCallback) {
    var formData = createFormData(file);
    axios({
        method: "post",
        url: trixAttachmentUrl,
        data: formData,
        headers: { "Content-Type": "multipart/form-data" },
        onUploadProgress: function (e) {
            var progress = (e.loaded / e.total) * 100;
            progressCallback(progress);
        },
    })
        .then(function (response) {
            let data = response.data;
            var attributes = {
                id: data.id,
                url: data.url,
                href: data.url + "?content-disposition=attachment",
            };
            successCallback(attributes);
        })
        .catch(function (error) {
            console.log(error);
        });
}

function createFormData(file) {
    var data = new FormData();
    data.append("file", file);
    return data;
}

export default trixLoadAttachment;
