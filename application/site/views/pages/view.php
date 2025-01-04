<?=$this->load->view('partials/breadcrumbs.php', [
	'links' => [
		build_page_link($page) => $page['title']
	]
], true)?>

<div class="col-sm-12 news">
	<h1>
		<?=$page['title']?>
	</h1>

	<?=$page['content']?>
</div>
