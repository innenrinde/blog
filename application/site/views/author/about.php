<?=$this->load->view('partials/breadcrumbs.php', [
    'links' => [
        build_author_link($author['slug']) => "\"{$author['first_name']} {$author['last_name']}\""
    ]
], true)?>

    <div class="col-sm-12">
        <h2 class="category-title">
            <?=sprintf($this->lang->line("author_about"), $author['first_name'].' '.$author['last_name'])?>
        </h2>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-3">
        <?php if($author['author_image']) { ?>
            <img src="<?=$this->config->item('live_path')."/files/users/thumb/".$author['author_image']?>" alt="<?=htmlspecialchars($author['first_name'].' '.$author['last_name'])?>" title="<?=htmlspecialchars($author['first_name'].' '.$author['last_name'])?>" style="width: 100%;">
        <?php } ?>
        </div>
        <div class="col-sm-9">
            <?=$author['description']?>
        </div>
    </div>

    <div class="col-sm-12">
        <ul>
        <?php foreach($news as $item) { ?>
            <li><a href="<?=build_news_link($item)?>" class="small" style="font-size: 12px;"><?=$item['title']?></a></li>
        <?php } ?>
        </ul>
    </div>