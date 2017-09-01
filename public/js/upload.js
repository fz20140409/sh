/**
 *图片上传
 * @param upload_url 上传图片的url
 * @param delete_url 删除上传图片url
 */
function upload_img(upload_url,delete_url) {
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#upload_dropzone", {
        url: upload_url,
        addRemoveLinks: true,
        dictRemoveFile:'删除',
        paramName:"img",
        acceptedFiles: ".jpg,.jpeg,.png,.gif",//支持的格式
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
                $('#upload_form').append('<input name="img[]" id="file_'+response.id+'" type="hidden" value="'+response.url+'">');
            }

        },
        removedfile: function(file) {
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
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }


    });

}