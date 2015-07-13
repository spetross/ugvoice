<div
    id="<?= $this->getId() ?>"
    class="field-fileupload is-multi <?= count($fileList) ? 'has-attachments' : '' ?> is-sortable"
    data-control="fileupload"
    data-unique-id="<?= $this->getId() ?>"
    data-sort-handler="<?= $this->getEventHandler('onSortAttachments') ?>"
    <?php if ($acceptedFileTypes): ?>data-file-types="<?= $acceptedFileTypes ?>"<?php endif ?>
    data-item-template="<?= $this->getId('template') ?>">

    <div class="file-multi">

        <ul>
            <!-- Add New File -->
            <li class="attachment-item attachment-uploader">
                <a href="javascript:;" class="uploader-link no-attachment">
                    <table>
                        <tr>
                            <td class="oc-<?= $emptyIcon ?>"></td>
                        </tr>
                    </table>
                </a>

                <div class="uploader-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
                <div class="uploader-loading"></div>
            </li>
        </ul>

    </div>

    <!-- Populated File -->
    <script type="text/template" id="<?= $this->getId('template') ?>">
        <li>
            <div
                class="attachment-item"
                data-attachment-id="{{id}}">
                <a href="{{path}}" target="_blank" class="active-file">
                    <span class="file-icon">
                        <i class="icon-file"></i>
                        <b class="file-extension">{{extension}}</b>
                    </span>
                    <span class="caption">{{file_name}}</span>
                </a>

                <div class="uploader-toolbar">
                    <h3>
                        <abbr title="{{#title}}{{title}}{{/title}}{{^title}}{{file_name}}{{/title}}">
                            {{#title}}{{title}}{{/title}}{{^title}}{{file_name}}{{/title}}
                        </abbr>
                    </h3>
                    {{#description}}
                    <p><abbr title="{{description}}">{{description}}</abbr></p>
                    {{/description}}

                    <?php if (!$this->previewMode): ?>
                        <a
                            href="javascript:;"
                            class="uploader-remove oc-icon-times"
                            data-request="<?= $this->getEventHandler('onRemoveAttachment') ?>"
                            data-request-data="file_id: {{id}}"></a>
                    <?php endif ?>

                    <div class="controls">
                        <?php if (!$this->previewMode): ?>
                            <a
                                href="javascript:;"
                                class="uploader-config oc-icon-cog"
                                data-control="popup"
                                data-handler="<?= $this->getEventHandler('onLoadAttachmentConfig') ?>"
                                data-request-data="file_id: {{id}}"></a>
                        <?php endif ?>
                        <a
                            href="{{path}}"
                            class="uploader-file-link oc-icon-paperclip"
                            target="_blank"></a>
                    </div>
                </div>
                <div class="uploader-loading"></div>
            </div>
        </li>
    </script>

    <!-- Existing images -->
    <script> $('#<?= $this->getId() ?>').data('populatedData', <?= $fileList ?>); </script>
</div>
