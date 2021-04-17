<div>
    <input type="file" name="{{ $type }}" data-fileuploader-files="{{$preloadMedia}}">
</div>
@push('styles')
<link rel="stylesheet" href="{{ asset('js/plugins/fileuploader/font/font-fileuploader.css') }}" media="all">
<link rel="stylesheet" href="{{ asset('js/plugins/fileuploader/jquery.fileuploader.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/fileuploader/jquery.fileuploader-theme-thumbnails.css') }}">
<style>
    .fileuploader-theme-thumbnails .fileuploader-thumbnails-input,
    .fileuploader-theme-thumbnails .fileuploader-items-list .fileuploader-item {
        position: relative;
        display: inline-block;
        margin: 16px 0 0 16px;
        padding: 0;
        vertical-align: top;
        width: 100px;
        height: 100px;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
<script>
    jQuery(document).ready(function() {
        var isCropperOpen=false;
        var file_options={
            limit:5,
            enableApi: true,
            extensions: ['jpeg','jpg','png','mkv','mp4'],
            changeInput: ' ',
            clipboardPaste:4,
            theme: 'thumbnails',
            addMore: true,
            editor: {
                cropper: {
                    ratio: '1:1',
                    minWidth: 256,
                    minHeight: 256,
                    showGrid: true
                },
                quality: 0.98,
                maxWidth: 1080,
                maxHeight: 1080,
            },
            beforeSelect: function(files, listEl, parentEl, newInputEl, inputEl) {
                var prev_files=media_api.getFiles(),flag=false;
                var selected_file=[];
                for (let i = 0; i < files.length; i++) {
                    selected_file.push(files[i]);
                }
                let prev_image_length=prev_files.filter(ele=>ele.format=="image").length,
                    current_image_length=selected_file.filter(ele=>ele.type.split('/')[0]=="image").length,
                    prev_video_length=prev_files.filter(ele=>ele.format=="video").length,
                    current_video_length=selected_file.filter(ele=>ele.type.split('/')[0]=="video").length;

                let file_only_length=selected_file.length+prev_files.length;
                let image_only_length = prev_image_length + current_image_length;
                let video_only_length = prev_video_length + current_video_length;

                if(file_only_length>5){
                    Swal.fire("Only 5 media(4 -Images & 1 video) can upload");
                }else if(image_only_length>4){
                    Swal.fire("Only 4 images can upload");
                }else if(video_only_length>1){
                    Swal.fire("Only 1 video can upload or not");
                }else{
                    flag=true;
                }
                return flag;
            },
            dialogs: {
                alert: function(text) {
                    return Swal.fire(text);
                },
                confirm: function(text, callback) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        customClass: {
                            confirmButton: 'btn btn-danger m-1',
                            cancelButton: 'btn btn-secondary m-1'
                        },
                        confirmButtonText: 'Yes',
                        html: false,
                    }).then(result => {
                        if (result.value) {
                          return callback()
                        }
                        else return null
                    });
                }
            },
            thumbnails: {
                box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list">' +
                    '<li class="fileuploader-thumbnails-input">' +
                    '<div class="fileuploader-thumbnails-input-inner"><i>+</i></div>' +
                    '</li>' +
                    '</ul>' +
                    '</div>',
                item: '<li class="fileuploader-item file-has-popup">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder">' +
                    '<h5>${name}</h5><span>${size2}</span>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
                item2: '<li class="fileuploader-item file-has-popup">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="type-holder">${extension}</div>' +
                    '<div class="actions-holder">' +
                    '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download> <i></i></a> ' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                    '</div>' +
                    '<div class="thumbnail-holder">' +
                    '${image}' +
                    '<span class="fileuploader-action-popup"></span>' +
                    '</div>' +
                    '<div class="content-holder">' +
                    '<h5>${name}</h5><span>${size2}</span>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
                startImageRenderer: true,
                canvasImage: false,
                _selectors: {
                    list: '.fileuploader-items-list',
                    item: '.fileuploader-item',
                    remove: '.fileuploader-action-remove',
                },
                onImageLoaded: function(item,listEl, parentEl, newInputEl, inputEl) {
                        if (typeof item.file!='string' &&item.reader.node && item.reader.width && !item.hasPopupOpened && !isCropperOpen) {
                            isCropperOpen=true;
                            item.hasPopupOpened = true;
                            item.popup.open();
                            item.editor.cropper();
                        }
                },
                onItemShow: function (item, listEl, parentEl, newInputEl, inputEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = jQuery.fileuploader.getInstance(inputEl.get(0));

                    plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ?
                        'hide' : 'show']();

                    if (item.format == 'image') {
                        item.html.find('.fileuploader-item-icon').hide();
                    }
                },
                onItemRemove: function (html, listEl, parentEl, newInputEl, inputEl) {
                    var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                        api = jQuery.fileuploader.getInstance(inputEl.get(0));

                    html.children().animate({ 'opacity': 0 }, 200, function () {
                        html.remove();

                        if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit) plusInput.show();
                    });
                },
                popup: {
                    onShow: function(item) {
                        item.popup.html.on('click', '[data-action="prev"]', function (e) {
                            item.popup.move('prev');
                        }).on('click', '[data-action="next"]', function (e) {
                            item.popup.move('next');
                        }).on('click', '[data-action="crop"]', function (e) {
                            if (item.editor)
                                item.editor.cropper();
                        }).on('click', '[data-action="rotate-cw"]', function (e) {
                            if (item.editor)
                                item.editor.rotate();
                        }).on('click', '[data-action="remove"]', function(e) {
                            item.popup.close();
                            item.remove();
                        }).on('click', '[data-action="cancel"]', function(e) {
                            let { width=1,height=0 } = 'crop' in item.editor?item.editor.crop:item.reader;
                            if(Math.round(width)==Math.round(height)){
                                item.popup.close();
                                isCropperOpen=false;
                            }else if (item.reader.ratio == '1:1') {
                                item.popup.close();
                                isCropperOpen=false;
                            } else{
                                alert('Please crop your image in 1:1 ratio and save')
                            }
                        }).on('click', '[data-action="save"]', function(e) {
                            if (item.editor)
                                item.editor.save();
                            if (item.popup.close)
                                item.popup.close();
                            isCropperOpen=false;
                        });
                    },
                },
            },
            dragDrop: { container: '.fileuploader-thumbnails-input' },
            afterRender: function (listEl, parentEl, newInputEl,
                inputEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = jQuery.fileuploader.getInstance(inputEl.get(0)); plusInput.on('click', function () { api.open(); });
            },
        };
        var [{!! $type !!}]=jQuery('input[name="{!! $type !!}"]').fileuploader(file_options);
        window["{!! $type !!}_api"]=jQuery.fileuploader.getInstance({!! $type !!});
    });
</script>
@endpush
