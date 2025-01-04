<div class="author">
    <?php if($author_image) { ?>
        <a href="<?=build_author_about($author_slug)?>"><img src="<?=$this->config->item('live_path')."/files/users/thumb/".$author_image?>" alt="<?=htmlspecialchars($author_name.' '.$author_surname)?>" title="<?=$this->lang->line('by')?> <?=($author_name.' '.$author_surname)?>"></a>
    <?php } ?>
</div>

<?php if($interview_image) { ?>
    <div class="author author2">
    <span class="comment">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </span>
        <?php if($interview_image) { ?>
            <img src="<?=$this->config->item('live_path')."/files/news/thumb/".$interview_image?>">
        <?php } ?>
    </div>
<?php } ?>