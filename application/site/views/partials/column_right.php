<div class="col-sm-3 column-right">
    <?php if(count($category_same_news)) { ?>
        <?php foreach($category_same_news as $i=>$item) { ?>
        <div>
            <a href="<?=build_news_link($item)?>" class="link"><?=$item['title']?></a>
            <?=truncate($item['content_short'], 300)?>
            <a href="<?=build_news_link($item)?>" class="link"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <?=$this->lang->line('read_more')?></a>
        </div>
        <?php } ?>
    <?php } ?>
</div>
