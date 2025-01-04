<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
<head>
	<!-- Page Title -->
	<title><?=(isset($meta_title) ? $meta_title : $this->lang->line('meta_title'))?></title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="description" content="<?=(isset($meta_description) ? $meta_description : $this->lang->line('meta_description'))?>" />
	<meta name="keywords" content="<?=(isset($meta_keywords) ? $meta_keywords : $this->lang->line('meta_keywords'))?>">
	<meta name="author" content="Chattoir">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta itemprop="provider" content="Editorials">
	<meta itemprop="headline" content="Editorials">
	<meta itemprop="author" content="Chattoir">
	<meta itemprop="description" content="Chattoir Editorials is a great platform who gathers the most interesting interviews with awesome people.">
	<meta itemprop="image" content="<?=$this->config->item('live_path')?>/resources/site/images/logo.png">

	<!-- OpenGraph for Facebook -->
	<?php if(isset($og)) { ?>
	<meta property="og:url" content="<?=$og['url']?>" />
	<meta property="og:type" content="<?=$og['type']?>" />
	<meta property="og:title" content="<?=$og['title']?>" />
	<meta property="og:description" content="<?=$og['description']?>" />
	<meta property="og:image" content="<?=$og['image']?>" />
	<?php } ?>

	<!-- Favs and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$this->config->item('live_path')?>/resources/site/images/logo.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$this->config->item('live_path')?>/resources/site/images/logo.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$this->config->item('live_path')?>/resources/site/images/logo.png" />
	<link rel="apple-touch-icon-precomposed" href="<?=$this->config->item('live_path')?>/resources/site/images/icon.png" />
	<link rel="shortcut icon" href="<?=$this->config->item('live_path')?>/resources/site/images/icon.png" />

	<!-- Stylesheets -->
	<link type="text/css" rel="stylesheet" href="<?=$this->config->item('live_path')?>/resources/site/css/font-awesome.css" />
	<link href="<?=$this->config->item('live_path')?>/resources/site/bootstrap/css/bootstrap.css" rel="stylesheet">

	<link href="<?=$this->config->item('live_path')?>/resources/site/css/theme.css?<?=rand()?>" rel="stylesheet">
	<link href="<?=$this->config->item('live_path')?>/resources/site/css/responsive.css?<?=rand()?>" rel="stylesheet">

	<?php if(isset($css)) { ?>
		<?php foreach($css as $file) { ?>
			<link href="<?=$this->config->item('live_path')?>/<?=$file?>?<?=rand()?>" rel="stylesheet">
		<?php } ?>
	<?php } ?>

</head>
<!-- BEGIN body -->
<body>
<header>
	<h1><a href="<?=home_page_link()?>"><?=$this->lang->line('app_title')?></a></h1>
	<a href="javascript:;" class="sandwich"><i class="fa fa-bars" aria-hidden="true"></i></a>
	<ul class="menu"><?php foreach($categories as $i=>$v) { ?><li><a href="<?=build_news_category_link($v)?>"><?=htmlspecialchars($v['title'])?></a></li><?php } ?><li><a href="http://www.chattoir.com">Chattoir!</a></li></ul>
</header>

<div class="container container-fluid">
	<div class="row">
