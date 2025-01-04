<div class="search-form">
    <?=form_open('/search', 'post');?>
    <a href="#search" title="<?=$this->lang->line('bring_top')?>"><i class="fa fa-search" aria-hidden="true"></i></a>
    <input type="text" name="key" id="key" maxlength="25" placeholder="<?=$this->lang->line('search')?>">
    <?=form_close()?>
</div>