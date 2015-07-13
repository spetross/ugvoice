<?php
$templateId = 'image_multi_' . $uniqueId;
?>
<div
    id="<?= $uniqueId ?>"
    class="field-fileupload is-multi <?= count($fileList) ? 'has-attachments' : '' ?> is-sortable"
    data-control="fileupload"
    data-url="<?= route('file.upload') ?>"
    data-unique-id="<?= $uniqueId ?>"
    data-sort-handler="onSortAttachments"
    data-image-width="<?= $imageWidth ?>"
    data-image-height="<?= $imageHeight ?>"
    <?php if ($acceptedFileTypes): ?>data-file-types="<?= $acceptedFileTypes ?>"<?php endif ?>
    data-item-template="<?= $templateId ?>">

    <div class="image-multi">
        <ul>
            <!-- Add New Image -->
            <li class="attachment-item attachment-uploader"
                style="width: <?= $imageWidth . 'px' ?>; height: <?= $imageHeight . 'px' ?>">
                <a href="javascript:;" class="uploader-link no-attachment">
                    <table>
                        <tr>
                            <td class="icon"><i class="large plus icon"></i></td>
                        </tr>
                    </table>
                </a>

                <div class="uploader-progress">
                    <div class="uk-progress uk-progress-mini progress-bar">
                        <div class="uk-progress-bar" style="width: 50%;"></div>
                    </div>
                </div>
                <div class="uploader-loading"></div>
            </li>
        </ul>
    </div>

    <!-- Populated Image -->
    <script type="text/template" id="<?= $templateId ?>">
        <li>
            <div
                class="attachment-item"
                data-attachment-id="{{id}}"
                style="width: <?= $imageWidth . 'px' ?>; height: <?= $imageHeight . 'px' ?>">

                <a href="{{path}}" target="_blank" class="active-image">
                    <img src="{{thumb}}" alt="" class="attachment-image"/>
                </a>
                <input type="hidden" name="files[]" value="{{id}}">

                <div class="uploader-toolbar">
                    <h3>
                        <abbr title="{{#title}}{{title}}{{/title}}{{^title}}{{file_name}}{{/title}}">
                            {{#title}}{{title}}{{/title}}{{^title}}{{file_name}}{{/title}}
                        </abbr>
                    </h3>
                    {{#description}}
                    <p><abbr title="{{description}}">{{description}}</abbr></p>
                    {{/description}}

                    <a
                        href="javascript:;"
                        class="uploader-remove"
                        data-file="{{id}}"><i class="remove icon"></i></a>

                    <div class="controls">
                        <a
                            href="javascript:;"
                            class="uploader-config"
                            data-control="popup"
                            data-file="{{id}}">
                            <i class="cog icon"></i>
                        </a>
                        <a
                            href="{{path}}"
                            class="uploader-file-link ui-icon-paperclip"
                            target="_blank">
                            <i class="attach icon"></i>
                        </a>
                    </div>
                </div>
                <div class="uploader-loading"></div>
            </div>
        </li>
    </script>

    <?php
    Theme::asset()->add('fileuploadcss', 'assets/vendor/fileupload/fileupload.css');
    Theme::asset()->container('footer')->add('autoellipsis', 'assets/vendor/jquery.autoellipsis.js', ['jquery']);
    Theme::asset()->container('footer')->add('mustache', 'assets/vendor/mustache/mustache.min.js', ['jquery']);
    Theme::asset()->container('footer')->add('dropzone', 'assets/vendor/dropzone.js', ['jquery']);
    Theme::asset()->container('footer')->add('sortable', 'assets/js/components/sortable.js', ['jquery']);
    Theme::asset()->container('footer')->add('fileupload', 'assets/vendor/fileupload/fileupload.js', ['dropzone', 'mustache', 'sortable', 'application']);
    $__env->startSection('scripts'); ?>
    <script> $('#<?= $uniqueId ?>').data('populatedData', <?= $fileList ?>); </script>
    <?php $__env->appendSection(); ?>
</div>
