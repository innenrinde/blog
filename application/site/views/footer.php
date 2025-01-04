		</div>
	</div>
	<!--
	 END container -->

	<div class="sticker-buttons">
		<?php foreach($languages as $language) { ?>
		<a href="<?=language_link($language['short'])?>" <?=($language['short'] == $current_language['short'] ? 'class="selected"' : '')?> >
			<img src="<?=$this->config->item('live_path')?>/files/languages/<?=$language['image_file']?>" title="<?=$language['name']?>">
		</a>
		<?php } ?>
	</div>

		<style>
			footer {
				background-color: #335C7D;
			}

			footer .social a {
				display: inline-block;
				width: 40px;
				height: 40px;
				font-size: 18px;
				text-align: center;
				color: #fff;
				border: solid 1px #fff;
				border-radius: 40px;
				margin: 25px 15px 15px 15px;
				padding-top: 7px;
			}

			footer .social a:hover {
				color: #df3132;
				border-color: #df3132;
			}

		</style>

	<footer>
		<div class="container container-fluid">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-3">
					<div class="social">
						<a href="https://www.facebook.com/ChaTToir" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="https://plus.google.com/communities/104941169258418734247" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
						<a href="https://www.linkedin.com/company-beta/18087225" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="col-sm-8">
					<?php if(isset($pages)) { ?>
						<ul>
							<?php foreach($pages as $page) { ?>
								<li class="text-center">
									<a href="<?=build_page_link($page)?>"><?=$page['title']?></a>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-3">
					<ul class="categories">
						<?php foreach($categories as $i=>$v) { ?>
							<li><a href="<?=build_news_category_link($v)?>"><?=htmlspecialchars($v['title'])?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-sm-8">
					<ul class="news_links">
						<?php foreach($last_news as $i=>$v) { ?>
							<li><a href="<?=build_news_link($v)?>"><?=htmlspecialchars($v['title'])?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</footer>

	<script src="<?=$this->config->item('live_path')?>/resources/site/jscript/jquery-1.11.3.min.js"></script>
	<script src="<?=$this->config->item('live_path')?>/resources/site/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?=$this->config->item('live_path')?>/resources/site/jscript/lazy.min.js"></script>
	<script src="<?=$this->config->item('live_path')?>/resources/site/jscript/menu.js?<?=rand()?>"></script>
	<?php if(isset($js)) { ?>
		<?php foreach($js as $file) { ?>
			<script src="<?=$this->config->item('live_path')?>/<?=$file?>"></script>
		<?php } ?>
	<?php } ?>


	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-100036124-1', 'auto');
		ga('send', 'pageview');
	</script>

	<!-- Hotjar Tracking Code for elavis.ro -->
	<script>
		(function(h,o,t,j,a,r){
			h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
			h._hjSettings={hjid:106861,hjsv:5};
			a=o.getElementsByTagName('head')[0];
			r=o.createElement('script');r.async=1;
			r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
			a.appendChild(r);
		})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
	</script>

	</body>
<!-- END html -->
</html>