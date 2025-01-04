<!-- Fine Uploader New/Modern CSS file
    ====================================================================== -->
<link href="<?=$this->config->item('base_url')?>resources/admin/js/fine-uploader/fine-uploader-new.css" rel="stylesheet">

<!-- Fine Uploader JS file
====================================================================== -->
<script src="<?=$this->config->item('base_url')?>resources/admin/js/fine-uploader/fine-uploader.js"></script>

<!-- Fine Uploader Thumbnails template w/ customization
====================================================================== -->
<script type="text/template" id="qq-template-manual-trigger">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="buttons">
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Select files</div>
            </div>
            <button type="button" id="trigger-upload" class="btn btn-primary">
                <i class="icon-upload icon-white"></i> Upload
            </button>
        </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>

<style>
    #trigger-upload {
        color: white;
        background-color: #00ABC7;
        font-size: 14px;
        padding: 7px 20px;
        background-image: none;
    }

    #fine-uploader-manual-trigger .qq-upload-button {
        margin-right: 15px;
    }

    #fine-uploader-manual-trigger .buttons {
        width: 36%;
    }

    #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
        width: 60%;
    }

    ul.images {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    ul.images li {
        float: left;
        display: block;
        margin: 3px;
        border: solid 1px #000000;
        text-align: center;
    }

    ul.images li img {
        height: 80px;
        display: block;
    }

    ul.images li a {
        margin: 3px;
    }
</style>


<!-- Fine Uploader DOM Element
====================================================================== -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" id="image_link" style="cursor: pointer;">Imagini <span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;"></span></h3>
    </div>
    <div class="panel-body" id="image_div" style="display: <?=(count($images) > 0 ? "" : "none")?>;">
        <ul class="images">
        <?php foreach($images as $image) { ?>
            <li id="image-<?=$image['id']?>">
            <img src="<?=$this->config->item('live_path')?>/files/<?=$folder?>/thumb/<?=$image['thumb_image_name']?>">
                <a href="javascript:;" data-id="<?=$image['id']?>" class="btn btn-primary btn-xs delete-image">delete</a>
                <input type="checkbox" class="main_image" name="main_image[<?=$image['id']?>]" id="main_image[<?=$image['id']?>]" value="<?=$image['id']?>" <?=($image['main_image'] ? 'checked' : '')?> title="Set as main image">

                <?php if(isset($image['interview'])) { ?>
                    <input type="checkbox" class="interview_image" name="interview[<?=$image['id']?>]" id="interview[<?=$image['id']?>]" value="<?=$image['id']?>" <?=($image['interview'] ? 'checked' : '')?> title="Set as image for interview">
                <?php } ?>

            </li>
        <?php } ?>
        </ul>
        <div class="clear"></div>
        <div id="fine-uploader-manual-trigger"></div>
    </div>
</div>


<!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
====================================================================== -->
<script>
    var images = [];
    var manualUploader = new qq.FineUploader({
        element: document.getElementById('fine-uploader-manual-trigger'),
        template: 'qq-template-manual-trigger',
        request: {
            endpoint: '<?=$endpoint?>'
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            sizeLimit: 1024 * 1024 * 1024 * 2, // 2 GB
        },
        thumbnails: {
            placeholders: {
                waitingPath: '<?=$this->config->item('base_url')?>resources/admin/js/fine-uploader/placeholders/waiting-generic.png',
                notAvailablePath: '<?=$this->config->item('base_url')?>resources/admin/js/fine-uploader/placeholders/not_available-generic.png'
            }
        },
        chunking: {
            enabled: true,
            concurrent: {
                enabled: false
            },
            success: {
                endpoint: '<?=$endpoint?>?done'
            }
        },
        resume: {
            enabled: true
        },

        autoUpload: false,
        debug: false,
        callbacks: {
            onComplete: function(id, name, response) {
            }
        }
    });

    qq(document.getElementById("trigger-upload")).attach("click", function() {
        manualUploader.uploadStoredFiles();
    });

    $(document).ready(function() {
        $('.delete-image').click(function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '<?=$delete;?>',
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    $('#image-'+id).remove();
                }
            });
        })
    });

</script>