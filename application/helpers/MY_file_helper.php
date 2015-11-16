<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('make_captcha'))
{
		function make_captcha()
		{
			// echo "in";exit;
			$CI =& get_instance();
			$CI->load->helper('captcha');
			$vals = array(
					'img_path' => './assets/captcha/', // PATH for captcha ( *Must mkdir (htdocs)/captcha )
					'img_url' => base_url() . 'assets/captcha/', // URL for captcha img
					'img_width' => 200, // width
					'img_height' => 60, // height
					);
			$cap = create_captcha($vals);
			// pre($cap);exit;
			if ($cap) {
				$data = array(
				// 'captcha_id' => '',
				'captcha_time' => $cap['time'],
				'ip_address' => $CI->input->ip_address(),
				'word' => $cap['word'],
				);
				$query = $CI->db->insert_string('captcha', $data);
				// pre($query);exit;
				$CI->conn->query($query);
			}else{
				return "Umm captcha not work";
			}
			return $cap['image'];
		}
}

if ( ! function_exists('check_captcha'))
{
	function check_captcha() 
	{
		$CI =& get_instance();
		// Delete old data ( 2hours)
		$expiration = time() - 7200;
		$sql = " DELETE FROM captcha WHERE captcha_time < ? "; $binds = array($expiration); 
		$query = $CI->db->query($sql, $binds);

		//checking input
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $CI->input->ip_address(), $expiration);
		$query = $CI->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count > 0) {
			return true;
		}
		return false;
	}
}
 /* 
  filename without extension 
  ex: file_core_name('toto.jpg') -> 'toto'
*/
if ( ! function_exists('file_core_name'))
{
	function file_core_name($file_name)
	{
		$exploded = explode('.', $file_name);
 
		// if no extension
		if (count($exploded) == 1)
		{
			return $file_name;
		}
 
		// remove extension
		array_pop($exploded);
 
		return implode('.', $exploded);
	}
}
 
/* 
  file extension 
  ex: file_extension('toto.jpg') -> 'jpg'
*/
 
if ( ! function_exists('file_extension'))
{
	function file_extension($path)
	{
		$extension = substr(strrchr($path, '.'), 1);
		return $extension;
	}
}
 
/* 
  file size 
  ex: file_size('toto.jpg') -> '3.3 MB'
*/
if ( ! function_exists('file_size'))
{
	function file_size($path)
	{
		$num = filesize($path);
 
		// code from byte_format()
		$CI =& get_instance();
		$CI->lang->load('number');
 
		$decimals = 1;
 
		if ($num >= 1000000000000) 
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000) 
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000) 
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000) 
		{
			$decimals = 0; // decimals are not meaningful enough at this point
 
			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}
 
		$str = number_format($num, $decimals).' '.$unit;
 
		$str = str_replace(' ', '&nbsp;', $str);
		return $str;
	}
}

/* 
  file size 
  ex: file_size('toto.jpg') -> '3.3 MB'
*/
if ( ! function_exists('size_format'))
{
	function size_format($size)
	{
		$num = $size;
 
		// code from byte_format()
		$CI =& get_instance();
		$CI->lang->load('number');
 
		$decimals = 1;
 
		if ($num >= 1000000000000) 
		{
			$num = round($num / 1099511627776, 1);
			$unit = $CI->lang->line('terabyte_abbr');
		}
		elseif ($num >= 1000000000) 
		{
			$num = round($num / 1073741824, 1);
			$unit = $CI->lang->line('gigabyte_abbr');
		}
		elseif ($num >= 1000000) 
		{
			$num = round($num / 1048576, 1);
			$unit = $CI->lang->line('megabyte_abbr');
		}
		elseif ($num >= 1000) 
		{
			$decimals = 0; // decimals are not meaningful enough at this point
 
			$num = round($num / 1024, 1);
			$unit = $CI->lang->line('kilobyte_abbr');
		}
		else
		{
			$unit = $CI->lang->line('bytes');
			return number_format($num).' '.$unit;
		}
 
		$str = number_format($num, $decimals).' '.$unit;
 
		$str = str_replace(' ', '&nbsp;', $str);
		return $str;
	}
}
 
/* End of file MY_file_helper.php */
/* Location: ./system/application/helpers/MY_file_helper.php */