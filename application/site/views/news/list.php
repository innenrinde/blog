<div class="col-sm-12">
    <div class="row">
    <?php foreach($news as $i=>$item) { ?>

        <div class="col-sm-1">
        <?=$this->widgets->run('author', $item);?>
        </div>

        <div class="col-sm-11">
            <div class="news">
                <?php if($item['thumb_image_name']) { ?>
                    <div class="img">
                        <a href="<?=build_news_link($item, $this->config->item('live_path'))?>"><img class="lazy" data-original="<?=$this->config->item('live_path')."/files/news/original/".$item['thumb_image_name']?>" src=""></a>
                    </div>
                <?php } ?>
                <h2>
                    <a href="<?=build_news_link($item, $this->config->item('live_path'))?>"><?=mark_search_keyword($item['title'], isset($key) ? $key : '')?></a>
                </h2>
                <div class="category">
                    <?php if($item['id_news_category']) { ?>
                    <?=$this->lang->line('in')?> <span><a href="<?=build_news_category_link(['id' => $item['id_news_category'], 'url' => $item['news_category_url']])?>"><?=htmlspecialchars($item['news_category'])?></a></span>
                    <?php } ?>
                    <?=$this->lang->line('at')?> <span><?=news_date($item['date'])?></span>
                </div>

                <?=mark_search_keyword($item['subtitle'], isset($key) ? $key : '')?>
                <?=mark_search_keyword(truncate($item['content_short'], 5000), isset($key) ? $key : '')?>
                <div class="more">
                <a href="<?=build_news_link($item, $this->config->item('live_path'))?>" class="link"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <?=$this->lang->line('read_more')?></a>
                </div>

                <div class="clear"></div>
            </div>
        </div>
    <?php } ?>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-9 col-xs-12"><?=$pagination?></div>
        <div class="col-sm-1 col-xs-10">
            <?=$this->widgets->run('searchform', [])?>
        </div>
        <div class="col-sm-1 col-xs-2">
            <a href="#top" class="top" title="<?=$this->lang->line('bring_top')?>"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
        </div>
    </div>
</div>