<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @param $text
 * @param int $size
 * @param bool $continue_tag
 * @return mixed|string
 */
function truncate($text, $size = 500, $continue_tag = true)
{
	$text = html2txt($text);
	if(strlen($text) > $size) {
		$text = substr($text, 0, $size);
		$last_space = strrpos($text, " ");
		if($last_space === false) {
			return substr($text, 0, $size) . ($continue_tag ? "" : "");
		}
		return substr($text, 0, $last_space) . ($continue_tag ? "" : "");
	}
	return $text;
}

/**
 * @param $document
 * @return mixed
 */
function html2txt($document){
	$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
				   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
				   '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
				   '@<![\s\S]*?--[ \t\n\r]*>@'        // Strip multi-line comments including CDATA
				   );
	return preg_replace($search, '', $document);
}

/**
 * @param $name
 * @param $key
 * @return string
 */
function mark_search_keyword($name, $key)
{
	if(strlen($key) > 0) {
		$array = explode(' ', $key);

		$match = array();
		preg_match_all('/[a-zA-Z0-9ăîșțâĂÎȘȚÂ]+/', $name, $match);

		$match = isset($match[0]) ? $match[0] : array();
		$words = array();
		foreach($match as $i => $v) {
			$word = replace_diacritics($v);
			foreach($array as $ii=>$vv) {
				//$word = preg_replace("/$vv/", "<span style='background-color: yellow;'>$v</span>", $word);
				$word = preg_replace("/$vv/i", "<span style='background-color: yellow;'>$vv</span>", $word);
			}
			$words[] = $word;

		}
		$name = implode(' ', $words);
	}

	return $name;
}

/**
 * @param $text
 * @return mixed
 */
function replace_diacritics($text)
{
	$alphabet = array('ă' => 'a', 'î' => 'i', 'ș' => 's', 'ț' => 't', 'â' => 'a', 'Ă' => 'A', 'Î' => 'I', 'Ș' => 'S', 'Ț' => 'T', 'Â' => 'A');
	foreach($alphabet as $i=>$v) {
		$text = str_replace($i, $v, $text);
	}
	return $text;
}

/**
 * @return string
 */
function site_base()
{
	$CI =& get_instance();
	$lang = $CI->staticdata->getLanguage()['short'];
	$live_path = $CI->config->item('live_path');
	if($lang != LANGUAGE_DEFAULT) {
		$live_path .= "/$lang";
	}
	return $live_path;
}

/**
 * @return mixed
 */
function site_current_url()
{
	$CI =& get_instance();
	$lang = $CI->staticdata->getLanguage()['short'];
	$url = current_url();
	if($lang != LANGUAGE_DEFAULT) {
		$url = str_replace('/'.$lang, '', $url);
	}
	return $url;
}

/**
 * @return string
 */
function home_page_link()
{
	// we can return another link than site base
	return site_base();
}

/**
 * @param $set_language
 * @return string
 */
function language_link($set_language)
{
	$CI =& get_instance();

	$current_url = current_url();
	$partial = str_replace(site_base(), '', $current_url);
	$live_path = $CI->config->item('live_path');

	if($set_language != LANGUAGE_DEFAULT) {
		return $live_path.'/'.$set_language.$partial;
	}
	return $live_path.$partial;
}

/**
 * @param $news
 * @return string
 */
function build_news_link($news)
{
	return site_base()."/".build_seo($news['url']).".html";
}

/**
 * @param $category
 * @return string
 */
function build_news_category_link($category)
{
    return site_base()."/".$category['url'].".html";
}

/**
 * @param $page
 * @return string
 */
function build_page_link($page)
{
	return site_base().'/'.$page['url'].'.html';
}

/**
 * @param $key
 * @return string
 */
function build_search_link($key)
{
	return site_base().'/search/'.urlencode($key).'.html';
}

/**
 * @param $tag
 * @return string
 */
function build_news_tag_link($tag)
{
	return site_base()."/tag/".urlencode(preg_replace('/\s/', '-', trim($tag))).".html";
}

/**
 * @param $author
 * @return string
 */
function build_author_link($author)
{
	return site_base()."/author/".$author.".html";
}

/**
 * @param $author
 * @return string
 */
function build_author_about($author)
{
	return site_base()."/about/".$author.".html";
}

/**
 * @param $tag
 * @return mixed
 */
function get_tags($tag)
{
	return preg_replace('/-/', ' ', trim(urldecode($tag)));
}

/**
 * @param $name
 * @return string
 */
function build_seo($name)
{
	$name = preg_replace("/[ ]/", "-", $name);
	return preg_replace("/[^A-Za-z0-9_-]/i", "", $name);
}

/**
 * @param $name
 * @return string
 */
function build_seo_meta($name)
{
	return preg_replace("/[^A-Za-z0-9_-]/i", " ", $name);
}

/**
 * @param $text
 * @return string
 */
function build_seo_keywords($text)
{
	$array = explode(' ', $text);
	$keys = array_filter($array, function($value) {
		return strlen($value) > 3;
	});
	return implode(',', $keys);
}

/* display array debugg */
function p($array, $key = "", $level = -1) {
	if($level == -1) {
		print "<div style='padding: 3px; border: solid 1px #000000; background-color: yellow; font-size: 10px;'>".gettype($array)."</div>";
		$level ++;
	}

	if(is_array($array) || is_object($array)) {
		foreach($array as $i=>$v) {
			print "<div style='padding-left: ".($level > 0 ? 50 : 0)."px; border: solid 1px #cacaca; margin-bottom: 1px;'>";
			$id_level = uniqid();
			if(is_array($v)) {
				print "<span style='display: inline-block; width: 15px; margin-bottom: -5px; font-size: 18px; text-align: center;'><a href='javascript:;' onclick='if(document.getElementById(\"".$id_level."\").style.display==\"\") { document.getElementById(\"".$id_level."\").style.display=\"none\"; this.innerHTML=\"+\"; } else { document.getElementById(\"".$id_level."\").style.display=\"\"; this.innerHTML=\"-\"; }' style='text-decoration: none; color: #000000;'>-</a></span>";
			}
			else {
				print "<span style='display: inline-block; width: 15px;'></span>";
			}
			print "[".$i."] => ";
			if(is_array($v)) {
				print "<span style='color: #888888;'>(".sizeof($v).")</span> <span style='color: #888888;font-size: 10px;'>".gettype($array)."</span>";
				print "<div id='".$id_level."'>";
			}

			$level++;
			p($v, $i, $level);
			$level --;

			if(is_array($v)) {
				print "</div>";
			}
			print "</div>";
		}
	}
	else if(is_resource($array)) {
		$level++;
		$nr_crt = 0;
		while($row = mysql_fetch_assoc($array)) {
			print "<div style='padding: 3px; border: solid 1px #000000; background-color: lightgreen; font-size: 10px;'>".$nr_crt.". ".get_resource_type($array)."</div>";
			p($row, "res", $level);
			$nr_crt++;
		}
	}
	else {
		print "".$array . " <span style='color: #888888;font-size: 10px;'>".gettype($array)."</span>";
	}
}

/* End of file functions_helper.php */
/* Location: ./application/helpers/functions_helper.php */