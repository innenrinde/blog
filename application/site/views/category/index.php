<?=$this->load->view('partials/breadcrumbs.php', [
    'links' => [
        build_news_category_link($category) => $category['title']
    ]
], true)?>

<div class="col-sm-12">
    <h2 class="category-title">
        <?=$category['title']?>
        <?=$this->widgets->run('searchform', [])?>
    </h2>
</div>

<?php $this->load->view('news/list') ?>