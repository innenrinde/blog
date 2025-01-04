<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_login($session) {
	if(!$session->userdata('logged_in')) {
		redirect(base_url(array("admin.php", "users", "login")));
	}
}

/* generate hotel stars options */
function stars($name, $selected = 1, $no_stars = 5) {
	$html = "<div>";
	for($i = 0; $i < $no_stars; $i++) {
		$html .= '<input type="radio" name="'.$name.'" id="'.$name.'_'.$i.'" value="'.($i+1).'" '.($selected == $i+1 ? "checked" : "").'>';
		$html .= '<label for="'.$name.'_'.$i.'" style="margin-right: 20px;">';
		for($j = 0; $j < $no_stars; $j++) {
			if($j <= $i) {
				$html .= '<span class="glyphicon glyphicon-star"></span>';
			}
			else {
				$html .= '<span class="glyphicon glyphicon-star-empty"></span>';
			}
		}
		$html .= '</label>';
	}
	$html .= "</div>";

	return $html;
}

function stars2($no_stars = 1) {
	$html = "<div>";
	for($i = 0; $i < $no_stars; $i++) {
		$html .= '<span class="glyphicon glyphicon-star"></span>';
	}
	$html .= "</div>";

	return $html;
}

function show_labels($labels, $title = "") {
    $html = "";
    if(strlen($labels) > 0) {
        $array = explode(",", $labels);
        $title = explode(",", $title);
        foreach($array as $i=>$v) {
            $html .= '<i class="fa fa-circle" style="color:'.$v.'" title="'.(isset($title[$i]) ? $title[$i] : '').'"></i>';
        }
    }
    return $html;
}

function replace_diacritics($text) {
	$array = array("ă"=>"a", "â"=>"a", "î"=>"i", "ş"=>"s", "ţ"=>"t", "Ă"=>"A", "Â"=>"A", "Î"=>"I", "Ş"=>"S", "Ţ"=>"T",
					"ș"=>"s",
					"ț"=>"t",
					" "=>"-");
	foreach($array as $i=>$v) {
		$text = str_replace($i, $v, $text);
	}
	return $text;
}

function build_seo($name) {
	$name = replace_diacritics($name);
	$name = preg_replace("/[ ]/", "-", $name);
	return preg_replace("/[^A-Za-z0-9-]/i", "", $name);
}

function truncate($text, $chars = 300) {
	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	return $text;
}

// scaleaza imaginea doar in functie de latime
function img_scaleaza2($im, $img_latime) {

	$rgb_fundal = "";
	$r = 255;
	$g = 255;
	$b = 255;
	if(strlen($rgb_fundal) > 0) {
		$array = explode(",", $rgb_fundal);
		$r = current($array);
		$g = next($array);
		$b = next($array);
	}

	$latime = imagesx($im);
	$inaltime = imagesy($im);

	$img_inaltime = $inaltime*$img_latime/$latime;

	$im_nou = imagecreatetruecolor($img_latime, $img_inaltime);
	$fundal = imagecolorallocate($im_nou, $r, $g, $b);
	imagefilledrectangle($im_nou, 0, 0, $img_latime, $img_inaltime, $fundal);

	$scara = $img_latime / $latime;

	$latime_nou = intval($latime * $scara);
	$inaltime_nou = intval($inaltime * $scara);
	$x_nou = intval(($img_latime - $latime_nou) / 2);
	$y_nou = intval(($img_inaltime - $inaltime_nou) / 2);
	imagecopyresampled($im_nou, $im, $x_nou, $y_nou, 0, 0, $latime_nou, $inaltime_nou, $latime, $inaltime);
	//imagedestroy($im);
	return $im_nou;
}

function order($key, $name) {
	$CI =& get_instance();
	return $CI->sort->by($key, $name);
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


function lang_tabs($lang, $id) {
	$CI =& get_instance();
	return $CI->load->view('templates/lang_tabs', array('lang' => $lang, 'id' => $id), true);
}