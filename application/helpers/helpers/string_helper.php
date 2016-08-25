<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('limitChar') ) {
	function limitChar($str, $limit) {
		if(mb_strlen($str)>=$limit) {
			$string = substr($str, 0, $limit).'...';
		} else {
			$string = $str;
		}
		return $string;
	}
}

