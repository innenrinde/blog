<?php
/* variables:
 			'current_page' => $current_page,
			'per_page' => $per_page,
			'page_count' => ceil($events_count / $per_page), // total pages
			'url_fragment' => 'evenimente-turism'
 * <li class="disabled"><span>...</span></li>
 */
?>

<style>
	a.current {
		font-weight: bold;
		border: solid 1px red !important;
		color: red !important;
	}
</style>


<?php if ($page_count > 1):?>
<div class="pagination">
	<?php if($current_page > 3) : ?>
		<a class="page-numbers" href="<?=str_replace('.html', '-1.html', $url)?>" title="<?=$this->lang->line('first_page')?>"><i class="fa fa-hand-o-left" aria-hidden="true"></i></a>
		<!--<span class="page-numbers">...</span>-->
	<?php endif; ?>

	<?php for($i = $current_page - 2; $i<$current_page + 3; $i++): ?>
		<?php if($i > 0 && $i <= $page_count) : ?>
		<a class="page-numbers<?php if ($i == $current_page) : ?> current<?php endif; ?>" href="<?=str_replace('.html', '-'.$i.'.html', $url)?>"><?=$i?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if($current_page < $page_count - 2) : ?>
		<!--<span class="page-numbers">...</span>-->
		<a class="page-numbers" href="<?=str_replace('.html', '-'.$page_count.'.html', $url)?>" title="<?=$this->lang->line('last_page')?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i></a>
	<?php endif; ?>

</div>
<?php endif; ?>

