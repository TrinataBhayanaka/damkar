<?php
if ( ! function_exists('lat_parse_str')):
	function lat_parse_str($str,$delim1=",",$delim2=":"){
		$op = array();
		$pairs = explode($delim1, $str);
		foreach ($pairs as $pair) {
			list($k, $v) = array_map("urldecode", explode($delim2, $pair));
			$op[$k] = $v;
		}
		return $op;
	}
endif;