<ul class="nav nav-tabs">
    <?php foreach($lang as $i=>$v) { ?>
    <li class="<?=($i == 0 ? 'active' : '')?>" >
        <a href="#<?=$v['id']?><?=$id?>" data-toggle="tab">
            <img src="<?=$this->config->item('live_path')?>/files/languages/<?=$v['image_file']?>" width='15'>
            <?=$v['name']?>
        </a>
    </li>
    <?php } ?>
</ul>