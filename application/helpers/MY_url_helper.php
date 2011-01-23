<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getHomepages'))
{
	function getHomepages($input)
	{
		$homes_all = '-';
		if ($input != '')
		{
			$homes_all = array();
			
			$homes = explode(' ', $input);
			$homes = implode('', $homes);
			$homes = explode(',', $homes);
			
			$n = 0;
			foreach($homes as $home)
			{
				$homes_all[$n] = '<span class="url">' .  anchor(prep_url($home), prep_url($home)) . '</span>';
				$n++;
			}
			$homes_all = implode(', ', $homes_all);
		}
		return $homes_all;
	}
	
}

if ( ! function_exists('clear'))
{
	function clear()
	{
		return '<div style="clear: both"></div>';
	}
}