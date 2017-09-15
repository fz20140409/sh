/**
 *
 * @param upload_url 上传地址
 * @param delete_url 删除地址
 * @param upload_dropzone 初始的元素(jquery对象)
 * @param upload_form 表单(jquery对象)
 * @param acceptedFiles 支持的格式
 */
function upload_img(upload_url,delete_url,upload_dropzone,upload_form,acceptedFiles,maxFilesize,maxFiles) {
    var myDropzone = upload_dropzone.dropzone({
        url: upload_url,
        maxFilesize: maxFilesize, //MB
        maxFiles:maxFiles,//一次性上传的文件数量上限
        dictMaxFilesExceeded: "您最多只能上传{{maxFiles}}个文件！",
        dictFileTooBig:"文件太大 ({{filesize}}MB). 最大: {{maxFilesize}}MB.",
        dictInvalidFileType:"不支持此类型",
        addRemoveLinks: true,
        dictRemoveFile:'删除',
        paramName:"file",
        acceptedFiles: acceptedFiles,//支持的格式
        method: 'post',
        dictCancelUpload:'取消上传',
        filesizeBase: 1024,
        sending: function(file, xhr, formData) {
            formData.append("filesize", file.size);
        },
        success: function (file, response, e) {
            //上传失败,展示错误
            if(response.error){
                layer.msg(response.error);
                return false;
            }
            //上传成功
            if(response.status=200){
                file.id=response.id;
                //表单追加表单
               upload_form.append('<input name="file[]" id="file_'+response.id+'" type="hidden" value="'+response.url+'">');
            }

        },
        removedfile: function(file) {
           if(file.status=="success"){
               var id = file.id;
               $.ajax({
                   type: 'POST',
                   url: delete_url,
                   data: {"id":id},
                   success:function (response) {
                       //上传失败,展示错误
                       if(response.error){
                           layer.msg(response.error);
                           return false;
                       }
                       if(response.status=200){
                           $("#file_"+id).remove();
                           layer.msg('删除成功');
                       }


                   }
               });
           }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }


    });

    return myDropzone;

}