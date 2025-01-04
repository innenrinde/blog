<div class="social-headers">
    <a href="http://www.facebook.com/share.php?u=<?=build_news_link($news)?>&amp;title=<?=$news['title']?>" class="soc-facebook" target="_blank" title="share on Facebook">
        <i class="fa fa-facebook"></i>
    </a>

    <a href="https://plus.google.com/share?url=<?=build_news_link($news)?>" class="soc-google-plus" target="_blank" title="share on G+">
        <i class="fa fa-google-plus"></i>
    </a>

    <a href="http://twitter.com/home?status=<?=$news['title']?>+<?=build_news_link($news)?>" class="soc-twitter" target="_blank" title="share on Twitter">
        <i class="fa fa-twitter"></i>
    </a>

<!--    <a href="http://www.digg.com/submit?phase=2&amp;url=--><?//=build_news_link($news)?><!--&amp;title=--><?//=$news['title']?><!--" class="soc-pinterest" target="_blank" title="share on DIGG">-->
<!--        <i class="fa fa-digg"></i>-->
<!--    </a>-->

    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?=build_news_link($news)?>&amp;title=<?=$news['title']?>&amp;source=<?=$this->config->item('live_path')?>" class="soc-linkedin" target="_blank" title="share on LinkedIn">
        <i class="fa fa-linkedin"></i>
    </a>

    <div class="fb-follow" data-href="https://www.facebook.com/ChaTToir" data-height="50" data-layout="box_count" data-size="small" data-show-faces="true"></div>

</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=239337109519806";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>