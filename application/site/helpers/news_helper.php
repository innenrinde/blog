<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Display news content
 * Truncate content if it needed a paid account
 *
 * @param $news
 * @return string
 */
function show_news($news)
{
	return youtube($news['content']);
}

/**
 * Embed youtube links
 *
 * @param $content
 * @return mixed
 */
function youtube($content)
{
	return preg_replace(
		'/(https*:\/\/www.youtube.[a-z]+\/watch\?v=([a-z0-9-_]+)[^<\s]*)/i',
		'<iframe src="https://www.youtube.com/embed/$2" frameborder="0" allowfullscreen></iframe>',
		$content
	);
}

/**
 * @param $date
 * @return bool|string
 */
function news_date($date)
{
	return date('d F Y', strtotime($date));
}

/* End of file news_helper.php */
/* Location: ./application/helpers/news_helper.php */