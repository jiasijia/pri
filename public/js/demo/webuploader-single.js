function initWebUploader(settings) {
    if( !settings) {
        settings = {};
    }
    var pick = settings.pick || '#filePicker';
    var fileList = settings.fileList || '#fileList';
    var imageClass = settings.imageClass || '';
    var imageWith = settings.imageWith || '128';
    var imageHeight = settings.imageHeight || '';
    var inputName = settings.inputName || 'image';
    var url = settings.url || '';
    var data = settings.data || {};

    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // 文件接收服务端。
        server: url,
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: {'id' : pick, 'multiple' : false},
        fileNumLimit: 1,
        formData: data,
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on('fileQueued', function( file ) {
        $(pick).find('.webuploader-pick').text('上传中...').nextAll().hide();
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadAccept', function( file, ret) {
        if (ret.result !== true) {
            return false;
        }
        return true;
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function(file, resopnse) {
        var imageView = '?imageView2/1';
        if (imageWith) {
            imageView += '/w/' + imageWith;
        }
        if (imageHeight) {
            imageView += '/h/' + imageHeight;
        }
        var $li = $(
            '<div id="' + file.id + '" >' +
            '<img class="'+imageClass+'" src="'+ resopnse.image + imageView +'">' +
            '<input type="hidden" name="'+inputName+'" value="'+ resopnse.image +'">' +
            '</div>'
        );
        $(fileList).html($li);
    });
    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file ) {
        alert('上传失败,请重试');
    });
    uploader.on( 'uploadComplete', function( file ) {
        $(pick).find('.webuploader-pick').text('选择图片').nextAll().show();
        uploader.removeFile(file, true);
    });
}