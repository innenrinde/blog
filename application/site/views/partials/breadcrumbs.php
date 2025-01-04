<div class="full-block with-border-bottom">
    <div class="breadcrumbn">
        <h3>
            <a href="<?=home_page_link()?>"><?=$this->lang->line('home_page')?></a>
            <?php foreach($links as $link=>$title) { ?>
                &rsaquo; <a href="<?=$link?>"><?=$title?></a>
            <?php } ?>
        </h3>
    </div>
</div>