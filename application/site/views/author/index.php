<?=$this->load->view('partials/breadcrumbs.php', [
    'links' => [
        build_author_link($author['slug']) => "\"{$author['first_name']} {$author['last_name']}\""
    ]
], true)?>

    <div class="col-sm-12">
        <h2 class="category-title">
            <?=sprintf($this->lang->line("author_title"), $author['first_name'].' '.$author['last_name'])?>
        </h2>
    </div>

<?php $this->load->view('news/list') ?>