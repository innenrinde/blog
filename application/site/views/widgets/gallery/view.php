<?php if(count($images)) { ?>
<div id="demo-test-gallery" class="demo-gallery">
    <?php foreach($images as $count=>$image) { ?>
        <a href="<?=$this->config->item('live_path')?>/files/news/original/<?=$image['file_name']?>" data-size="<?=$image['size']['original']['w']?>x<?=$image['size']['original']['h']?>" data-med="<?=$this->config->item('live_path')?>/files/news/mediu/<?=$image['file_name']?>" data-med-size="<?=$image['size']['mediu']['w']?>x<?=$image['size']['mediu']['h']?>" data-author="Chattoir">
            <img src="<?=$this->config->item('live_path')?>/files/news/thumb/<?=$image['file_name']?>" alt="" />
            <figure></figure>
        </a>
    <?php } ?>
</div>
<div class="clear"></div>
<?php } ?>


<div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>

    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="pswp__loading-indicator"><div class="pswp__loading-indicator__line"></div></div> -->

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip">
                    <!-- <a href="#" class="pswp__share--facebook"></a>
                    <a href="#" class="pswp__share--twitter"></a>
                    <a href="#" class="pswp__share--pinterest"></a>
                    <a href="#" download class="pswp__share--download"></a> -->
                </div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center">
                </div>
            </div>
        </div>
    </div>
</div>

