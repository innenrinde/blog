<?=$this->load->view('partials/breadcrumbs.php', [
	'links' => [
		build_news_category_link($category) => $category['title'],
		build_news_link($news) => $news['title']
	]
], true)?>

<div class="col-sm-9 news">
	<h1>
		<?=$news['title']?>
	</h1>

	<span class="subtitlesub"><?php echo ($news['subtitle']) ? $news['subtitle'].' ' :'';?></span>

	<div class="article-header-photo">
		<?php if ($news['image_name'] !== '') { ?>
		<p class="featured-caption"><?=$news['image_name']?></p>
		<?php } ?>
		<?php if($news['thumb_image_name'] != '') { ?>
		<img src="<?=$this->config->item("live_path")?>/files/news/mediu/<?=$news['thumb_image_name']?>" alt="<?=$news['image_name']?>" />
		<?php } ?>
	</div>
	<p class="source-image"><?=$news['image_title']?></p>

	<div class="news-author">
		<?=$this->widgets->run('social', $news)?>

		<i class="fa fa-user"></i>
		<?=$this->lang->line('by')?> <a href="<?=build_author_link($news['author_slug'])?>"><?=$news['author_name'].' '.$news['author_surname']?></a>
		<?=$this->lang->line('at')?> <?=news_date($news['date'])?>

	</div>

	<span class="subtitles"><?php echo ($news['content_short']) ? $news['content_short'].'<br><br>' :'';?></span>

	<div class="content"><?=show_news($news)?></div>

	<?=$this->widgets->run('gallery', $news_images)?>

	<?php if(sizeof($labels) > 0) { ?>
	<div class="panel-tags-cats">
		<span><i class="fa fa-tag"></i><?=$this->lang->line('labels')?></span>
		<div class="tagcloud">
			<?php foreach($labels as $v) { ?>
			<a href="<?=build_news_tag_link(trim($v))?>"><?=htmlspecialchars(trim($v))?></a>
			<?php } ?>
		</div>
		<div class="article-splitter"></div>
	</div>
	<?php } ?>

	<div class="fb-comments" data-href="<?=site_current_url()?>" data-width="100%" data-numposts="7"></div>

</div>

<?php $this->view('partials/column_right');  ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=239337109519806";
		fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>