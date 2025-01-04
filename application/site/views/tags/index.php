<?=$this->load->view('partials/breadcrumbs.php', [
    'links' => [
        build_news_tag_link($tag) => "\"{$tag}\""
    ]
], true)?>

    <div class="col-sm-12">
        <h2 class="category-title">
            <?=sprintf($this->lang->line("tags_title"), $tag)?>
        </h2>
    </div>

<?php $this->load->view('news/list') ?>